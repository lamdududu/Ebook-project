@extends('index-admin')

@section('title', 'Chi tiết tác phẩm')

@section('main')
    <main class="container px-3 py-5">
        <form class="row" method="post" action="">
            @csrf
            <section class="col-lg-3">
                <div class="d-flex justify-content-center">
                    <div class="work-cover">
                        <img src="{{ asset($coverStoragePath . '/' . $work->anh_bia) }}" alt="{{$work->anh_bia}}" class="img-fluid rounded" style="opacity: 100%">
                    </div>
                </div>
                <div class="py-4 text-center new-work">
                    <button type="submit" name="block" class="btn btn-primary">
                        <i class="bi bi-eye-slash-fill"></i>
                        <span class="btn-custom-mng">Duyệt tác phẩm</span>
                    </button>
                </div>
            </section>
            <section class="col">
                <div class="d-flex flex-column gap-5">
                    <div>
                        <h2 style="font-weight: bold;">{{$work->tua_de}}</h2>
                    </div>
                    <div>
                        <section class="table-responsive pb-5">
                            <h5 class="pb-2" style="font-weight: bold;">Thông tin tác phẩm</h5>
                            <table class="table">
                                <tbody>
                                    <tr class="align-middle">
                                        <th scope="row">Tác giả:</th>
                                        <td>{{$work->tac_gia}}</td>
                                        <th scope="row">Dịch giả:</th>
                                        @if($work->dich_gia)
                                            <td>{{$work->dich_gia}}</td>
                                        @else
                                            <td>Không có</td>
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
                                                    <span>/ </span> <!-- Hiển thị dấu / nếu không phải là phần tử cuối cùng -->
                                                @endif
                                            @endforeach
                                        </td>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <th scope="row">Giá bản thường:</th>
                                        <td>
                                            <input type="text" class="form-control custom-input-text {{ $errors->has('normal') ? 'is-invalid' : ''}} {{ old('normal') ? 'is-valid' : '' }}" name="normal" value="{{ old('normal')}}">
                                            @if($errors->has('normal'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('normal') }}
                                                </div>
                                            @endif
                                        </td>
                                        <th scope="row">Giá bản đặc biệt:</th>
                                        <td>
                                            <input type="text" class="form-control custom-input-text {{ $errors->has('special') ? 'is-invalid' : ''}} {{ old('special') ? 'is-valid' : '' }}" name="special" value="{{ old('special')}}">
                                            @if($errors->has('special'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('special') }}
                                                </div>
                                            @endif
                                        </td>
                                    <tr>
                                </tbody>
                            </table>
                            
                        </section>
                        <section class="table-responsive" style="max-width: 450px;">
                            <h5 class="pb-2" style="font-weight: bold;">Thông tin đăng tải</h5>
                            <table class="table">
                                <tbody>
                                    <tr class="align-middle">
                                        <th scope="row">Tài khoản đăng tải:</th>
                                        <td>{{$account->ten_tai_khoan}}</td>
                                    <tr>
                                    <tr class="align-middle">
                                        <th scope="row">Trạng thái:</th>
                                        <td>Đang chờ duyệt</td>
                                    <tr>
                                    <tr class="align-middle">
                                        <th scope="row">Ngày đăng tải:</th>
                                        <td>{{ date('d-m-Y', strtotime($work->created_at)) }}</td>
                                    <tr>
                                    <tr>
                                        <th scope="row">Ngày chỉnh sửa gần nhất:</th>
                                        <td>{{ date('d-m-Y', strtotime($work->updated_at)) }}</td>
                                    </tr>
                                    <tr class="align-middle">
                                        <th scope="row">Tệp tin:</th>
                                        <td>{{$work->tep_tin}}</td>
                                    <tr>
                                </tbody>
                            </table>
                        </section>
                    </div>
                    <div>
                        <h5 class="pb-2" style="font-weight: bold;">Mô tả nội dung</h5>
                        <div>
                            {!! nl2br($work->mo_ta_noi_dung) !!}
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </main>
@endsection