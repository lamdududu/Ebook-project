@extends('index-admin')

@section('title', 'Chỉnh sửa tác phẩm')

@section('main')
<main class="container py-5">
    
    <form method="post" action="{{ route('work.edit', ['id' => $work->id])}}" class="row">
        @csrf
        <section class="col">
            <div class="d-flex justify-content-center">
                <div class="work-cover">
                    <img src="{{ asset($coverStoragePath . '/' . $work->anh_bia) }}" alt="{{$work->anh_bia}}" class="img-fluid rounded">
                </div>
            </div>
            <div class="pt-1">
                <input type="file" name="fileCover" class="form-control custom-input-upload">
            </div>
            <div class="py-4 text-center new-work">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-pencil-fill"></i>
                    <span>Lưu</span>
                </button>
            </div>
        </section>
        <section class="col-9">
            <div class="d-flex flex-column gap-5">
                <div>
                    <h2 style="font-weight: bold;"> Tên tác phẩm</h2>
                    <input type="text" class="form-control custom-input-text" style="font-size: 20px;" name="titleWork" value="{{$work->tua_de}}">
                </div>
                <div>
                    <section class="table-responsive pb-5">
                        <h5 class="pb-2" style="font-weight: bold;">Thông tin tác phẩm</h5>
                        <table class="table">
                            <tbody>
                                <tr class="align-middle">
                                    <th scope="row">Tác giả</th>
                                    <td><input type="text" class="form-control custom-input-text" name="author" value="{{$work->tac_gia}}"></td>
                                    <th scope="row">Dịch giả</th>
                                    <td><input type="text" class="form-control custom-input-text" name="translator" value="{{$work->dich_gia}}"></td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Ngôn ngữ</th>
                                    <td><input type="text" class="form-control custom-input-text" name="language" value="{{$work->ngon_ngu}}"></td>
                                    <th scope="row">Năm xuất bản</th>
                                    <td><input type="text" class="form-control custom-input-text" name="publishYear" value="{{$work->nam_xuat_ban}}"></td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Tổng biên tập</th>
                                    <td><input type="text" class="form-control custom-input-text" name="dirEditor" value="{{$work->tong_bien_tap}}"></td>
                                    <th scope="row">Biên tập</th>
                                    <td><input type="text" class="form-control custom-input-text" name="editor" value="{{$work->bien_tap_vien}}"></td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Nhà xuất bản</th>
                                    <td><input type="text" class="form-control custom-input-text" name="publiser" value="{{$work->nha_xuat_ban}}"></td>
                                    <th scope="row">Bản quyền</th>
                                    <td>
                                        <select class="form-select custom-input-text" name="provider" aria-label="Default select example">
                                            <option selected>Chọn đơn vị cung cấp bản quyền</option>
                                            @foreach($copyrights as $copyrightProvider)
                                            <option value="{{$copyrightProvider->id}}">{{$copyrightProvider->ten_nha_cung_cap}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Số ĐKXB</th>
                                    <td><input type="text" class="form-control custom-input-text" name="dkxb" value="{{$work->so_dkxb}}"></td>
                                    <th scope="row">Mã số ISBN</th>
                                    <td><input type="text" class="form-control custom-input-text" name="isbn" value="{{$work->ma_so_isbn}}"></td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Số QĐXB</th>
                                    <td><input type="text" class="form-control custom-input-text" name="qdxb" value="{{$work->so_qdxb}}"></td>
                                    <th scope="row">Ngày cấp QĐXB</th>
                                    <td><input type="text" class="form-control custom-input-text" name="dkxbDate" value="{{ date('d-m-Y', strtotime($work->ngay_cap_qdxb)) }}"></td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Thể loại</th>
                                    <td>
                                        @foreach($categories as $category)
                                        <div class="form-check form-check-inline filter">
                                            <div class="d-flex align-items-center gap-1">

                                                <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="categoryCheck.{{$category->id}}" name="categoryCheck" 
                                                    @if(in_array($category->id, $workCate))
                                                        checked
                                                    @endif
                                                >
                                                <label class="form-check-label" for="categoryCheck.{{$category->id}}">
                                                    {{$category->ten_the_loai}}
                                                </label>
                                            </div>


                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <section class="table-responsive" style="max-width: 450px;">
                        <h5 class="pb-2" style="font-weight: bold;">Thông tin đăng tải</h5>
                        <table class="table">
                            <tbody>
                                <tr class="align-middle">
                                    <th scope="row">Tài khoản đăng tải</th>
                                    <td>{{$account->ten_tai_khoan}}</td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Trạng thái</th>
                                    <td>
                                        <select class="form-select custom-input-text" name="statusWork" aria-label="Default select example">
                                            <option selected>Thay đổi trạng thái tác phẩm</option>
                                            @foreach($statuses as $stt)
                                            <option value="{{$stt->id}}">{{$stt->ten_trang_thai_tp}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Ngày đăng tải</th>
                                    <td>{{ date('d-m-Y', strtotime($work->created_at)) }}</td>
                                <tr>
                                <tr>
                                    <th scope="row">Ngày chỉnh sửa gần nhất</th>
                                    <td>{{ date('d-m-Y', strtotime($work->updated_at)) }}</td>
                                </tr>
                                <tr class="align-middle">
                                    <th scope="row">Tệp tin hiện tại</th>
                                    <td>{{$work->tep_tin}}</td>
                                <tr>
                                <tr class="align-middle" name="file">
                                    <th scope="row">Tệp tin mới</th>
                                    <td><input type="file" name="fileWork" class="form-control custom-input-upload"></td>
                                <tr>
                            </tbody>
                        </table>
                    </section>
                </div>
                <div>
                    <h5 class="pb-2" style="font-weight: bold;" name="summary">Mô tả nội dung</h5>
                    <textarea class="form-control summary" rows="10">
                    {{$work->mo_ta_noi_dung}}
                    </textarea>
                </div>
            </div>
        </section>
    </form>
</main>
@endsection