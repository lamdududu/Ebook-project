@extends('index-admin')

@section('title', 'Chỉnh sửa tác phẩm')

@section('main')
<main class="container py-5">
    
    <form method="post" action="{{ route('work.update', ['id' => $work->id])}}" class="row">
        @csrf
        <section class="col">
            <div class="d-flex justify-content-center">
                <div class="work-cover">
                    <img src="{{ asset($coverStoragePath . '/' . $work->anh_bia) }}" alt="{{$work->anh_bia}}" class="img-fluid rounded">
                </div>
            </div>
            <div class="pt-1">
                <input type="file" name="fileCover" class="form-control custom-input-upload {{ $errors->has('username') ? 'is-invalid' : '' }}">
                    @if($errors->has('fileCover'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fileCover') }}
                        </div>
                    @endif
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
                    <input type="text" class="form-control custom-input-text {{ $errors->has('titleWork') ? 'is-invalid' : ''}} {{ old('titleWork') ? 'is-valid' : '' }}" style="font-size: 20px;" name="titleWork" value="{{old('titleWork') ?: $work->tua_de}}">
                    @if($errors->has('titleWork'))
                        <div class="invalid-feedback">
                            {{ $errors->first('titleWork') }}
                        </div>
                    @endif
                </div>
                <div>
                    <section class="table-responsive pb-5">
                        <h5 class="pb-2" style="font-weight: bold;">Thông tin tác phẩm</h5>
                        <table class="table">
                            <tbody>
                                <tr class="align-middle">
                                    <th scope="row">Tác giả</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('author') ? 'is-invalid' : ''}} {{ old('author') ? 'is-valid' : '' }}" name="author" value="{{old('author') ?: $work->tac_gia}}">
                                        @if($errors->has('author'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('author') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Dịch giả</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('translator') ? 'is-invalid' : ''}} {{ old('translator') ? 'is-valid' : '' }}" name="translator" value="{{old('translator') ?: $work->dich_gia}}">
                                        @if($errors->has('translator'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('translator') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Ngôn ngữ</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('language') ? 'is-invalid' : ''}} {{ old('language') ? 'is-valid' : '' }}" name="language" value="{{old('language') ?: $work->ngon_ngu}}">
                                        @if($errors->has('language'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('language') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Năm xuất bản</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('publishYear') ? 'is-invalid' : ''}} {{ old('publishYear') ? 'is-valid' : '' }}" name="publishYear" value="{{old('publishYear') ?: $work->nam_xuat_ban}}">
                                        @if($errors->has('publishYear'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('publishYear') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Tổng biên tập</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('dirEditor') ? 'is-invalid' : ''}} {{ old('dirEditor') ? 'is-valid' : '' }}" name="dirEditor" value="{{old('dirEditor') ?: $work->tong_bien_tap}}">
                                        @if($errors->has('dirEditor'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('dirEditor') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Biên tập</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('editor') ? 'is-invalid' : ''}} {{ old('editor') ? 'is-valid' : '' }}" name="editor" value="{{old('editor') ?: $work->bien_tap_vien}}">
                                        @if($errors->has('editor'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('editor') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Nhà xuất bản</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('publiser') ? 'is-invalid' : ''}} {{ old('publiser') ? 'is-valid' : '' }}" name="publiser" value="{{old('publiser') ?: $work->nha_xuat_ban}}">
                                        @if($errors->has('publiser'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('publiser') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Bản quyền</th>
                                    <td>
                                        <select class="form-select custom-input-text" name="provider" aria-label="Default select example">
                                            <option value="{{$copyright->id}}" selected>{{$copyright->ten_nha_cung_cap}}</option>
                                            @foreach($copyrights as $copyrightProvider)
                                            <option value="{{$copyrightProvider->id}}">{{$copyrightProvider->ten_nha_cung_cap}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Số ĐKXB</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('dkxb') ? 'is-invalid' : ''}} {{ old('dkxb') ? 'is-valid' : '' }}" name="dkxb" value="{{ old('dkxb') ?: $work->so_dkxb }}">
                                        @if($errors->has('dkxb'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('dkxb') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Mã số ISBN</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('isbn') ? 'is-invalid' : ''}} {{ old('isbn') ? 'is-valid' : '' }}" name="isbn" value="{{ old('isbn') ?: $work->ma_so_isbn }}">
                                        @if($errors->has('isbn'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('isbn') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Số QĐXB</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('qdxb') ? 'is-invalid' : ''}} {{ old('qdxb') ? 'is-valid' : '' }}" name="qdxb" value="{{ old('qdxb') ?: $work->so_qdxb }}">
                                        @if($errors->has('qdxb'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('qdxb') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Ngày cấp QĐXB</th>
                                    <td>
                                        <input type="date" class="form-control custom-input-text {{ $errors->has('qdxbDate') ? 'is-invalid' : ''}} {{ old('qdxbDate') ? 'is-valid' : '' }}" name="qdxbDate" value="{{ old('qdxbDate') ?: \Carbon\Carbon::parse($work->ngay_cap_qdxb)->format('d-m-Y') }}">
                                        @if($errors->has('qdxbDate'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('qdxbDate') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Thể loại</th>
                                    <td>
                                        @foreach($categories as $category)
                                            <div class="form-check form-check-inline filter">
                                                <div class="d-flex align-items-center gap-1">

                                                    <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="categoryCheck.{{$category->id}}" name="categoryCheck[]" 
                                                        @if(in_array($category->id, $workCate))
                                                            checked
                                                        @endif>
                                                    <label class="form-check-label" for="categoryCheck.{{$category->id}}">
                                                        {{$category->ten_the_loai}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if($errors->has('categoryCheck'))
                                            <div class="text-danger">
                                               Chọn ít nhất một thể loại
                                            </div>
                                        @endif
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
                                            <option value="$status->id" selected>{{$status->ten_trang_thai_tp}}</option>
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
                                    <td>
                                        <input type="file" name="fileWork" class="form-control custom-input-upload {{ $errors->has('fileWork') ? 'is-invalid' : ''}}">
                                        @if($errors->has('fileWork'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('fileWork') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                            </tbody>
                        </table>
                    </section>
                </div>
                <div>
                    <h5 class="pb-2" style="font-weight: bold;">Mô tả nội dung</h5>
                    <textarea class="form-control summary {{ $errors->has('summary') ? 'is-invalid' : ''}}" name="summary" rows="10">
                        {{ old('summary') ?: $work->mo_ta_noi_dung}}
                    </textarea>
                    @if($errors->has('summary'))
                        <div class="invalid-feedback">
                            {{ $errors->first('summary') }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </form>
</main>
@endsection