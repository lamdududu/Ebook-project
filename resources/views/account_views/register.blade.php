@extends('account_views.log')

@section('title', 'Đăng ký')

@section('form')
    <section class="container  col-8 col-xl-5 p-3 login-form">
        <form class="needs-validation p-3" action="{{ route('register') }}" method="post" novalidate>
            {{ csrf_field() }}
            <legend class="p-2 text-center">Đăng ký</legend>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Họ và tên</span> -->
                    <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                    <!-- <div class="d-md-none w-100"></div> -->
                    <input type="text" name="name" aria-label="Tài khoản" aria-describedby="basic-addon1"
                        class="form-control shadow-none {{ $errors->has('name') ? 'is-invalid' : '' }} {{ old('name') ? 'is-valid' : '' }}" 
                        value="{{ old('name') }}" placeholder="Nhập họ và tên...">
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Tên đăng nhập</span> -->
                    <label for="username" class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                    <!-- <div class="d-md-none w-100"></div> -->
                    <input type="text" name="username" class="form-control shadow-none {{ $errors->has('username') ? 'is-invalid' : '' }} {{ old('username') ? 'is-valid' : '' }}" value="{{ old('username') }}" placeholder="Nhập tên đăng nhập..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group  padding-custom-pass -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Mật khẩu</span> -->
                    <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                    <!-- <div class="d-md-none w-100"></div> -->
                    <input type="password" name="password" class="form-control shadow-none {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group  padding-custom-pass -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Nhập lại mật khẩu</span> -->
                    <label for="password_confirmation" class="form-label">Nhập lại mật khẩu <span class="text-danger">*</span></label>
                    <!-- <div class="d-md-none w-100"></div> -->
                    <input type="password" name="password_confirmation" class="form-control shadow-none {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="Nhập lại mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                    @if($errors->has('password_confirmation') || $errors->has('password'))
                        <div class="invalid-feedback">
                        {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Ngày sinh</span> -->
                    <label for="birthday" class="form-label">Ngày sinh (dd-mm-yyyy) <span class="text-danger">*</span></label>
                    <!-- <div class="d-md-none w-100"></div> -->
                    <input type="date" name="birthday" class="form-control shadow-none {{ $errors->has('birthday') ? 'is-invalid' : '' }} {{ old('birthday') ? 'is-valid' : '' }}" value="{{ old('birthday') }}" aria-label="Tài khoản" aria-describedby="basic-addon1">
                    @if($errors->has('birthday'))
                        <div class="invalid-feedback">
                            {{ $errors->first('birthday') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <label class="form-label">Giới tính</label>
                <div>   
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
                </div>
                </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Địa chỉ email</span> -->
                    <label for="email" class="form-label">Địa chỉ email <span class="text-danger">*</span></label>
                    <!-- <div class="d-md-none w-100"></div> -->
                    <input type="email" name="email" class="form-control shadow-none {{ $errors->has('email') ? 'is-invalid' : '' }} {{ old('email') ? 'is-valid' : '' }}" value="{{ old('email') }}" placeholder="Nhập địa chỉ email..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Số điện thọai</span> -->
                    <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                    <!-- <div class="d-md-none w-100"></div> -->
                    <input type="text" name="phone" class="form-control shadow-none {{ $errors->has('phone') ? 'is-invalid' : '' }} {{ old('phone') ? 'is-valid' : '' }}" value="{{ old('phone') }}" placeholder="Nhập số điện thoại..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Ảnh đại diện</span> -->
                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                    <!-- <div class="d-md-none w-100"></div> -->
                    <input type="file" name="avatar" class="form-control custom-input-upload">                    
                </div>
            </div>
            <div class="row align-items-center py-2">
                <div class="col d-flex justify-content-center align-items-center gap-2">
                    <input type="checkbox" name="checkbox" class="shadow-none" ></input>
                    <label for="checkbox" class="form-check-label {{ $errors->has('checkbox') ? 'text-danger' : ''}}"> Tôi đồng ý với các điều khoản sử dụng <span class="text-danger">*</span></label>
                    <!-- @if($errors->has('checkbox'))
                        <div class="invalid-feedback">
                            {{ $errors->first('checkbox') }}
                        </div>
                    @endif -->
                </div>
                <!-- btn btn-primary btn-sm -->
            </div>
            <div class="row align-items-center py-2">
                <div class="col d-flex justify-content-center align-items-center">
                    <button class="btn-sign" type="submit">Đăng ký</button>
                </div>
                <!-- btn btn-primary btn-sm -->
            </div>
        </form>
        <hr class="hr">
        <div class="row">
            <div class="col d-flex flex-column justify-content-center align-items-center">
            <div class="sign-up">
                    <span>Bạn đã có tài khoản?</span>
                    <a href="{{ route('login.page') }}">Đăng nhập</a>
                </div>
            </div>
        </div>
    </section>
@endsection