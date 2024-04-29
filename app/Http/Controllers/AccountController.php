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

use function Laravel\Prompts\password;

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
                        return redirect()->route('works.editor');
                    }
            
                    else {
                        return redirect()->route('home');
                    } 
                }
            }
        }
    }
    
    public function getAccInfor($id) {
        $account = Account::find($id);

        $accPayment = PaymentAccount::where('tai_khoan', $account->id)->select('so_tai_khoan')->first();

        return view('account_views.user-information', compact('account', 'accPayment'));
    }

    public function editUser($id) {
        $account = Account::find($id);

        $accPayment = PaymentAccount::where('tai_khoan', $account->id)->first();

        return view('account_views.change-info', compact('account', 'accPayment'));
    }

    public function editAdmin($id) {
        $account = Account::find($id);

        return view('account_views.change-info-admin', compact('account'));
    }

    /**
     * Xử lý thao tác thay đổi thông tin tài khoản
     */
    public function handleBtnChange(Request $request, $id)
    {
        if ($request->has('chg-avt'))
        {
            $this->updateAvatar($request, $id);
        }
        
        else if ($request->has('chg-pass'))
        {
            if($this->changePassword($request, $id) == 1) {
                return redirect()->route('admin.edit')->withErrors(['old-password' => 'Sai mật khẩu']);
            }

            else if($this->changePassword($request, $id) == 2) {
                return redirect()->route('admin.edit')->withErrors(['password' => 'Mật khẩu mới không được trùng với mật khẩu cũ']);
            }

            else {
                return redirect()->route('admin.edit')->with('success', 'Đổi mật khẩu thành công');
            }
        }

        else if ($request->has('chg-info'))
        {
            $this->updateAccInfor($request, $id);
            return redirect()->route('admin.edit', ['id' => $id])->with('success', 'Cập nhật thành công');
        }

        else if ($request->has('chg-payment'))
        {
            $this->changePasswordPayment($request, $id);
        }
    }

    /**
     * Cập nhật thông tin cơ bản của tài khoản
     */
    public function updateAccInfor(Request $request, $id) 
    {
        $request->validate(
            [   
                'name' => 'required|regex:/^(?=.*[\p{L}])[\p{L}\s]+$/u',
                'email' => 'required|email',
                'birthday' => 'required|before_or_equal:' . now()->subYears(16)->format('d-m-Y'),
                'phone' => 'required||numeric|digits:10',
            ],
            [
                'name.required' => 'Chưa nhập họ và tên',
                'name.regex' => 'Họ và tên không hợp lệ (không chứa số và ký tự đặc biệt)',
                'email.required' => 'Chưa nhập địa chỉ email',
                'email.email' => 'Địa chỉ email không hợp lệ',
                'birthday.required' => 'Chưa nhập ngày sinh',
                'birthday.before_or_equal' => 'Chưa đủ 16 tuổi',
                'birthday.date_format' => 'Định dạng ngày sinh không hợp lệ (dd-mm-yyyy)',
                'phone.required' => 'Chưa nhập số điện thoại',
                'phone.digits' => 'Số điện thoại không hợp lệ',
                'phone.numeric' => 'Số điện thoại chứa ký tự không hợp lệ',
            ]
        );

        if($request->has('gender')) {
            $gender = $request->input('gender');
        }

        else $gender = '2';

        Account::where('id', $id)->update([
            'ho_ten_nguoi_dung' => $request->input('name'),
            'email' => $request->input('email'),
            'so_dien_thoai' => $request->input('phone'),
            'ngay_sinh' => Carbon::parse($request->input('birthday'))->format('Y-m-d'),
            'gioi_tinh' => $gender
        ]);
    }

    /**
     * Cập nhật ảnh đại diện
     */
    public function updateAvatar(Request $request, $id)
    {

    }

    /**
     * Thay đổi mật khẩu
     */

    public function changePassword(Request $request, $id)
    {
        $request->validate(
            [
                'old-password' => 'required',
                'password' => 'required|min:6|max:50|regex:/^\S+$/|confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'old-pass.required' => 'Chưa nhập mật khẩu cũ',
                'password.required' => 'Chưa nhập mật khẩu mới',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu quá dài (tối đa 50 ký tự)',
                'password.regex' => 'Mật khẩu không hợp lệ (chỉ được chứa ký tự chữ cái, số và các ký tự đặc biệt)',
                'password_confirmation.required' => 'Chưa nhập xác nhận mật khẩu',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng',
            ]
        );

        $user = Account::find(Session::get('user')->id);

        if (!Hash::check($request->input('old-password'), $user->mat_khau))
        {
            return 1;
        }
        
        else if (!Hash::check($request->input('password'), $user->mat_khau))
        {
            return 2;
        }
        
        else {
            $user->update(
                [
                    'mat_khau' => Hash::make($request->input('password')),
                ]
            );
        }
    }

    /**
     * Thay đổi mật khẩu thanh toán
     */

    public function changePasswordPayment(Request $request, $id)
    {
        
    }

    /**
     * Tạo tài khoản thanh toán
     */
    public function connectionPaymentAccount(Request $request)
    {
        $request->validate(
            [
                'payAcc' => 'required||numeric',
                'password' => 'required|min:6|max:50|regex:/^\S+$/|confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'payAcc.required' => 'Chưa nhập số tài khoản',
                'payAcc.numeric' => 'Số tài khoản chứa ký tự không hợp lệ',
                'password.required' => 'Chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu quá dài (tối đa 50 ký tự)',
                'password.regex' => 'Mật khẩu không hợp lệ (chỉ được chứa ký tự chữ cái, số và các ký tự đặc biệt)',
                'password_confirmation.required' => 'Chưa nhập xác nhận mật khẩu',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng',
            ]
        );


        if (PaymentAccount::where('so_tai_khoan', $request->input('accPay'))->first()) {
            return back()->withErrors(['accPay' => 'Tài khoản đã được sử dụng'])
                ->withInput($request->only('accPay'));
        }

        // $user = new PaymentAccount();

        // $user->so_tai_khoan = $request->input('payAcc');
        // $user->mat_khau = Hash::make($request->input('password'));

        // $user->save();

        PaymentAccount::create([
            'so_tai_khoan' => $request->input('payAcc'),
            'mat_khau' => Hash::make($request->input('password')),
            'tai_khoan' => Session::get('user')->id,
        ]);

        return redirect()->route('cart')
                        ->with('success-connection', 'Kết nối tài khoản thành công');
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
