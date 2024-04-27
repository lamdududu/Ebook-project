@extends('index-admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/price.css') }}">
@endsection

@section('title', 'Giá bán mới')

@section('main')
    @if(Session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div><strong>Nhập giá bán mới thành công.</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <main class="container py-5 px-1">
        <form class="row" action="{{ route('prices.create') }}" method="post">
            @csrf
            <article class="col">
                <section class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="custom-table-header">
                            <tr class="align-middle">
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">Tên tác phẩm</th>
                                <th scope="col" class="text-center">Nguời đăng tải</th>
                                <th scope="col" class="text-center">Trạng thái</th>
                                <th scope="col" class="text-center">Thời điểm</th>
                                <th scope="col" class="text-center">Giá bản thường</th>
                                <th scope="col" class="text-center">Giá bản đặc biệt</th>
                                <th scope="col" class="text-center">Chọn tác phẩm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($works as $work)
                            <tr class="align-middle">
                                <th scope="row" class="text-center">{{$work->id}}</th>
                                <td>{{$work->tua_de}}</td>
                                <td class="text-center">{{$work->ten_tai_khoan}}</td>
                                <td class="text-center">{{$work->ten_trang_thai_tp}}</td>
                                <td class="text-center">{{$work->thoi_diem}}</td>
                                <td class="text-center">{{$work->gia_ban_thuong}} VND</td>
                                <td class="text-center">{{$work->gia_ban_db}} VND</td>
                                <td class="text-center">
                                    <div class="form-check d-flex justify-content-center align-items-center filter">
                                        <input class="form-check-input" type="checkbox" value="{{$work->id}}" id="workCheck.{{$work->id}}" name="workCheck[]" 
                                            @if(old('workCheck') &&in_array($work->id, old('workCheck')))
                                                checked
                                            @endif>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </article>
            <article class="col-lg-4 price-parent">
                <section class="d-flex flex-column login-form price-child">
                    <div class="pt-3 px-3">
                        <div class="row justify-content-center pb-3">
                            <div class="col input-custom">
                                <!-- input-group -->
                                <label class="label-form" for="normalPrice" id="basic-addon1">Giá bản thường:</label>
                                <!-- <label for="name" class="form-label">Tài khoản</label> -->
                                <input type="text" name="normalPrice" class="form-control shadow-none rounded-end-3 {{ $errors->has('normalPrice') ? 'is-invalid' : '' }} {{ old('normalPrice') ? 'is-valid' : '' }}" value="{{ old('normalPrice') }}" placeholder="Nhập giá bán bản thường..." aria-label="Giá bán" aria-describedby="basic-addon1">
                                    @if($errors->has('normalPrice'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('normalPrice') }}
                                        </div>
                                    @endif
                            </div>
                        </div>
                        <div class="row justify-content-center pb-3">
                            <div class="col input-custom">
                                <!-- input-group -->
                                <label class="label-form" for="specialPrice" id="basic-addon1">Giá bản đặc biệt:</label>
                                <!-- <label for="name" class="form-label">Tài khoản</label> -->
                                <input type="text" name="specialPrice" class="form-control shadow-none rounded-end-3 {{ $errors->has('specialPrice') ? 'is-invalid' : '' }} {{ old('specialPrice') ? 'is-valid' : '' }}" value="{{ old('specialPrice') }}" placeholder="Nhập giá bán bản đặc biệt..." aria-label="Giá bán" aria-describedby="basic-addon1">
                                    @if($errors->has('specialPrice'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('specialPrice') }}
                                        </div>
                                    @endif
                            </div>
                        </div>
                        <div class="row justify-content-center pb-3">
                            <div class="col input-custom">
                                <!-- input-group -->
                                <label class="label-form" for="priceDate" id="basic-addon1">Thời điểm hiệu lực:</label>
                                <!-- <label for="name" class="form-label">Tài khoản</label> -->
                                <input type="date" name="priceDate" class="form-control shadow-none rounded-end-3 {{ $errors->has('priceDate') ? 'is-invalid' : '' }} {{ old('priceDate') ? 'is-valid' : '' }}" value="{{ old('priceDate') }}" placeholder="dd/mm/yyyy" aria-label="Giá bán" aria-describedby="basic-addon1">
                                    @if($errors->has('priceDate'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('priceDate') }}
                                        </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                    @if($errors->has('workCheck'))
                        <div class="p-3">
                            <span class="text-danger">Chọn ít nhất 1 tác phẩm</span>
                        </div>
                    @endif
                    <div class="pb-4 text-center new-work">
                        <button type="submit" class="btn btn-primary">
                            <span class="px-1"></span>
                            <i class="bi bi-floppy2-fill"></i>
                            <span class="px-2">Lưu</span>
                            <span class="px-1"></span>
                        </button>
                    </div>                   
                </section>
            </article>
        </form>
    </main>
@endsection