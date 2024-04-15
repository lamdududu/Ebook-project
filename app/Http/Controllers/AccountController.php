<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');
    }

    

    public function authenticateLogin(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'password' => 'required',
            ],
            [
                'name.required' => 'Chưa nhập tên tài khoản hoặc email',
                'password.required' => 'Chưa nhập mật khẩu',
            ]
        );

        $username = Account::where('ten_tai_khoan', $request['name'])->first();
        $email = Account::where('email', $request['name'])->first();

        if(!$username && !$email) {
            return redirect()->route('login.page')
                            ->withErrors(['username' => 'Tài khoản chưa được đăng ký'])
                            ->withInput($request->only('name'));
        }
        
        else {
            $user = $username ?: $email;
            $inputPassword = $request['password'];
            if($user->trang_thai == 2) {
                return redirect()->route('login.page')
                            ->withErrors(['username' => 'Tài khoản của bạn đã bị khóa'])
                            ->withInput($request->only('name'));
            }
            else {
                if(!Hash::check($inputPassword, $user['mat_khau'])) {
                    $request->request->remove('password');
                    return redirect()->route('login.page')
                                    ->withErrors(['pass' => 'Sai mật khẩu'])
                                    ->withInput($request->only('name'));
                }
                else {
                    $request->request->remove('password');
                    Session::put('userId', $user->id);
                    Session::put('userName', $user->ten_tai_khoan);
                    return redirect()->route('home');
                }
            }     
        }
    }

    public function logout() {
        Session::flush();
        return redirect()->route('login.page');
    }
    // protected $account;
    // protected $session;
    // protected $hash;

    // public function __construct(Account $account, Session $session, Hash $hash)
    // {
    //     $this->account = $account;
    //     $this->session = $session;
    //     $this->hash = $hash;
    // }

    // public function authenticateLogin(Request $request)
    // {
    //     try {
    //         // Kiểm tra xác thực tên tài khoản hoặc email
    //         $username = $this->account->where('ten_tai_khoan', $request->name)->first();
    //         $email = $this->account->where('email', $request->name)->first();

    //         if(!$username && !$email) {
    //             return redirect()->route('login.page')->withErrors(['messageError' => 'Tài khoản chưa được đăng ký']);
    //         } else {
    //             $user = $username ?: $email;
    //             // Xác thực mật khẩu
    //             if(!$this->hash->check($request->password, $user->mat_khau)) {
    //                 return redirect()->route('login.page')->withErrors(['messageError' => 'Sai mật khẩu']);
    //             } else {
    //                 // Lưu thông tin người dùng vào session
    //                 $this->session::put('user', $user);
    //                 return redirect()->route('home');
    //             }
    //         } 
    //     } catch (\Exception $e) {
    //         // Xử lý lỗi một cách an toàn
    //         return redirect()->route('login.page')->withErrors(['messageError' => 'Đã xảy ra lỗi trong quá trình xác thực']);
    //     }    
    // }

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
