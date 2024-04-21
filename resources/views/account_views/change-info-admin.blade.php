@extends('index-admin')

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
                    <form id="ad-avt" class="d-flex justify-content-center align-items-center flex-column" method="post" action="{{ route('avatar.update', ['id' => Session::get('user.id')]) }}" enctype="multipart/form-data">
                        @csrf        
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
                                <button class="btn-edit-info" onclick="submitForm('ad-avt')" type="submit">Lưu thay đổi</button>
                            </div>
                    </form>
                </div>
                <div class="row py-3">
                    <form id="ad-pw" class="need-validation login-form" method="post" action="{{ route('password.update', ['id' => Session::get('user.id')]) }}">
                        @csrf
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
                                <button class="btn-edit-info" onclick="submitForm('ad-pw')" type="submit">Lưu mật khẩu mới</button>
                            </div>
                        </section>
                    </form>
                </div>
            </section>
            </section>
            <section class="col container" style="padding-top: 8.65rem;">
                <div class="row py-3">
                    <form id="ad-info" class="need-validations login-form" method="post" action="{{ route('info.update', ['id', $account->id]) }}">
                        @csrf
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
                                        <td>{{$account->ten_tai_khoan}}</td>
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
                                <button class="btn-edit-info" onclick="submitForm('ad-info')" type="submit">Lưu thay đổi</button>
                            </div>
                        </section>
                    </form>
                </div>
        </article>
    </main>
    
@endsection