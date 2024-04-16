@extends('account_views.log')

@section('title', 'Đăng ký')

@section('form')
    <section class="container  col-8 col-xl-5 p-3 login-form">
        <form class="needs-validation" action="{{ route('login') }}" method="post" novalidate>
            {{ csrf_field() }}
            <legend class="p-2 text-center">Đăng ký</legend>

            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Họ và tên</span> -->
                    <label for="name" class="col-sm-4 col-form-label">Họ và tên</label>
                    <div class="d-md-none w-100"></div>
                    <input type="text" name="name" class="form-control shadow-none {{ $errors->has('name') || $errors->has('username') ? 'is-invalid' : '' }} {{ old('name') ? 'is-valid' : '' }}" value="{{ old('name') }}" placeholder="Nhập họ và tên..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                    @if($errors->has('name'))
                        <div class="invalid-feedback">@error('name') {{$message}} @enderror</div>
                    @endif
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Tên đăng nhập</span> -->
                    <label for="name" class="col-sm-4 col-form-label">Tên đăng nhập</label>
                    <div class="d-md-none w-100"></div>
                    <input type="text" name="username" class="form-control shadow-none {{ $errors->has('name') || $errors->has('username') ? 'is-invalid' : '' }} {{ old('name') ? 'is-valid' : '' }}" value="{{ old('name') }}" placeholder="Nhập tên đăng nhập..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                    @if($errors->has('name'))
                        <div class="invalid-feedback">@error('name') {{$message}} @enderror</div>
                    @endif
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
                    <label for="name" class="col-sm-4 col-form-label">Mật khẩu</label>
                    <div class="d-md-none w-100"></div>
                    <input type="password" name="password" class="form-control shadow-none {{ $errors->has('password') || $errors->has('pass') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                    @if($errors->has('password'))
                    <div class="invalid-feedback">
                        @error('password') {{$message}} @enderror
                    </div>
                    @endif
                    @if($errors->has('pass'))
                    <!-- <div class="alert alert-danger"> -->

                    <!-- </div> -->
                    <div class="invalid-feedback">
                        {{ $errors->first('pass') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group  padding-custom-pass -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Nhập lại mật khẩu</span> -->
                    <label for="name" class="col-md-4 col-form-label">Nhập lại mật khẩu</label>
                    <div class="d-md-none w-100"></div>
                    <input type="password" name="password2" class="form-control shadow-none {{ $errors->has('password') || $errors->has('pass') ? 'is-invalid' : '' }}" placeholder="Nhập lại mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                    @if($errors->has('password'))
                    <div class="invalid-feedback">
                        @error('password') {{$message}} @enderror
                    </div>
                    @endif
                    @if($errors->has('pass'))
                    <!-- <div class="alert alert-danger"> -->

                    <!-- </div> -->
                    <div class="invalid-feedback">
                        {{ $errors->first('pass') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Ngày sinh</span> -->
                    <label for="name" class="col-sm-4 col-form-label">Ngày sinh</label>
                    <div class="d-md-none w-100"></div>
                    <input type="text" name="birthday" class="form-control shadow-none {{ $errors->has('name') || $errors->has('username') ? 'is-invalid' : '' }} {{ old('name') ? 'is-valid' : '' }}" value="{{ old('name') }}" placeholder="Nhập tên tài khoản..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                    @if($errors->has('name'))
                        <div class="invalid-feedback">@error('name') {{$message}} @enderror</div>
                    @endif
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Giới tính</span> -->
                    <label for="name" class="col-sm-4 col-form-label">Giới tính</label>
                    <div class="d-md-none w-100"></div>
                    <select class="form-select" name="gender" aria-label="Default select example" style="font-size: 13px;">
                        <!-- <option selected>Open this select menu</option> -->
                        <option value="1">Nam</option>
                        <option value="2">Nữ</option>
                    </select>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">@error('name') {{$message}} @enderror</div>
                    @endif
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Địa chỉ email</span> -->
                    <label for="name" class="col-sm-4 col-form-label">Địa chỉ email</label>
                    <div class="d-md-none w-100"></div>
                    <input type="email" name="email" class="form-control shadow-none {{ $errors->has('name') || $errors->has('username') ? 'is-invalid' : '' }} {{ old('name') ? 'is-valid' : '' }}" value="{{ old('name') }}" placeholder="Nhập địa chỉ email..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                    @if($errors->has('name'))
                        <div class="invalid-feedback">@error('name') {{$message}} @enderror</div>
                    @endif
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Số điện thọai</span> -->
                    <label for="name" class="col-sm-4 col-form-label">Số điện thoại</label>
                    <div class="d-md-none w-100"></div>
                    <input type="text" name="phone" class="form-control shadow-none {{ $errors->has('name') || $errors->has('username') ? 'is-invalid' : '' }} {{ old('name') ? 'is-valid' : '' }}" value="{{ old('name') }}" placeholder="Nhập số điện thoại..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                    @if($errors->has('name'))
                        <div class="invalid-feedback">@error('name') {{$message}} @enderror</div>
                    @endif
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-custom">
                    <!-- input-group -->
                    <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Ảnh đại diện</span> -->
                    <label for="name" class="col-sm-4 col-form-label">Ảnh đại diện</label>
                    <div class="d-md-none w-100"></div>
                    <input type="file" name="avatar" class="form-control custom-input-upload">                    
                    @if($errors->has('name'))
                        <div class="invalid-feedback">@error('name') {{$message}} @enderror</div>
                    @endif
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="row align-items-center py-2">
                <div class="col d-flex justify-content-center align-items-center">
                    <input type="checkbox">Tôi đồng ý với các điều khoản sử dụng</input>
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