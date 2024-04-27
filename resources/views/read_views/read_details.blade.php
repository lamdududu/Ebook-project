@extends('index-user')

@section('css')
    <link rel="stylesheet" href="{{asset('css/work_management.css')}}">
@endsection

@section('title', 'Chi tiết tác phẩm')

@section('main')
    <main class="container p-3">
        <article class="row gap-3">
            <section class="col-lg-3">
                <div class="d-flex justify-content-center">
                    <div class="work-cover">
                        <img src="{{ asset($coverStoragePath . '/' . $work->anh_bia) }}" alt="{{$work->anh_bia}}" class="img-fluid rounded" style="opacity: 100%">
                    </div>
                </div>
                <!-- <div class="d-flex py-4 align-items-center new-work gap-2">
                        <a href="{{ route('read.content', ['id' => $work->id]) }}" class="btn btn-primary">
                            <i class="bi bi-eye-fill"></i>
                            <span>Đọc</span>
                        </a>
                        <a href="#" class="px-3 btn btn-primary">
                            <i class="bi bi-download"></i>
                            <span>Tải xuống</span>
                        </a>
                        <a href="#" class="px-3 btn btn-primary">
                            <i class="bi bi-bag-plus-fill"></i>
                            <span>Mua sau</span>
                        </a>
                        <a href="#" class="px-3 btn btn-primary">
                            <i class="bi bi-bag-plus-fill"></i>
                            <span>Mua ngay</span>
                        </a>                  
                </div> -->
            </section>
            <section class="col">
                <form class="d-flex flex-column" action="{{ route('payment.now', ['id' => $work->id]) }}" method="post">
                    @csrf
                    <div>
                        <h2 style="font-weight: bold;">{{$work->tua_de}}</h2>
                    </div>
                    <div class="pt-2">
                        <section class="table-responsive">
                            <h5 class="pb-2" style="font-weight: bold;">Thông tin tác phẩm</h5>
                            <table class="table">
                                <tbody>
                                    <tr class="align-middle">
                                        <th scope="row">Tác giả:</th>
                                        <td>{{$work->tac_gia}}</td>
                                        @if($work->dich_gia)
                                        <th scope="row">Dịch giả:</th>
                                        <td>{{$work->dich_gia}}</td>
                                        @else
                                        <th></th>
                                        <td></td>
                                        @endif
                                    <tr>
                                    <tr class="align-middle">
                                        <th scope="row">Ngôn ngữ:</th>
                                        <td>{{$work->ngon_ngu}}</td>
                                        <th scope="row">Năm xuất bản:</th>
                                        <td>{{$work->nam_xuat_ban}}</td>
                                    <tr>
                                    <tr class="align-middle">
                                        <th scope="row">Tổng biên tập:</th>
                                        <td>{{$work->tong_bien_tap}}</td>
                                        <th scope="row">Biên tập:</th>
                                        <td>{{$work->bien_tap_vien}}</td>
                                    <tr>
                                    <tr class="align-middle">
                                        <th scope="row">Nhà xuất bản:</th>
                                        <td>{{$publisher->nha_xuat_ban}}</td>
                                        <th scope="row">Bản quyền:</th>
                                        <td>{{$copyright->ten_nha_cung_cap}}</td>
                                    <tr>
                                    <tr class="align-middle">
                                        <th scope="row">Số ĐKXB:</th>
                                        <td>{{$work->so_dkxb}}</td>
                                        <th scope="row">Mã số ISBN:</th>
                                        <td>{{$work->ma_so_isbn}}</td>
                                    <tr>
                                    <tr class="align-middle">
                                        <th scope="row">Số QĐXB:</th>
                                        <td>{{$work->so_qdxb}}</td>
                                        <th scope="row">Ngày cấp QĐXB:</th>
                                        <td>{{ date('d-m-Y', strtotime($work->ngay_cap_qdxb)) }}</td>
                                    <tr>
                                    <tr class="align-middle">
                                        <th scope="row">Thể loại:</th>
                                        <td>
                                            @foreach($categories as $category)
                                            <span>{{$category->ten_the_loai}}</span>
                                            @if (!$loop->last)
                                            <span>/ </span> <!-- Hiển thị dấu phẩy nếu không phải là phần tử cuối cùng -->
                                            @endif
                                            @endforeach
                                        </td>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <th>Phiên bản:</th>
                                        <td colspan="2" style="font-size: 14px;">
                                            <div>
                                                <input type="hidden" name="normalPrice" value="{{$prices->gia_ban_thuong}}">
                                                <input type="hidden" name="specialPrice" value="{{$prices->gia_ban_db}}">
                                                <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-2">
                                                    <input class="form-check-input" type="radio" name="payNow" id="inlineRadio1.{{$work->id}}" value="1" style="margin: 0;" checked>
                                                    <label class="form-check-label d-flex gap-3" for="inlineRadio2">
                                                        <strong>Bản thường:</strong>
                                                        <strong>{{ number_format($prices->gia_ban_thuong, 0, ',', '.') }} VNĐ</strong>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-2" style="color:var(--primary)">
                                                    <input class="form-check-input" type="radio" name="payNow" id="inlineRadio2.{{$work->id}}" value="2" style="margin: 0;">
                                                    <label class="form-check-label d-flex gap-3" for="inlineRadio2">
                                                        <strong>Bản đặc biệt:</strong>
                                                        <strong>{{ number_format($prices->gia_ban_db, 0, ',', '.') }} VNĐ</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td></td>
                                    <tr>
                                </tbody>
                            </table>

                        </section>
                    </div>
                    <div class="d-flex pt-3 pb-2 justify-content-end align-items-center new-work gap-2">
                        <a href="{{ route('read.content', ['id' => $work->id]) }}" class="btn btn-primary">
                            <i class="bi bi-eye-fill"></i>
                            <span>Đọc thử</span>
                        </a>
                        <a href="{{ route('download', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                            <i class="bi bi-download"></i>
                            <span>Tải xuống</span>
                        </a>
                        <a href="{{ route('cart.add', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                            <i class="bi bi-bag-plus-fill"></i>
                            <span>Mua sau</span>
                        </a>
                        <div class="text-center new-work">
                            <button type="submit" name="block" class="btn btn-primary">
                                <i class="bi bi-credit-card-fill"></i>
                                <span class="btn-custom-mng">Mua ngay</span>
                            </button>
                        </div>               
                    </div>
                    <div class="py-5">
                        <h5 style="font-weight: bold;">Mô tả nội dung</h5>
                        <div>
                            {!! nl2br($work->mo_ta_noi_dung) !!}
                        </div>
                    </div>
                </form>
            </section>
        </article>
    </main>
@endsection