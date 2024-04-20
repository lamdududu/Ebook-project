@extends('index-user')

@section('title', 'Thanh toán')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('main')
    <main class="container py-4">
        <article class="row">
            <div class="col-md-2 col-lg-3"></div>
            <section class="col login-form">
            <form class="needs-validation p-3" action="{{ route('payment') }}" method="post" novalidate>
                    @csrf
                    <legend class="p-2 text-center">Hoá đơn thanh toán</legend>
                    <div class="row justify-content-center pb-2">
                        <div class="py-2"><strong>Danh sách tác phẩm</strong></div>
                        
                            @foreach($works as $work)
                                <div class="list-group-item list-group-item-action px-3">
                                    <input type="hidden" name="workId" value="{{$work->id}}">
                                    <input type="hidden" name="workPrice" value="{{$work->gia_thanh}}">
                                    <div class="list-group-item list-group-item-action list-group-custom">
                                        <div class="d-flex w-100 gap-5 px-4 py-2 justify-content-between align-items-center">
                                            <div class="flex-grow-1 pl-2" style="max-width: 50px;">
                                                <img src="{{$coverStoragePath . '/' . $work->anh_bia}}" class="rounded-3" alt="Product 1" style="max-width: 50px;">
                                            </div>                                       
                                            <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                <p><strong>{{$work->tua_de}}</strong></p>
                                                <p class="desc">Phiên bản:
                                                    @if($work->phien_ban)
                                                        Bản thường
                                                    @else Bản đặc biệt
                                                    @endif
                                                </p>                                            
                                                <p class="desc">Giá bán: {{$work->gia_thanh}} VNĐ<span></span></p>
                                            </div>
                                            <div class="desc">x1</div> 
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    <div class="row justify-content-center p">
                        <div><strong>Số lượng: </strong><span>{{$count}}</span></div>
                        <div><strong>Thành tiền: </strong><span>{{$totalBill}} VNĐ</span></div>
                    </div>
                    <hr class="hr">
                    <div class="row justify-content-center pb-2">
                        <div class="col input-custom">
                            <!-- input-group -->
                            <!-- <span class="input-group-text rounded-start-3" id="basic-addon1">Tên đăng nhập</span> -->
                            <label for="payAcc" class="form-label">Số tài khoản thanh toán: <span class="text-danger">*</span></label>
                            <!-- <div class="d-md-none w-100"></div> -->
                            <input type="text" name="payAcc" class="form-control shadow-none {{ $errors->has('payAcc') ? 'is-invalid' : '' }} {{ old('payAcc') ? 'is-valid' : '' }}" value="{{ old('payAcc') }}" placeholder="Nhập số tài khoản..." aria-label="Tài khoản" aria-describedby="basic-addon1">
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
                            <label for="password" class="form-label">Mật khẩu: <span class="text-danger">*</span></label>
                            <!-- <div class="d-md-none w-100"></div> -->
                            <input type="password" name="password" class="form-control shadow-none {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row align-items-center py-2">
                        <div class="col d-flex justify-content-center align-items-center">
                            <button class="btn-sign" type="submit">Xác nhận thanh toán</button>
                        </div>
                        <!-- btn btn-primary btn-sm -->
                    </div>
                </form>
            </section>
            </section>
            <div class="col-md-2 col-lg-3"></div>
        </article>
    </main>
@endsection