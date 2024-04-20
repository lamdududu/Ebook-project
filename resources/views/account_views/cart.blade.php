@extends('index-user')

@section('title', 'Giỏ hàng')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('main')
    <main class="container py-3">
        <!-- <div class="text-center mb-4">
            <img src="tth4/giohang.png" alt="Giỏ Hàng" style="max-width: 150px;">
        </div> -->
        <div class="row">
            <h3><strong>Giỏ hàng</strong></h3>
        </div>
        <div class="row">
            <!-- Danh sách sản phẩm -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title"><strong>Danh sách sản phẩm</strong></h5>
                            <a href="#" style="color: var(--primary);">
                                <i class="bi bi-trash3"></i>
                                <span>Xóa các tác phẩm đã chọn</span>
                            </a>
                        </div>
                        <div class="list-group">
                            @foreach($works as $work)
                                <div class="list-group-item list-group-item-action list-group-custom">
                                    <div class="d-flex w-100 gap-5 p-2 justify-content-between">
                                        <div class="flex-grow-1" style="max-width: 100px;">
                                            <img src="{{$coverStoragePath . '/' . $work->anh_bia}}" alt="Product 1" style="max-width: 100px;">
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <h5><strong>{{$work->tua_de}}</strong></h5>
                                            <div class="desc pt-1 pb-4">
                                                <p>Tác giả: <span>{{$work->tac_gia}}</span></p>
                                                <p>Nhà xuất bản: <span>{{$work->nha_xuat_ban}}</span></p>
                                                <p>Ngôn ngữ: <span>{{$work->ngon_ngu}}</span></p>
                                            </div>
                                            <div style="color: var(--primary);">Giá bán: {{$work->gia_thanh}} VNĐ<span></span></div>
                                        </div>
                                        <div class="d-flex justify-content-end gap-3 flex-grow-1">
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" checked>
                                            </div>
                                            <div>
                                                <a href="#" style="color: var(--primary);">
                                                    <i class="bi bi-trash3"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Thông tin đặt hàng -->
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Thông tin khuyến mãi</strong></h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Tổng số sản phẩm
                                <span class="badge bg-primary">2</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Tổng giá tiền
                                <span class="badge bg-primary total-price">120.000 VNĐ</span>
                            </li>
                            <li class="list-group-item">
                                <label for="discount-code" class="form-label">Mã giảm giá</label>
                                <input type="text" class="form-control" id="discount-code" placeholder="Nhập mã giảm giá (nếu có)">
                            </li>
                            <li class="list-group-item">
                                <label for="payment-method" class="form-label">Phương thức thanh toán</label>
                                <select class="form-select" id="payment-method">
                                    <option selected>Chọn phương thức thanh toán...</option>
                                    <option value="1">Thanh toán khi nhận hàng</option>
                                    <option value="2">Chuyển khoản ngân hàng</option>
                                    <option value="3">Thanh toán trực tuyến</option>
                                </select>
                            </li>
                        </ul>
                        <button class="btn btn-success mt-3">Thanh Toán</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection