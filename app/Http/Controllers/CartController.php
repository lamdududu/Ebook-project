<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Cart;
use App\Models\PaymentAccount;
use App\Models\Bill;
use App\Models\BillDetails;
use App\Models\Work;
use stdClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coverStoragePath = Storage::url('covers');

        $works = DB::select(
            'SELECT w.id, w.tua_de, w.tac_gia, w.ngon_ngu, pb.nha_xuat_ban, w.anh_bia, w.trang_thai, b.gia_ban_thuong, b.gia_ban_db
            FROM (SELECT w.id, p.gia_ban_thuong, p.gia_ban_db, max(t.thoi_diem)
                FROM prices p
                JOIN works w ON w.id = p.tac_pham
                JOIN times t ON t.id = p.thoi_diem
                where t.thoi_diem <= NOW()
                GROUP BY w.id) b JOIN works w ON b.id = w.id
                            JOIN carts c ON c.tac_pham = w.id
                            JOIN publishers pb ON w.nha_xuat_ban = pb.id
            WHERE c.tai_khoan = ' . Session::get('user.id') . ';'
        );

        $promotions = Promotion::where('ngay_bat_dau', '<=', Carbon::now())
            ->where('ngay_ket_thuc', '>=', Carbon::now())
            ->get();

        return view('account_views.cart', compact('works', 'coverStoragePath', 'promotions'));
    }

    public function handleButtonCart(Request $request)
    {
        if ($request->has('deleteWork')) {

            Cart::where('tai_khoan', Session::get('user')->id)
                ->where('tac_pham', $request->input('deleteWork'))->delete();

            return redirect()->route('cart');
        }

        if ($request->has('deleteAllWorks')) {

            $request->validate(
                [
                    'workCheck' => 'required|array|min:1',
                ],
                [
                    'workCheck.required' => 'Chọn ít nhất một tác phẩm cần xóa',
                    'workCheck.array' => 'Chọn ít nhất một tác phẩm cần xóa',
                    'workCheck.min' => 'Chọn ít nhất một tác phẩm cần xóa',
                ]
            );

            foreach ($request->input('workCheck', []) as $work) {

                Cart::where('tai_khoan', Session::get('user')->id)
                    ->where('tac_pham', $work)->delete();
            }

            return redirect()->route('cart');
        }

        if ($request->has('payment')) {

            $request->validate(
                [
                    'workCheck' => 'required|array|min:1',
                    'version' => 'required|array|min:1',
                ],
                [
                    'workCheck' => 'Chọn ít nhất một tác phẩm để thực hiện thao tác',
                    'version' => 'Chọn một phiên bản cho mỗi tác phẩm muốn mua',
                    // 'version.digits' => 'Chọn một phiên bản cho mỗi tác phẩm muốn mua',
                ]
            );
            
            // $versions = [];

            // foreach ($request->input('version') as $work => $version) {
            //     $versions[] = $version;
            // }


            if( count($request->input('workCheck', [])) != count($request->input('version'))) {
                return redirect()->back()->withErrors('version', 'Chọn một phiên bản cho mỗi tác phẩm muốn mua');
            }
            else {
                if (!PaymentAccount::where('tai_khoan', Session::get('user')->id)->first()) {
                    return redirect()->back()->with('warning', 'Chưa có tài khoản thanh toán');
                    // return redirect()->route('payment.account')->with('warning', 'Chưa có tài khoản thanh toán');

                } else {
                    session()->put('data', $request->input('workCheck', []));
                    session()->put('versions', $request->input('version'));
                    return redirect()->route('cart.payment');
                }
            }
        }
    }

    public function confirmPayment()
    {
        $coverStoragePath = Storage::url('covers');
        $totalBill = 0;
        $count = 0;

        foreach (session('data') as $work) {
            $work = DB::select(
                'SELECT w.id, w.tua_de, w.anh_bia, p.gia_ban_thuong, p.gia_ban_db, max(t.thoi_diem) as thoi_diem
                FROM prices p
                    JOIN works w ON w.id = p.tac_pham
                    JOIN times t ON t.id = p.thoi_diem
                WHERE t.thoi_diem <= NOW() AND w.id = ' . $work . '
                GROUP BY w.id;'
            );

            foreach ($work as $row) {
                $workObject = new stdClass(); // Tạo một đối tượng mới
                $workObject->id = $row->id;
                $workObject->tua_de = $row->tua_de;
                $workObject->anh_bia = $row->anh_bia;

                // Nếu người dùng chọn mua phiên bản thường
                if(session('versions')[$row->id] == 1) {
                    $workObject->gia_thanh = $row->gia_ban_thuong;
                    $workObject->phien_ban = session('versions')[$row->id];
                }
                // Nếu người dùng chọn mua phiên bản thường
                else {
                    $workObject->gia_thanh = $row->gia_ban_db;
                    $workObject->phien_ban = session('versions')[$row->id];
                }
                
                $totalBill += $workObject->gia_thanh;
                $count++; // Đếm số lượng hàng
                $works[] = $workObject; // Thêm đối tượng vào mảng
            }            
        }

        session()->put('totalPayment', $totalBill);
        session()->put('payForWorks', $works);

        return view('account_views.payment', compact('works', 'totalBill', 'count', 'coverStoragePath'));
    }

    public function pay(Request $request)
    {
        $request->validate(
            [
                'payAcc' => 'required',
                'password' => 'required',
            ],
            [
                'payAcc.required' => 'Chưa nhập tài khoản thanh toán',
                'password.required' => 'Chưa nhập password',
            ]
        );

        // Lấy tài khoản thanh toán
        $account = PaymentAccount::where('so_tai_khoan', $request->input('payAcc'))->first();

        // Kiểm tra số tài khoản
        if (!$account) {
            return redirect()->back()
                ->withErrors(['payAcc' => 'Không tìm thấy số tài khoản'])
                ->withInput($request->only('payAcc'));
        }
        else {
            //  Kiểm tra mật khẩu
            if (!Hash::check($request->input('password'), $account->mat_khau)) {
                return redirect()->back()
                                ->withErrors(['password' => 'Sai mật khẩu'])
                                ->withInput($request->only('payAcc'));
            } else {
                // Hiện tại chưa có phương thức cho khuyến mãi
                    // Bổ sung khuyến mãi sau
                $bill = Bill::create([
                    'ngay_lap' => Carbon::now()->format('Y-m-d'),
                    'thanh_tien' => session::get('totalPayment'),
                    'tai_khoan' => session::get('user')->id,
                    
                ]);

                foreach(session('payForWorks') as $work) {
                    BillDetails::create([
                        'tac_pham' => $work->id,
                        'hoa_don' => $bill->id,
                        'gia_thanh' => $work->gia_thanh,
                        'phien_ban' => $work->phien_ban,
                    ]);
                    Cart::where('tai_khoan', session::get('user')->id)
                        ->where('tac_pham', $work->id)
                        ->delete();
                }

                if(session::has('data'))
                    session()->forget('data');

                if(session::has('version'))
                    session()->forget('version');

                session()->forget('totalPayment');
                session()->forget('payForWorks');

                if(session::has('previous_url')) {
                    $previous_url = session::get('previous_url');
                    session()->forget('previous_url');
                    return redirect()->to($previous_url);
                }
                return redirect()->route('cart')->with('success-payment', 'Thanh toán thành công');
            }
        }
    }

    /**
     * Thanh toán ngay
     */

    public function payNow(Request $request, $id) 
    {   
        $coverStoragePath = Storage::url('covers');
        $count = 1;

        $work = Work::find($id);
        
        $workObject = new stdClass(); // Tạo một đối tượng mới
        $workObject->id = $work->id;
        $workObject->tua_de = $work->tua_de;
        $workObject->anh_bia = $work->anh_bia;

        // Nếu người dùng chọn mua phiên bản thường
        if($request->input('payNow') == 1) {
            $workObject->gia_thanh = $totalBill = $request->input('normalPrice');
            $workObject->phien_ban = 1;
        }
        // Nếu người dùng chọn mua phiên bản thường
        else {
            $workObject->gia_thanh = $totalBill = $request->input('specialPrice');
            $workObject->phien_ban = 2;        
        }
        
        $works[] = $workObject; // Thêm đối tượng vào mảng

        session()->put('totalPayment', $totalBill);
        session()->put('payForWorks', $works);

        // Kiểm tra có giá trị nào trong previous_url hay chưa, nếu có thì xóa
        if(Session::has('previous_url')) {
            session()->forget('previous_url');
        }
        
        session(['previous_url' => url()->previous()]);

        if(Session::has('workPayNow')) {
            Session()->forget('workPayNow');
        }

        // Kiểm tra tác phẩm đã có trong giỏ hàng hay chưa
        // Nếu đã có thì lưu id lại để sau khi thanh toán thành công sẽ xóa tác phẩm ra khỏi giỏ hàng
        if(Cart::where('tai_khoan', session::get('user')->id)->where('tac_pham', $id)->first()) 
        {
            Session()->put('workPayNow', $id);
        }


        return view('account_views.payment', compact('works', 'totalBill', 'count', 'coverStoragePath'));
    }

    /**
     * Thêm vào giỏ hàng
     */
    public function add($id)
    {
        $workAdd = Work::where('id', $id)->first();
        $user = session::get('user')->id;

        // Kiểm tra tác phẩm đã có tồn tại trong giỏ hàng chưa
        if(Cart::where('tai_khoan', session::get('user')->id)->where('tac_pham', $id)->first()) 
        {
            return redirect()->back()->with('warning-add', $workAdd->tua_de);
        }

        

        else if(
            BillDetails::join('bills', 'bills.id', '=', 'bill_details.hoa_don')
                        ->where('bills.tai_khoan', $user)
                        ->where('bill_details.tac_pham', $id)->first()
        ) {
            return redirect()->back()->with('warning-add-paid', $workAdd->tua_de);
        }

        else {
            
            Cart::create([
                'tai_khoan' => $user,
                'tac_pham' => $id,
            ]);

            return redirect()->back()->with('success-add', $workAdd->tua_de);
        }
    }

    /**
     * Xem lịch sử thanh toán
     */
    public function getBill()
    {   
        $coverStoragePath = Storage::url('covers');

        $bills = Bill::paginate(2);
        
        $bill_details = Bill::join('bill_details', 'bill_details.hoa_don', '=', 'bills.id')
                            ->join('works', 'works.id', '=', 'bill_details.tac_pham')
                            ->where('tai_khoan', session::get('user')->id)
                            ->select('bill_details.hoa_don', 'bill_details.gia_thanh', 'bill_details.phien_ban', 'works.tua_de', 'works.anh_bia')
                            ->get();

        return view('account_views.bill',compact('bills', 'bill_details', 'coverStoragePath'));
    }
}
