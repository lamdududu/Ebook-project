@extends('index-user')

@section('title', 'Giỏ hàng')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('main')

    @if(Session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert" style="max-width: 480px;">
            <div class="text-danger pb-3"><strong>Bạn chưa kết nối tài khoản thanh toán!</strong></div>
            <div><strong>Bạn có muốn kết nối để thanh toán đơn hàng của bạn ngay bây giờ không?</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="pt-1">
                <a href="{{ route('payment.account') }}" class="btn px-2" style="color: rgb(102, 77, 3);"><strong>Có</strong></a>
                <button type="button" class="btn btn-alert text-danger px-2" data-bs-dismiss="alert" aria-label="Close"><strong>Không</strong></button>
            </div>
        </div>
        <?php session()->forget('warning'); ?>
    @endif
    @if(Session()->has('success-connection'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div><strong>Kết nối tài khoản thanh toán thành công.</strong></div>
            <div><strong>Bây giờ bạn đã có thể thanh toán đơn hàng của mình.</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('success-connection'); ?>
    @endif
    @if(Session()->has('success-payment'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div><strong>Thanh toán thành công.</strong></div>
            <div><strong>Hy vọng bạn sẽ tiếp tục đọc và sưu tầm những quyển sách hay cùng E-read.</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('success-payment'); ?>
    @endif
    <main class="container py-3">
        <!-- <div class="text-center mb-4">
            <img src="tth4/giohang.png" alt="Giỏ Hàng" style="max-width: 150px;">
        </div> -->
        <div class="row">
            <h3><strong>Giỏ hàng</strong></h3>
        </div>
        <form method="post" action="{{ route('cart.button') }}">
            @csrf
            <div class="row">
                    <!-- Danh sách sản phẩm -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title"><strong>Danh sách sản phẩm</strong></h5>
                                    <button type="submit" name="deleteAllWorks" class="btn-delete">
                                        <i class="bi bi-trash3"></i>
                                        <span>Xóa các tác phẩm đã chọn</span>
                                    </button>
                                </div>
                                @if($errors->has('workCheck'))
                                    <div class="text-danger pb-2">
                                        <i>{{$errors->first('workCheck')}}</i>
                                    </div>
                                @elseif($errors->has('version'))
                                    <div class="text-danger pb-2">
                                        <i>{{$errors->first('version')}}</i>
                                    </div>
                                @endif
                                <div class="list-group">
                                    @foreach($works as $work)
                                        <div class="list-group-item list-group-item-action list-group-custom" @if($work->trang_thai != 1) style="background-color; opacity: 70%;" @endif>
                                            <div class="d-flex w-100 gap-5 p-2 justify-content-between">
                                                <div class="flex-grow-1" style="max-width: 100px;">
                                                    <img src="{{$coverStoragePath . '/' . $work->anh_bia}}" class="rounded-3" alt="Product 1" style="max-width: 100px;">
                                                </div>
                                                <div class="d-flex flex-column flex-grow-1">
                                                    @if($work->trang_thai != 1) 
                                                        <div class="text-danger">
                                                            <i><strong>Ngừng kinh doanh</strong></i>
                                                        </div>
                                                    @endif
                                                    <a href="{{ route('read.details', ['id' => $work->id]) }}" class="title" @if($work->trang_thai != 1) style="pointer-events: none;" @endif>
                                                        <h5><strong>{{$work->tua_de}}</strong></h5>
                                                    </a>
                                                    <div class="desc pt-1 pb-4">
                                                        <p>Tác giả: <span>{{$work->tac_gia}}</span></p>
                                                        <p>Nhà xuất bản: <span>{{$work->nha_xuat_ban}}</span></p>
                                                        <p>Ngôn ngữ: <span>{{$work->ngon_ngu}}</span></p>
                                                    </div>
                                                    <div class="desc" style="font-weight: bold">
                                                        <p>Phiên bản</p>
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-2">
                                                                <input class="form-check-input" type="radio" name="version[{{$work->id}}]" id="inlineRadio1.{{$work->id}}" value="1" style="margin: 0;" @if($work->trang_thai != 1) disabled @endif>
                                                                <label class="form-check-label" for="inlineRadio1">Bản thường: {{$work->gia_ban_thuong}} VNĐ</label>
                                                            </div>
                                                            <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-2" style="color:var(--primary)">
                                                                <input class="form-check-input" type="radio" name="version[{{$work->id}}]" id="inlineRadio2.{{$work->id}}" value="2" style="margin: 0;" @if($work->trang_thai != 1) disabled @endif>
                                                                <label class="form-check-label" for="inlineRadio2">Bản đặc biệt: {{$work->gia_ban_db}} VNĐ</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end gap-3 flex-grow-1">
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" id="workCheck.{{$work->id}}" value="{{$work->id}}" name="workCheck[]" class="form-check-input" @if($work->trang_thai != 1) disabled @else checked @endif>
                                                    </div>
                                                    <div>
                                                        <button type="submit" name="deleteWork" value="{{$work->id}}" class="btn-delete">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="desc pt-2"><i><span class="text-danger">* </span>Phiên bản thường chỉ có thể đọc sách trực tuyến, phiên bản đặc biệt có thể đọc sách trực tuyến và tải sách.</i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Thông tin khuyến mãi -->
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Thông tin khuyến mãi <i class="bi bi-gift-fill" style="color: var(--primary);"></i></strong></h5>
                                <ul class="list-group">
                                    @foreach($promotions as $promotion)
                                        <li class="list-group-item">
                                            <h6><strong style="color: var(--primary);">{{$promotion->ten_chuong_trinh}}</strong></h6>
                                            <p class="desc"><strong>
                                                Từ ngày 
                                                <span>{{\Carbon\Carbon::parse($promotion->ngay_bat_dau)->format('d-m-Y')}}</span>
                                                đến hết ngày 
                                                <span>{{\Carbon\Carbon::parse($promotion->ngay_ket_thuc)->format('d-m-Y')}}</span>
                                            </strong></p>
                                            <div class="desc">{{$promotion->mo_ta_khuyen_mai}}</div>
                                        </li>
                                    @endforeach
                                </ul>
                                <p class="desc pt-2 text-center"><i><span class="text-danger">* </span>Không thể áp dụng nhiều chương trình khuyến mãi cùng lúc.</i></p>
                            </div>
                        </div>
                        <div class="py-2 text-center">
                            <button type="submit" name="payment" class="btn btn-primary btn-pay">
                                <i class="bi bi-pencil-fill"></i>
                                <span>Thanh toán</span>
                            </button>
                        </div>
                    </div>
            </div>
        </form>
    </main>
@endsection