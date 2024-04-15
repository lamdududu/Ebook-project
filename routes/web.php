<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\WorkManagementController;
use App\Http\Controllers\WorkReadController;
use App\Http\Controllers\WorkListController;
use App\Models\Work;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;


Route::get('/dangnhap', function () {
    return view('login');   
})->name('login');


// Hiển thị trang chủ
Route::get('/', [WorkListController::class, 'getNominations'])->name('home');

// Xem danh sách tác phẩm
Route::get('/tacpham', [WorkListController::class, 'index'])->name('works');

// Lọc tác phẩm theo thể loại
Route::post('/tacpham/loc-theloai', [WorkListController::class, 'handleFilter'])->name('filter');

// Đọc
// Xem chi tiết thông tin tác phẩm
Route::get('/tacpham/thongtintacpham/{id}', [WorkReadController::class, 'index'])->name('read.details');

// Xem nội dung tác phẩm
Route::get('/tacpham/doc/{id}', [WorkReadController::class, 'getContent'])->name('read.content');

//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------

// Quản lý tác phẩm
// Hiển thị danh sách tác phẩm
Route::get('/quantrivien/tacpham', [WorkManagementController::class, 'index'])->name('works.management');

// Hiển thị chi tiết thông tin tác phẩm
Route::get('/quantrivien/tacpham/chitiettacpham/{id}', [WorkManagementController::class, 'getWork'])->name('work.details');

// Chỉnh sửa thông tin tác phẩm
Route::get('/quantrivien/tacpham/chitiettacpham/chinhsua/{id}', [WorkManagementController::class, 'edit'])->name('work.edit');

// Cập nhật các thay đổi của tác phẩm
Route::post('/quantrivien/tacpham/chitiettacpham/capnhat/{id}', [WorkManagementController::class, 'update'])->name('work.update');


// Quản lý tài khoản
// Hiển thị danh sách tài khoản người dùng
Route::get('/quantrivien/taikhoan/nguoidung', [AccountManagementController::class, 'index'])->name('accounts.management');

// Hiển thị danh sách tài khoản người dùng đang hoạt động
Route::get('/quantrivien/taikhoan/danghoatdong', [AccountManagementController::class, 'index'])->name('normal.account');

// Hiển thị danh sách tài khoản người dùng đã bị khóa
Route::get('/quantrivien/taikhoan/dakhoa', [AccountManagementController::class, 'index'])->name('block.account');

// Hiển thị danh sách tài khoản biên tập viên
Route::get('/quantrivien/taikhoan/bientapvien', [AccountManagementController::class, 'getEditorAccounts'])->name('editor.management');

// Hiển thị danh sách tài khoản quản trị viên
Route::get('/quantrivien/taikhoan/quantrivien', [AccountManagementController::class, 'getAdminAccounts'])->name('admin.management');


// Route::get('/quantrivien/tacpham', [WorkListController::class, 'index'])->name('works');

// Thử giao diện (không quan trọng)
Route::get('/test', function () {
    return view('test');
});