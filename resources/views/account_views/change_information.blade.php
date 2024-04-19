@extends('index-user')

@section('title', 'Thông tin tài khoản')

@section('main')
<body>
    <div class="text-center mt-4">
        <img src="tth4/blackcat.jpg" class="hinhanh" alt="Hình đại diện" width="150" height="150">
    </div>
    <div class="container">
        <h2 class="text-center mb-4">Thông Tin Cá Nhân</h2>

        <form id="form1" class="form-section">
            <fieldset>
                <legend><b>Thông Tin Cơ Bản</b></legend>
                <div class="mb-3">
                    <label for="hoTen" class="form-label">Họ Và Tên*</label>
                    <input type="text" class="form-control" id="hoTen" placeholder="Họ Và Tên">
                </div>
                <div class="mb-3">
                    <label for="taiKhoan" class="form-label">Tài Khoản</label>
                    <input type="text" class="form-control" id="taiKhoan" placeholder="Tài Khoản" readonly>
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Mail*</label>
                    <input type="email" class="form-control" id="mail" placeholder="Mail">
                </div>
                <div class="mb-3">
                    <label for="dienThoai" class="form-label">Điện Thoại*</label>
                    <input type="tel" class="form-control" id="dienThoai" placeholder="Điện Thoại">
                </div>
                <div class="mb-3">
                    <label class="form-label">Giới Tính</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gioiTinh" id="gioiTinhNam" value="Nam">
                        <label class="form-check-label" for="gioiTinhNam">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gioiTinh" id="gioiTinhNu" value="Nu">
                        <label class="form-check-label" for="gioiTinhNu">Nữ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gioiTinh" id="gioiTinhKhac" value="Khac">
                        <label class="form-check-label" for="gioiTinhKhac">Khác</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="namSinh" class="form-label">Ngày Sinh*</label>
                    <input type="date" class="form-control" id="namSinh">
                </div>
            </fieldset>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
            </div>
        </form>

        <form id="form2" class="form-section">
            <fieldset>
                <legend><b>Mật Khẩu</b></legend>
                <div class="mb-3">
                    <label for="matKhau" class="form-label">Mật Khẩu Hiện Tại*</label>
                    <input type="password" class="form-control" id="matKhau" placeholder="Mật Khẩu">
                </div>
                <div class="mb-3">
                    <label for="matKhauMoi" class="form-label">Mật Khẩu Mới*</label>
                    <input type="password" class="form-control" id="matKhauMoi" placeholder="Mật Khẩu Mới">
                </div>
                <div class="mb-3">
                    <label for="nhapLaiMatKhau" class="form-label">Nhập Lại Mật Khẩu Mới*</label>
                    <input type="password" class="form-control" id="nhapLaiMatKhau" placeholder="Nhập Lại Mật Khẩu" data-match="#matKhauMoi">
                    <div class="invalid-feedback">Mật khẩu mới và nhập lại mật khẩu mới không khớp.</div>
                </div>
            </fieldset>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
            </div>
        </form>

        <form id="form3" class="form-section">
            <fieldset>
                <legend><b>Số Tài Khoản</b></legend>
                <div class="mb-3">
                    <label for="stk" class="form-label">Số Tài Khoản</label>
                    <input type="text" class="form-control" id="stk" placeholder="Nhập số tài khoản">
                </div>
                <div class="mb-3">
                    <label for="matKhauStk" class="form-label">Mật Khẩu STK</label>
                    <input type="password" class="form-control" id="matKhauStk" placeholder="Nhập mật khẩu STK">
                </div>
                <div class="mb-3">
                    <label for="nhapLaiMatKhauStk" class="form-label">Nhập Lại Mật Khẩu STK</label>
                    <input type="password" class="form-control" id="nhapLaiMatKhauStk" placeholder="Nhập Lại Mật Khẩu" data-match="#matKhauStk">
                    <div class="invalid-feedback">Mật khẩu STK và nhập lại mật khẩu STK không khớp.</div>
                </div>
            </fieldset>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection