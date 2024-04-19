<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');
    }



    public function authenticateRegister(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|regex:/^(?=.*[\p{L}])[\p{L}\s]+$/u',
                'username' => 'required||regex:/^[a-zA-Z][a-zA-Z0-9]*$/|min:5|max:20',
                'password' => 'required|min:6|max:50|regex:/^\S+$/|confirmed',
                'password_confirmation' => 'required',
                'email' => 'required|email',
                'birthday' => 'required|date_format:d-m-Y|before_or_equal:' . now()->subYears(16)->format('d-m-Y'),
                'phone' => 'required||numeric|digits:10',
                'checkbox' => 'accepted',
            ],
            [
                'name.required' => 'Chưa nhập họ và tên',
                'name.regex' => 'Họ và tên không hợp lệ (không chứa số và ký tự đặc biệt)',
                'username.required' => 'Chưa nhập tên đăng nhập',
                'username.min' => 'Tên đăng nhập phải có ít nhất 5 ký tự',
                'username.max' => 'Tên tài khoản quá dài (tối đa 20 ký tự)',
                'username.regex' => 'Tên đăng nhập không hợp lệ (bắt đầu bằng chữ cái và chỉ được chứa ký tự chữ cái, số)',
                'password.required' => 'Chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu quá dài (tối đa 50 ký tự)',
                'password.regex' => 'Mật khẩu không hợp lệ (chỉ được chứa ký tự chữ cái, số và các ký tự đặc biệt)',
                'password_confirmation.required' => 'Chưa nhập xác nhận mật khẩu',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng',
                'email.required' => 'Chưa nhập địa chỉ email',
                'email.email' => 'Địa chỉ email không hợp lệ',
                'birthday.required' => 'Chưa nhập ngày sinh',
                'birthday.before_or_equal' => 'Chưa đủ 16 tuổi',
                'birthday.date_format' => 'Định dạng ngày sinh không hợp lệ (dd-mm-yyyy)',
                'phone.required' => 'Chưa nhập số điện thoại',
                'phone.digits' => 'Số điện thoại không hợp lệ',
                'phone.numeric' => 'Số điện thoại chứa ký tự không hợp lệ',
                'checkbox.accepted' => 'Vui lòng đọc điều khoản sử dụng'
            ]
        );


        if (Account::where('ten_tai_khoan', $request->input('username'))->first()) {
            return back()->withErrors(['username' => 'Tên đăng nhập đã tồn tại'])
                ->withInput($request->only('name', 'username', 'email', 'phone', 'birthday', 'gender'));
        } else {
            if (Account::where('email', $request->input('email'))->first()) {
                return back()->withErrors(['email' => 'Email đã được sử dụng để đăng ký tài khoản trước đó'])
                    ->withInput($request->only('name', 'username', 'email', 'phone', 'birthday', 'gender'));
            }
        }

        $user = new Account();

        $user->ten_tai_khoan = $request->input('username');
        $user->mat_khau = Hash::make($request->input('password'));
        $user->email = $request->input('email');
        $user->so_dien_thoai = $request->input('phone');
        $user->ho_ten_nguoi_dung = $request->input('name');
        // $user->ngay_sinh = Carbon::createFromFormat('d-m-y', trim($request->input('birthday')))->format('Y-m-d');
        if (preg_match('/^\d{1,2}-\d{1,2}-\d{4}$/', $request->input('birthday'))) {
            $user->ngay_sinh = Carbon::createFromFormat('d-m-Y', $request->input('birthday'))->format('Y-m-d');
        } else {
            // Xử lý lỗi định dạng không đúng
            return back()->withErrors(['birthday' => 'Định dạng ngày tháng không đúng']);
        }
        $user->gioi_tinh = $request->input('gender');
        $user->anh_dai_dien = $request->input('anh_dai_dien') ?: '';
        $user->loai_tai_khoan = 1;
        $user->trang_thai = 1;

        $user->save();

        unset($user['mat_khau']);
        Session::put('user', $user);

        return redirect()->route('home')
            ->with('success', 'Đăng ký tài khoản thành công');

}

    public function logout()
    {
        Session::flush();
        return redirect()->route('login.page');
    }


    public function authenticateLogin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Chưa nhập tên tài khoản hoặc email',
                'password.required' => 'Chưa nhập mật khẩu',
            ]
        );

        $username = Account::where('ten_tai_khoan', $request['username'])->first();
        $email = Account::where('email', $request['username'])->first();

        if (!$username && !$email)
        {
            return redirect()->route('login.page')
                ->withErrors(['username' => 'Tài khoản chưa được đăng ký'])
                ->withInput($request->only('username'));
        }
        else
        {
            $user = $username ?: $email;
            $inputPassword = $request['password'];

            if ($user->trang_thai == 2) {
                return redirect()->route('login.page')
                    ->withErrors(['username' => 'Tài khoản của bạn đã bị khóa'])
                    ->withInput($request->only('username'));
            }

            else {
                if (!Hash::check($inputPassword, $user['mat_khau']))
                {
                    return redirect()->route('login.page')
                        ->withErrors(['pass' => 'Sai mật khẩu'])
                        ->withInput($request->only('username'));
                }
                else 
                {
                    unset($user['mat_khau']);

                    Session::put('user', $user);
                    
                    if($user->isAdmin()) {
                        return redirect()->route('accounts.management');
                    }
            
                    else if($user->isEditor()) {
                        return redirect()->route('works.management');
                    }
            
                    else {
                        return redirect()->route('home');
                    } 
                }
            }
        }
    }
    
    public function getUserInfor($id) {
        $account = Account::find($id);

        $accPayment = PaymentAccount::where('tai_khoan', $account->id)->pluck('so_tai_khoan')->first();

        return view('account_views.user-information', compact('account', 'accPayment'));
    }

    public function edit($id) {
        $account = Account::find($id);

        $accPayment = PaymentAccount::where('tai_khoan', $account->id)->first();

        return view('account_views.change-info', compact('account', 'accPayment'));
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
