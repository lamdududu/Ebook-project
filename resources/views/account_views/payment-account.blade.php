@extends('index-user')

@section('title', 'Tài khoản thanh toán')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@section('css')

@endsection

@section('main')
    <main class="container py-3">
        @if(Session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <div class="text-danger"><strong>Bạn chưa kết nối tài khoản thanh toán!</strong></div>
                <div class="text-danger"><strong>Vui lòng kết nối để có thể thanh toán đơn hàng của bạn.</strong></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <article class="row login-form">
            <form method="post" action="{{ route('payment.connection') }}">
                @csrf
                <legend>Tài khoản thanh toán</legend>
                <div class="row justify-content-center pb-2">
                    <div class="col input-custom">
                        <!-- input-group -->
                        <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Tên đăng nhập</span> -->
                        <label for="username" class="form-label">Số tài khoản<span class="text-danger">*</span></label>
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
                <div class="row align-items-center py-2">
                    <div class="col d-flex justify-content-center align-items-center">
                        <button class="btn-sign" type="submit">Kết nối</button>
                    </div>
                </div>
            </form>
        </article>
    </main>
@endsection