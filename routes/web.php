<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WorkManagementController;
use App\Http\Controllers\WorkReadController;
use App\Http\Controllers\WorkListController;
use App\Models\Work;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

// Hiển thị trang đăng nhập
Route::get('/dangnhap', function () {
    return view('account_views.login');
})->middleware('isLogged')->name('login.page');

// Đăng nhập
Route::post('/dangnhap/dangnhap', [AccountController::class, 'authenticateLogin'])->middleware('isLogged')->name('login');

// Đăng xuất
Route::get('/dangxuat', [AccountController::class, 'logout'])->name('logout');

// Trang đăng ký tài khoản
Route::get('/dangky', function () {
    return view('account_views.register');
})->middleware('isLogged')->name('register.page');

// Đăng ký
Route::post('/dangky/dangky', [AccountController::class, 'authenticateRegister'])->middleware('isLogged')->name('register');

// ----------------------------------------------------------------
// ----------------------------------------------------------------
// ----------------------------------------------------------------

// Hiển thị trang chủ
Route::get('/', [WorkListController::class, 'getNominations'])->middleware('home')->name('home');

// Xem danh sách tác phẩm
Route::get('/tacpham', [WorkListController::class, 'index'])->middleware('home')->name('works');

// Lọc tác phẩm theo thể loại
Route::post('/tacpham/loc-theloai', [WorkListController::class, 'handleFilter'])->middleware('home')->name('filter');

// Đọc
// Xem chi tiết thông tin tác phẩm
Route::get('/tacpham/thongtintacpham/{id}', [WorkReadController::class, 'index'])->middleware('home')->name('read.details');

// Xem nội dung tác phẩm
Route::get('/tacpham/doc/{id}', [WorkReadController::class, 'getContent'])->middleware('isUser')->name('read.content');

// ----------------------------------------------------------------
// ----------------------------------------------------------------
// ----------------------------------------------------------------

// Giỏ hàng
Route::get('/giohang', [CartController::class, 'index'])->middleware('isUnlogged')->name('cart');

//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------

// Quản lý tác phẩm
// Hiển thị danh sách tác phẩm
Route::get('/quantrivien/tacpham', [WorkManagementController::class, 'index'])->middleware('isEditor')->name('works.management');

// Hiển thị chi tiết thông tin tác phẩm
Route::get('/quantrivien/tacpham/chitiettacpham/{id}', [WorkManagementController::class, 'getWork'])->middleware('isEditor')->name('work.details');

// Chỉnh sửa thông tin tác phẩm
Route::get('/quantrivien/tacpham/chitiettacpham/chinhsua/{id}', [WorkManagementController::class, 'edit'])->middleware('isEditor')->name('work.edit');

// Cập nhật các thay đổi của tác phẩm
Route::post('/quantrivien/tacpham/chitiettacpham/capnhat/{id}', [WorkManagementController::class, 'update'])->middleware('isEditor')->name('work.update');

//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------

// Quản lý tài khoản
// Hiển thị danh sách tài khoản người dùng
Route::get('/quantrivien/taikhoan/nguoidung', [AccountManagementController::class, 'index'])->middleware('isAdmin')->name('accounts.management');

// Hiển thị danh sách tài khoản người dùng đang hoạt động
Route::get('/quantrivien/taikhoan/danghoatdong', [AccountManagementController::class, 'index'])->middleware('isAdmin')->name('normal.account');

// Hiển thị danh sách tài khoản người dùng đã bị khóa
Route::get('/quantrivien/taikhoan/dakhoa', [AccountManagementController::class, 'index'])->middleware('isAdmin')->name('block.account');

// Hiển thị danh sách tài khoản biên tập viên
Route::get('/quantrivien/taikhoan/bientapvien', [AccountManagementController::class, 'getEditorAccounts'])->middleware('isAdmin')->name('editor.management');

// Hiển thị danh sách tài khoản quản trị viên
Route::get('/quantrivien/taikhoan/quantrivien', [AccountManagementController::class, 'getAdminAccounts'])->middleware('isAdmin')->name('admin.management');


// Route::get('/quantrivien/tacpham', [WorkListController::class, 'index'])->name('works');

// Thử giao diện (không quan trọng)
Route::get('/test', function () {
    return view('test');
});