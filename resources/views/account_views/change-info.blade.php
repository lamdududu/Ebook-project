@extends('index-user')

@section('title', 'Thông tin tài khoản')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account-info.css') }}">
@endsection

@section('main')
    <main class="container py-3 px-5">
        <article class="row gap-5 justify-content-center align-items-center">
            <section class="col container">
                <div class="row pb-3">
                    <form class="d-flex justify-content-center align-items-center flex-column" method="post" action="#" enctype="multipart/form-data">
                        <div class="text-center mt-4 rounded-circle avatar avatar-change" style="opacity: 50%">
                            <?php $avt = 'https://static.vecteezy.com/system/resources/previews/022/123/337/non_2x/user-icon-profile-icon-account-icon-login-sign-line-vector.jpg'; ?>
                            <img src="{{$account->anh_dai_dien ?: $avt}}" class="img-fluid" alt="avatar">
                        </div>
                        <div class="pt-1 input-avt">
                            <input type="file" name="avatar" class="form-control custom-input-upload {{ $errors->has('avatar') ? 'is-invalid' : '' }}">
                                @if($errors->has('avatar'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('avatar') }}
                                    </div>
                                @endif
                        </div>
                        <div class="col d-flex justify-content-center align-items-center py-2">
                            <button class="btn-edit-info" type="submit">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
                <div class="row py-3">
                    <form class="need-validations login-form" method="post" action="#">
                        <section class="table-responsive p-3">
                            <h4 class="pb-1"><strong>Thông tin tài khoản thanh toán</strong></h4>
                            <table class="table">
                                <tbody>
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
                                        <th>Nhập mật khẩu mới:</th>
                                        <td>
                                            <input type="password" name="pwPayment" class="form-control shadow-none {{ $errors->has('pwPayment') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                                            @if($errors->has('pwPayment'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('pwPayment') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <th>Nhập mật khẩu mới:</th>
                                        <td>
                                            <input type="password" name="pwPayment_confirmation" class="form-control shadow-none {{ $errors->has('pwPayment_confirmation') ? 'is-invalid' : '' }}" placeholder="Nhập lại mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                                            @if($errors->has('pwPayment_confirmation') || $errors->has('pwPayment'))
                                                <div class="invalid-feedback">
                                                {{ $errors->first('pwPayment_confirmation') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                            </table>
                            <div class="col d-flex justify-content-center align-items-center py-2">
                                <button class="btn-edit-info" type="submit">Lưu tài khoản</button>
                            </div>
                        </section>
                    </form>
                </div>
                <div class="row py-3">
                    <form class="need-validations login-form" method="post" action="#">
                        <section class="table-responsive p-3">
                            <h4 class="pb-1"><strong>Thông tin bảo mật tài khoản thanh toán</strong></h4>
                            <table class="table">
                                <tbody>
                                    <tr class="align-middle">
                                        <th>Nhập mật khẩu cũ:</th>
                                        <td>
                                            <input type="password" name="oldPassword" class="form-control shadow-none {{ $errors->has('oldPassword') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                                            @if($errors->has('oldPassword'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('oldPassword') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <th>Nhập mật khẩu mới:</th>
                                        <td>
                                            <input type="password" name="password" class="form-control shadow-none {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                                            @if($errors->has('password'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <th>Nhập mật khẩu mới:</th>
                                        <td>
                                            <input type="password" name="password_confirmation" class="form-control shadow-none {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="Nhập lại mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                                            @if($errors->has('password_confirmation') || $errors->has('password'))
                                                <div class="invalid-feedback">
                                                {{ $errors->first('password_confirmation') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col d-flex justify-content-center align-items-center py-2">
                                <button class="btn-edit-info" type="submit">Lưu mật khẩu mới</button>
                            </div>
                        </section>
                    </form>
                </div>
            </section>
            <section class="col container custom-padding">
                <div class="row py-3">
                    <form class="need-validations login-form" method="post" action="#">
                        <section class="table-responsive p-3">
                            <h4 class="pb-2"><strong>Thông tin cơ bản</strong></h4>
                            <table class="table">
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
                                    </tr>
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
                                            <div class="d-flex justify-content-start align-items-center">
                                            <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-1">
                                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" style="margin: 0;">
                                                <label class="form-check-label" for="inlineRadio1">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-1">
                                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2" style="margin: 0;">
                                                <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                            </div>
                                            <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-1">
                                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="3" style="margin: 0;">
                                                <label class="form-check-label" for="inlineRadio3">Khác</label>
                                            </div>
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
                            <div class="col d-flex justify-content-center align-items-center py-2">
                                <button class="btn-edit-info" type="submit">Lưu thay đổi</button>
                            </div>
                        </section>
                    </form>
                </div>
                <div class="row py-3">
                    <form class="need-validation login-form" method="post" action="#">
                        <section class="table-responsive p-3">
                            <h4 class="pb2"><strong>Thông tin bảo mật</strong></h4>
                            <table class="table">
                                <tbody>
                                    <tr class="align-middle">
                                        <th>Nhập mật khẩu cũ:</th>
                                        <td>
                                            <input type="password" name="oldPassword" class="form-control shadow-none {{ $errors->has('oldPassword') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                                            @if($errors->has('oldPassword'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('oldPassword') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <th>Nhập mật khẩu mới:</th>
                                        <td>
                                            <input type="password" name="password" class="form-control shadow-none {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                                            @if($errors->has('password'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <th>Nhập mật khẩu mới:</th>
                                        <td>
                                            <input type="password" name="password_confirmation" class="form-control shadow-none {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="Nhập lại mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                                            @if($errors->has('password_confirmation') || $errors->has('password'))
                                                <div class="invalid-feedback">
                                                {{ $errors->first('password_confirmation') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col d-flex justify-content-center align-items-center py-2">
                                <button class="btn-edit-info" type="submit">Lưu mật khẩu mới</button>
                            </div>
                        </section>
                    </form>
                </div>
            </section>
        </article>
    </main>
    
@endsection