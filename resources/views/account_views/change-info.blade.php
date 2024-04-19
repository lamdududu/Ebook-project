@extends('index-user')

@section('title', 'Thông tin tài khoản')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account-info.css') }}">
@endsection

@section('main')
    <main class="container py-3">
        <article class="row pb-5">
            <div class="col-lg-4"></div>
            <form class="col" method="post" action="#" enctype="multipart/form-data">
                <div class="text-center mt-4 rounded-circle avatar" style="opacity: 50%">
                    <?php $avt = 'https://static.vecteezy.com/system/resources/previews/022/123/337/non_2x/user-icon-profile-icon-account-icon-login-sign-line-vector.jpg'; ?>
                    <img src="{{$account->anh_dai_dien ?: $avt}}" class="img-fluid" alt="avatar">
                </div>
                <div class="pt-1">
                    <input type="file" name="avatar" class="form-control custom-input-upload {{ $errors->has('avatar') ? 'is-invalid' : '' }}">
                        @if($errors->has('avatar'))
                            <div class="invalid-feedback">
                                {{ $errors->first('avatar') }}
                            </div>
                        @endif
                </div>
            </form>
            <div class="col-lg-4"></div>
        </article>
        <article class="row gap-5">
            <section class="col">
                <form>
                </form>
                <form class="need-validations login-form" method="post" action="#">
                    <section class="table-responsive p-3">
                        <h5 class="pb-2" style="font-weight: bold;">Thông tin cơ bản</h5>
                        <table class="table" style="font-size: 15px;">
                            <tbody>
                                <tr class="align-middle">
                                    <th scope="row">Họ và tên:</th>
                                    <td>
                                    <input type="text" class="form-control custom-input-text {{ $errors->has('name') ? 'is-invalid' : ''}} {{ old('name') ? 'is-valid' : '' }}" name="name" value="{{old('name') ?: $account->ho_ten_nguoi_dung}}">
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr class="align-middle">
                                    <th scope="row">Tên tài khoản:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('username') ? 'is-invalid' : ''}} {{ old('username') ? 'is-valid' : '' }}" name="username" value="{{old('username') ?: $account->ten_tai_khoan}}">
                                            @if($errors->has('username'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('username') }}
                                                </div>
                                            @endif
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th scope="row">Ngày sinh:</th>
                                    <td>
                                        <input type="date" class="form-control custom-input-text {{ $errors->has('birthday') ? 'is-invalid' : ''}} {{ old('birthday') ? 'is-valid' : '' }}" name="birthday" value="{{ old('birthday') ?: $account->ngay_sinh }}">
                                            @if($errors->has('birthday'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('birthday') }}
                                                </div>
                                            @endif
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th scope="row">Giới tính:</th>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Nam</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="3">
                                            <label class="form-check-label" for="inlineRadio3">Khác</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th scope="row">Email:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('email') ? 'is-invalid' : ''}} {{ old('email') ? 'is-valid' : '' }}" name="email" value="{{old('email') ?: $account->email}}">
                                            @if($errors->has('email'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th scope="row">Số điện thoại:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('phone') ? 'is-invalid' : ''}} {{ old('phone') ? 'is-valid' : '' }}" name="phone" value="{{old('phone') ?: $account->so_dien_thoai}}">
                                            @if($errors->has('phone'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                    </td>
                                <tr>
                        </table>
                        <div class="py-2 text-center new-work">
                            <a href="{{ route('info.update') }}" class="btn btn-primary btn-edit-info">
                                <i class="bi bi-pencil-fill"></i>
                                <span>Lưu thay đổi</span>
                            </a>
                        </div>
                    </section>
                </form>
            </section>
            <section class="col">
                <form id="form2" class="form-section">
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
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    </div>
                </form>
                <form id="form3" class="form-section">
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
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    </div>
                </form>
            </section>
            </div>
        </article>
    </main>
    
@endsection