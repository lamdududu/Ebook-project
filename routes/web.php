<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WorkManagementController;
use App\Http\Controllers\WorkReadController;
use App\Http\Controllers\WorkListController;
use App\Http\Controllers\PriceManagementController;
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

// Tài khoản thanh toán
Route::get('/taikhoan/taikhoanthanhtoan/', function(){
    return view('account_views.payment-account');
})->middleware('isUser')->name('payment.account');

// Kết nối tài khoán thanh toán
Route::post('/taikhoan/taikhoanthanhtoan/ketnoi', [AccountController::class, 'connectionPaymentAccount'])->middleware('isUser')->name('payment.connection');

// ----------------------------------------------------------------
// ----------------------------------------------------------------
// ----------------------------------------------------------------

// Thêm vào giỏ hàng
Route::get('/giohang/them/{id}', [CartController::class, 'add'])->middleware('isUser')->name('cart.add');

// Giỏ hàng
Route::get('/giohang', [CartController::class, 'index'])->middleware('isUnlogged')->name('cart');

// Xử lý các nút trong giao diện giỏ hàng
Route::post('/giohang/xuly', [CartController::class, 'handleButtonCart'])->middleware('isUser')->name('cart.button');

// Thanh toán
Route::get('/giohang/thanhtoan', [CartController::class, 'confirmPayment'])->middleware('isUser')->name('cart.payment');

// Thanh toán
Route::post('/giohang/thanhtoan/thanhtoan', [CartController::class, 'pay'])->middleware('isUser')->name('payment');

// Thanh toán ngay phiên bản đặc biệt
Route::get('/giohang/thanhtoanngay/bandacbiet/{id}', [CartController::class, 'payNowSversion'])->middleware('isUser')->name('payment.special');

// Thanh toán ngay
Route::post('/giohang/thanhtoanngay/{id}', [CartController::class, 'payNow'])->middleware('isUser')->name('payment.now');

// Lịch sử thanh toán
Route::get('/taikhoan/lichsuthanhtoan', [CartController::class, 'getBill'])->middleware('isUser')->name('bill');

// ----------------------------------------------------------------
// ----------------------------------------------------------------
// ----------------------------------------------------------------

// Thông tin tài khoản
Route::get('/taikhoan/thongtintaikhoan/{id}', [AccountController::class, 'getAccInfor'])->name('account-informations');

// Thông tin tài khoản admin
Route::get('/quantrivien/taikhoan/thongtintaikhoan/capnhat/{id}', [AccountController::class, 'editAdmin'])->middleware('changeInfo')->name('admin.edit');

// Thông tin tài khoản
Route::get('/taikhoan/thongtintaikhoan/capnhat/{id}', [AccountController::class, 'editUser'])->name('user.edit');

// Cập nhật ảnh đại diện
Route::post('/taikhoan/thongtintaikhoan/anhdaidien/capnhat/{id}', [AccountController::class, 'updateAvatar'])->name('avatar.update');

// Cập nhật thông tin cơ bản
Route::post('/taikhoan/thongtintaikhoan/thongtincoban/capnhat/{id}', [AccountController::class, 'updateAccInfor'])->name('info.update');

// Cập nhật thông tin cơ bản
Route::post('/taikhoan/thongtintaikhoan/matkhau/capnhat/{id}', [AccountController::class, 'updateAccPassword'])->name('password.update');

// Cập nhật thông tin cơ bản
Route::post('/taikhoan/thongtintaikhoan/taikhoanthanhtoan/capnhat/{id}', [AccountController::class, 'updateAccPayment'])->name('payment.update');

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

// Tải xuống tác phẩm
Route::get('/tacpham/taixuong/{id}', [WorkReadController::class, 'download'])->middleware('isUser')->name('download');

// Thư viện
Route::get('/taikhoan/thuvien', [WorkListController::class, 'getLibrary'])->middleware('isUser')->name('library');

//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------

// Quản lý tác phẩm

// Hiển thị danh sách tác phẩm
Route::get('/bientapvien/tacpham', [WorkManagementController::class, 'index'])->middleware('workManager')->name('works.editor');

// Hiển thị danh sách tác phẩm đã đăng tải
Route::get('/bientapvien/tacpham/dadangtai', [WorkManagementController::class, 'getPublicWork'])->middleware('isEditor')->name('works.public');

// Hiển thị danh sách tác phẩm đang chờ duyệt
Route::get('/bientapvien/tacpham/dangchoduyet', [WorkManagementController::class, 'getApprovingWork'])->middleware('isEditor')->name('works.approve');

// Hiển thị danh sách tác phẩm đã ẩn
Route::get('/bientapvien/tacpham/daan', [WorkManagementController::class, 'getHiddenWork'])->middleware('isEditor')->name('works.hidden');

// Hiển thị chi tiết thông tin tác phẩm
Route::get('/bientapvien/tacpham/chitiettacpham/{id}', [WorkManagementController::class, 'getWork'])->middleware('isStaff')->name('work.details');

// Chỉnh sửa thông tin tác phẩm
Route::get('/bientapvien/tacpham/chitiettacpham/chinhsua/{id}', [WorkManagementController::class, 'edit'])->middleware('isEditor')->name('work.edit');

// Cập nhật các thay đổi của tác phẩm
Route::post('/bientapvien/tacpham/chitiettacpham/chinhsua/capnhat/{id}', [WorkManagementController::class, 'update'])->middleware('isEditor')->name('work.update');


// Giao diện tạo tác phẩm
Route::get('/bientapvien/tacpham/tacphammoi', [WorkManagementController::class, 'createNewWork'])->middleware('isEditor')->name('work.new');

// Tạo tác phẩm mới
Route::post('/bientapvien/tacpham/tacphammoi/luutacpham', [WorkManagementController::class, 'create'])->middleware('isEditor')->name('work.create');

//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------

// Hiển thị danh sách tác phẩm với giá
Route::get('/quantrivien/tacpham/giaban', [WorkManagementController::class, 'getWorksWithPrices'])->name('works.admin');

// Danh sách tác phẩm chờ duyệt
Route::get('/quantrivien/tacpham/dangchoduyet', [WorkManagementController::class, 'getApproveWorkAdmin'])->middleware('isAdmin')->name('works.approve.admin');

// Xem chi tiết tác phẩm chờ duyệt
Route::get('/quantrivien/tacpham/chitiettacpham/choduyet{id}', [WorkManagementController::class, 'getDetailsApproveWork'])->middleware('isAdmin')->name('admin.details');

// Duyệt tác phẩm
Route::post('/quantrivien/tacpham/chitiettacpham/duyet/{id}', [WorkManagementController::class, 'approve'])->middleware('isAdmin')->name('admin.approve');

// Danh sách tác phẩm đã đăng tải
Route::get('/quantrivien/tacpham/dadangtai', [WorkManagementController::class, 'getPublicWorkAdmin'])->middleware('isAdmin')->name('works.public.admin');

// Danh sách tác phẩm đã ẩn
Route::get('/quantrivien/tacpham/daan', [WorkManagementController::class, 'getHiddenWorkAdmin'])->middleware('isAdmin')->name('works.hidden.admin');

// Ẩn tác phẩm
Route::post('/quantrivien/tacpham/antacpham', [WorkManagementController::class, 'hide'])->middleware('isAdmin')->name('admin.hide');

// Bỏ ẩn tác phẩm
Route::post('/quantrivien/tacpham/dangtai', [WorkManagementController::class, 'post'])->middleware('isAdmin')->name('admin.post');

// Tạo giá bán
Route::get('/quantrivien/tacpham/giabanmoi', [PriceManagementController::class, 'createNewPrices'])->middleware('isAdmin')->name('prices.new');

// Lưu giá mới
Route::post('/quantrivien/tacpham/giabanmoi/luu', [PriceManagementController::class, 'create'])->middleware('isAdmin')->name('prices.create');

//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------

// Quản lý tài khoản
// Hiển thị danh sách tài khoản người dùng
Route::get('/quantrivien/taikhoan/nguoidung', [AccountManagementController::class, 'index'])->middleware('isAdmin')->name('accounts.management');

// Hiển thị danh sách tài khoản người dùng đang hoạt động
Route::get('/quantrivien/taikhoan/danghoatdong', [AccountManagementController::class, 'getNormalAccount'])->middleware('isAdmin')->name('normal.account');

// Hiển thị danh sách tài khoản người dùng đã bị khóa
Route::get('/quantrivien/taikhoan/dakhoa', [AccountManagementController::class, 'getBlockedAccount'])->middleware('isAdmin')->name('blocked.account');

// Hiển thị danh sách tài khoản biên tập viên
Route::get('/quantrivien/taikhoan/bientapvien', [AccountManagementController::class, 'getEditorAccounts'])->middleware('isAdmin')->name('editor.management');

// Hiển thị danh sách tài khoản quản trị viên
Route::get('/quantrivien/taikhoan/quantrivien', [AccountManagementController::class, 'getAdminAccounts'])->middleware('isAdmin')->name('admin.management');

// Thay đổi trạng thái
Route::post('/quantrivien/taikhoan/capnhattrangthai', [AccountManagementController::class, 'updateAccountStatus'])->middleware('isAdmin')->name('admin.status');


//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------



// Route::get('/quantrivien/tacpham', [WorkListController::class, 'index'])->name('works');

// Thử giao diện (không quan trọng)
Route::get('/test', function () {
    return view('test');
});