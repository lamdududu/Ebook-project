@extends('account_views.log')

@section('title', 'Đăng nhập')

@section('form')
    <section class="container  col-8 col-xl-4 p-3 login-form">
        <form class="needs-validation px-4 py-1" action="{{ route('login') }}" method="post" novalidate>
            {{ csrf_field() }}
            <legend class="p-2 text-center">Đăng nhập</legend>

            <div class="row justify-content-center pb-3">

                <div class="col input-group input-custom">
                    <!-- input-group -->
                    <span class="col-sm-3 col-label-form input-group-text rounded-start-3" id="basic-addon1">Tài khoản</span>
                    <!-- <label for="name" class="form-label">Tài khoản</label> -->
                    <input type="text" name="username" class="form-control shadow-none rounded-end-3 {{ $errors->has('username') ? 'is-invalid' : '' }} {{ old('username') ? 'is-valid' : '' }}" value="{{ old('username') }}" placeholder="Nhập tên tài khoản hoặc mail..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                        @if($errors->has('username'))
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                        @endif
                </div>
            </div>
            <div class="row justify-content-center pb-2">
                <div class="col input-group input-custom">
                    <!-- input-group  padding-custom-pass -->
                    <span class="col-sm-3 col-label-form input-group-text rounded-start-3" id="basic-addon1">Mật khẩu</span>
                    <!-- <label for="name" class="form-label">Mật khẩu</label> -->
                    <input type="password" name="password" class="form-control shadow-none rounded-end-3 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            @error('password') {{$message}} @enderror
                        </div>
                    @endif
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col d-flex justify-content-center align-items-center py-2">
                    <button class="btn-sign" type="submit">Đăng nhập</button>
                </div>
                <!-- btn btn-primary btn-sm -->
            </div>
        </form>
        <hr class="hr">
        <div class="row">
            <div class="col d-flex flex-column justify-content-center align-items-center">
                <div class="forgot-pass-a">
                    <a href="#">Quên mật khẩu?</a>
                </div>
                <div class="sign-up">
                    <span>Chưa có tài khoản?</span>
                    <a href="{{ route('register.page') }}">Đăng ký</a>
                </div>
            </div>
        </div>
    </section>
@endsection