@extends('index-user')

@section('title', 'Đăng nhập')

@section('css')
    <link rel="stylesheet" href=" {{ asset('css/login.css') }}">
@endsection

@section('main')
    <main class="pt-5 pb-5 container justify-content-center align-items-center">
        <!-- position-absolute top-50 start-50 translate-middle -->
        <article class="row d-flex justify-content-center align-items-center gap-5">
            <div class="col-10 col-xl-6 d-flex justify-content-center">
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <!-- <div class="carousel-indicators">
                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div> -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{asset('images/image.png')}}" class="d-block w-80" alt="...">
                        </div>
                        <div class="carousel-item active">
                            <img src="{{asset('images/image1.png')}}" class="d-block w-80" alt="...">
                        </div>
                        <div class="carousel-item active">
                            <img src="{{asset('images/image.png')}}" class="d-block w-80" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <section class="container  col-8 col-xl-3 p-3 login-form">
                <form class="needs-validation" action="{{ route('login') }}" method="post" novalidate>
                    {{ csrf_field() }}
                    <legend class="p-2 text-center">Đăng nhập</legend>
                    
                    <div class="row justify-content-center pb-2">

                        <div class="col input-group">
                        <!-- input-group -->
                            <span class="input-group-text rounded-start-3" id="basic-addon1">Tài khoản</span>
                            <!-- <label for="name" class="form-label">Tài khoản</label> -->
                            <input type="text" name="name" class="form-control shadow-none rounded-end-3 {{ $errors->has('name') || $errors->has('username') ? 'is-invalid' : '' }} {{ old('name') ? 'is-valid' : '' }}" value="{{ old('name') }}" placeholder="Nhập tên tài khoản hoặc mail..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                            @if($errors->has('name'))
                                    @error('name') {{$message}} @enderror
                                </div>
                            @endif
                            @if($errors->has('username'))
                                <!-- <div class="alert alert-danger"> -->
                                    
                                <!-- </div> -->
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                            
                        </div>
                    </div>
                    <div class="row justify-content-center pb-2">
                        <div class="col input-group padding-custom-pass">
                        <!-- input-group  padding-custom-pass -->
                            <span class="input-group-text rounded-start-3" id="basic-addon1">Mật khẩu</span>
                            <!-- <label for="name" class="form-label">Mật khẩu</label> -->
                            <input type="password" name="password" class="form-control shadow-none rounded-end-3 {{ $errors->has('password') || $errors->has('pass') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
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
                    <div class="row align-items-center">
                        <div class="col d-flex justify-content-center align-items-center">
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
                            <a href="#">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </section>


        </article>
    </main>
@endsection