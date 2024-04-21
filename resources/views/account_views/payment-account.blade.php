@extends('index-user')

@section('title', 'Tài khoản thanh toán')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@section('css')

@endsection

@section('main')
    <main class="container py-3 px-5">
        <article class="row">
            <div class="col-md-3 col-lg-4"></div>
            <section class="col login-form">
                <form class="p-3" method="post" action="{{ route('payment.connection') }}">
                    @csrf
                    <legend>Tài khoản thanh toán</legend>
                    <div class="row justify-content-center pb-2">
                        <div class="col input-custom">
                            <!-- input-group -->
                            <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Tên đăng nhập</span> -->
                            <label for="payAcc" class="form-label">Số tài khoản<span class="text-danger">*</span></label>
                            <!-- <div class="d-md-none w-100"></div> -->
                            <input type="text" name="payAcc" class="form-control shadow-none {{ $errors->has('payAcc') ? 'is-invalid' : '' }} {{ old('payAcc') ? 'is-valid' : '' }}" value="{{ old('payAcc') }}" placeholder="Nhập số tài khoản.." aria-label="Tài khoản" aria-describedby="basic-addon1">
                            @if($errors->has('payAcc'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payAcc') }}
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
                            @if($errors->has('password_confirmation'))
                                <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation')}}
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
                <div class="text-center pb-3 px-1" style="font-size: 13px; color: rgba(38, 37, 37, 0.826);"><i><span class="text-danger">* </span>Liên kết tài khoản thanh toán để có thể sử dụng các dịch vụ mua sách điện tử của E-read.</i></div>
            </section>
            <div class="col-md-3 col-lg-4"></div>
        </article>
    </main>
@endsection