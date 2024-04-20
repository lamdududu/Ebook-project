<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Cart;
use App\Models\PaymentAccount;
use App\Models\Bill;
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
            'select w.id, w.tua_de, w.tac_gia, w.ngon_ngu, w.nha_xuat_ban, w.anh_bia, b.gia_ban_thuong, b.gia_ban_db
            from (SELECT w.id, p.gia_ban_thuong, p.gia_ban_db, max(t.thoi_diem)
                FROM prices p
                JOIN works w ON w.id = p.tac_pham
                JOIN times t ON t.id = p.thoi_diem
                where t.thoi_diem <= Now()
                GROUP BY w.id) b JOIN works w ON b.id = w.id
                            JOIN carts c ON c.tac_pham = w.id
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
            
            $versions = [];

            foreach ($request->input('version') as $work => $version) {
                $versions[] = $version;
            }


            if( count($request->input('workCheck', [])) != count($versions)) {
                return redirect()->back()->withErrors('version', 'Chọn một phiên bản cho mỗi tác phẩm muốn mua');
            }
            else {
                if (!PaymentAccount::where('tai_khoan', Session::get('user')->id)->first()) {
                    return redirect()->route('payment.account')->with('warning', 'Chưa có tài khoản thanh toán');
                } else {
                    session()->put('data', $request->input('workCheck', []));
                    session()->put('version', $versions);
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
                'SELECT w.id, w.tua_de, w.anh_bia, p.gia_thanh, max(t.thoi_diem) as thoi_diem
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

                if(session('versions')[$count] == 1)
                    $workObject->gia_thanh = $row->gia_ban_thuong; // Giá phiên bản thường
                else $workObject->gia_thanh = $row->gia_ban_db; // Giá phiên bản đặc biệt
                
                $totalBill += $workObject->gia_thanh;
                $count++; // Đếm số lượng hàng
                $works[] = $workObject; // Thêm đối tượng vào mảng
            }            
        }

        session()->put('total', $totalBill);
        session()->put('works', $works);

        return view('account_views.payment', compact('works', 'totalBill', 'count', 'coverStoragePath'));
    }

    public function pay(Request $request)
    {
        $request->validate(
            [
                'payAcc' => 'required',
                'password' => 'required',
                'typeBill' => 'required',
            ],
            [
                'payAcc.required' => 'Chưa nhập tài khoản thanh toán',
                'password.required' => 'Chưa nhập password',
            ]
        );

        // Lấy tài khoản thanh toán
        $account = PaymentAccount::where('so_tai_khoan', $request->payAcc)->first();

        // Kiểm tra số tài khoản
        if (!$account) {
            return redirect()->route('account_views.payment')
                ->withErrors(['payAcc' => 'Không tìm thấy số tài khoản'])
                ->withInput($request->only('payAcc'));
        }
        else {
            //  Kiểm tra mật khẩu
            if (!Hash::check($request->password, $account->password)) {
                return redirect()->route('account_views.payment')
                                ->withErrors(['password' => 'Sai mật khẩu'])
                                ->withInput($request->only('payAcc'));
            } else {
                $bill = Bill::create([
                    'ngay_lap' => Carbon::now()->format('Y-m-d'),
                    'thanh_tien' => session::get('total'),
                    'tai_khoan' => session::get('user')->id,
                    'loai_hoa_don' => $request('')
                ]);

                session()->forget('data');
                session()->forget('version');
                return redirect()->route('cart')->with('success', 'Thanh toán thành công');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
