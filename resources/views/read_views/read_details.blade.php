@extends('index-user')

@section('css')
    <link rel="stylesheet" href="{{asset('css/work_management.css')}}">
@endsection

@section('title', '{{$work->ten_tac_pham}}')

@section('main')
    <main class="container py-3">
        <article class="row gap-3 align-items-center">
            <section class="col-3">
                <div class="d-flex justify-content-center">
                    <div class="work-cover">
                        <img src="{{ asset($coverStoragePath . '/' . $work->anh_bia) }}" alt="{{$work->anh_bia}}" class="img-fluid rounded" style="opacity: 100%">
                    </div>
                </div>
                <div class="d-flex py-4 align-items-center new-work gap-2">
                    <!-- <div> -->
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
                            <span>Mua</span>
                        </a>
                    <!-- </div>                  -->
                    
                </div>
            </section>
            <section class="col">
                <section class="d-flex flex-column gap-3">
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
                                        <td>{{$work->nha_xuat_ban}}</td>
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
                                </tbody>
                            </table>

                        </section>
                    </div>
                    <div>
                        <h5 style="font-weight: bold;">Mô tả nội dung</h5>
                        <div>
                            {!! nl2br($work->mo_ta_noi_dung) !!}
                        </div>
                    </div>
                    </div>
                </section>
        </article>
    </main>
@endsection