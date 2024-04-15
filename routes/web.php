<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\WorkManagementController;
use App\Http\Controllers\WorkReadController;
use App\Http\Controllers\WorkListController;
use App\Models\Work;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

Route::get('/', [WorkListController::class, 'getNominations'])->name('home');

Route::get('/test', function () {
    return view('test');
});

// Route::get('/', function () {
//     return view('works');
// });

Route::get('/tacpham', [WorkListController::class, 'index'])->name('works');

Route::post('/tacpham/loc-theloai', [WorkListController::class, 'handleFilter'])->name('filter');

Route::get('/dangnhap', function () {
    return view('login');   
})->name('login');

Route::get('/quantrivien/tacpham', [WorkManagementController::class, 'index'])->name('works.management');

Route::get('/quantrivien/tacpham/chitiettacpham/{id}', [WorkManagementController::class, 'getWork'])->name('work.details');

Route::get('/quantrivien/tacpham/chitiettacpham/chinhsua/{id}', [WorkManagementController::class, 'edit'])->name('work.edit');

Route::post('/quantrivien/tacpham/chitiettacpham/capnhat/{id}', [WorkManagementController::class, 'update'])->name('work.update');

Route::get('/tacpham/thongtintacpham/{id}', [WorkReadController::class, 'index'])->name('read.details');

Route::get('/tacpham/doc/{id}', [WorkReadController::class, 'getContent'])->name('read.content');

Route::get('/quantrivien/taikhoan/nguoidung', [AccountManagementController::class, 'index'])->name('accounts.management');
Route::get('/quantrivien/taikhoan/danghoatdong', [AccountManagementController::class, 'index'])->name('normal.account');
Route::get('/quantrivien/taikhoan/dakhoa', [AccountManagementController::class, 'index'])->name('block.account');
Route::get('/quantrivien/taikhoan/bientapvien', [AccountManagementController::class, 'getEditorAccounts'])->name('editor.management');
Route::get('/quantrivien/taikhoan/quantrivien', [AccountManagementController::class, 'getAdminAccounts'])->name('admin.management');

// Route::get('/quantrivien/tacpham', [WorkListController::class, 'index'])->name('works');