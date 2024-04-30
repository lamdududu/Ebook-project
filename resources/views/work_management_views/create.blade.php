@extends('index-admin')

@section('title', 'Tác phẩm mới')

@section('main')
<main class="container py-5">
    
    <form method="post" action="{{ route('work.create') }}" class="row" enctype="multipart/form-data">
        @csrf
        <section class="col">
            <div class="d-flex justify-content-center">
                <div class="work-cover cover">
                    <img src="https://www.shutterstock.com/image-vector/image-vector-border-icon-this-600nw-1331793413.jpg" alt="" class="img-fluid rounded"></i>
                </div>
            </div>
            <div class="pt-1">
                <input type="file" name="fileCover" class="form-control custom-input-upload {{ $errors->has('fileCover') ? 'is-invalid' : '' }}">
                    @if($errors->has('fileCover'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fileCover') }}
                        </div>
                    @endif
            </div>
        </section>
        <section class="col-9">
            <div class="d-flex flex-column gap-5">
                <div>
                    <h2 style="font-weight: bold;"> Tên tác phẩm</h2>
                    <input type="text" class="form-control custom-input-text {{ $errors->has('titleWork') ? 'is-invalid' : ''}} {{ old('titleWork') ? 'is-valid' : '' }}" style="font-size: 20px;" name="titleWork" value="{{old('titleWork')}}">
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
                                    <th scope="row">Tác giả:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('author') ? 'is-invalid' : ''}} {{ old('author') ? 'is-valid' : '' }}" name="author" value="{{old('author')}}">
                                        @if($errors->has('author'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('author') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Dịch giả:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('translator') ? 'is-invalid' : ''}} {{ old('translator') ? 'is-valid' : '' }}" name="translator" value="{{old('translator')}}">
                                        @if($errors->has('translator'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('translator') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Ngôn ngữ:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('language') ? 'is-invalid' : ''}} {{ old('language') ? 'is-valid' : '' }}" name="language" value="{{old('language')}}">
                                        @if($errors->has('language'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('language') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Năm xuất bản:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('publishYear') ? 'is-invalid' : ''}} {{ old('publishYear') ? 'is-valid' : '' }}" name="publishYear" value="{{old('publishYear')}}">
                                        @if($errors->has('publishYear'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('publishYear') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Tổng biên tập:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('dirEditor') ? 'is-invalid' : ''}} {{ old('dirEditor') ? 'is-valid' : '' }}" name="dirEditor" value="{{old('dirEditor')}}">
                                        @if($errors->has('dirEditor'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('dirEditor') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Biên tập:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('editor') ? 'is-invalid' : ''}} {{ old('editor') ? 'is-valid' : '' }}" name="editor" value="{{old('editor')}}">
                                        @if($errors->has('editor'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('editor') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Nhà xuất bản:</th>
                                    <td colspan="2">
                                        <!-- <div class="d-flex justify-content-center align-items-start"> -->
                                            <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-3">
                                                <input class="form-check-input" type="radio" name="chosenPublisher" id="publisherRadio1" value="0" style="margin: 0;" @if(!old('chosenPublisher') || old('chosenPublisher') == 1) checked @endif>
                                                <div>
                                                    <select class="form-select custom-input-text" name="publisher" aria-label="Default select example" style="max-width: 400px;">
                                                        <option value="{{ old('publisher') }}" selected disabled>Chọn nhà xuất bản</option>
                                                        @foreach($publishers as $pbl)
                                                            <option value="{{$pbl->id}}">{{$pbl->nha_xuat_ban}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('publisher'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('publisher') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-3 pt-3" style="color:var(--primary)">
                                                <input class="form-check-input" type="radio" name="chosenPublisher" id="publisherRadio2" value="1" style="margin: 0;"  @if(old('chosenPublisher') && old('chosenPublisher') == 2) checked @endif>
                                                <div class="d-flex gap-1 flex-column flex-fill" style="max-width:400px;">
                                                    <div>
                                                        <input type="text" name="otherPublisher" class="form-control custom-input-text {{ $errors->has('otherPublisher') ? 'is-invalid' : ''}} {{ old('otherPublisher') ? 'is-valid' : '' }}" value="{{old('otherPublisher')}}" placeholder="Nhập nhà xuất bản khác...">
                                                        @if($errors->has('otherPublisher'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('otherPublisher') }}
                                                            </div>
                                                        @endif
                                                    </div>           
                                                    <div>
                                                        <input type="text" name="phonePublisher" value="{{ old('phonePublisher') }}" class="form-control custom-input-text {{ $errors->has('phonePublisher') ? 'is-invalid' : ''}} {{ old('phonePublisher') ? 'is-valid' : '' }}" placeholder="Nhập số điện thoại nhà xuất bản...">
                                                        @if($errors->has('phonePublisher'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('phonePublisher') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <input type="text" name="addressPublisher" value="{{ old('addressPublisher') }}" class="form-control custom-input-text {{ $errors->has('addressPublisher') ? 'is-invalid' : ''}} {{ old('addressPublisher') ? 'is-valid' : '' }}" placeholder="Nhập địa chỉ nhà xuất bản...">
                                                        @if($errors->has('addressPublisher'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('addressPublisher') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <input type="text" name="emailPublisher" value="{{ old('emailPublisher') }}" class="form-control custom-input-text {{ $errors->has('emailPublisher') ? 'is-invalid' : ''}} {{ old('emailPublisher') ? 'is-valid' : '' }}" placeholder="Nhập email nhà xuất bản...">
                                                        @if($errors->has('emailPublisher'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('emailPublisher') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </td>
                                    <td></td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Bản quyền:</th>
                                    <td colspan="2">
                                        <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-3">
                                            <input class="form-check-input" type="radio" name="chosenProvider" id="providerRadio1" value="0" style="margin: 0;"
                                                @if(!old('chosenProvider') || old('chosenProvider') == 1) checked @endif>
                                            <div>
                                                <select class="form-select custom-input-text" name="provider" aria-label="Default select example" style="max-width: 400px;">
                                                    <option value="{{ old('provider') }}" selected disabled>Chọn đơn vị cung cấp bản quyền</option>
                                                    @foreach($copyrights as $copyrightProvider)
                                                        <option value="{{$copyrightProvider->id}}">{{$copyrightProvider->ten_nha_cung_cap}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('provider'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('provider') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-3 pt-3" style="color:var(--primary)">
                                            <input class="form-check-input" type="radio" name="chosenProvider" id="providerRadio1" value="1" style="margin: 0;" @if(old('chosenProvider') && old('chosenProvider') == 2) checked @endif>
                                            <div class="d-flex gap-1 flex-column flex-fill" style="max-width:400px;">
                                                <input type="text" name="otherProvider" class="form-control custom-input-text {{ $errors->has('otherProvider') ? 'is-invalid' : ''}} {{ old('otherProvider') ? 'is-valid' : '' }}" value="{{old('otherProvider')}}" placeholder="Nhập đơn vị cung cấp bản quyền khác...">
                                                @if($errors->has('otherProvider'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('otherProvider') }}
                                                    </div>
                                                @endif
                                                <input type="text" name="phoneProvider" value="{{ old('phoneProvider') }}" class="form-control custom-input-text {{ $errors->has('phoneProvider') ? 'is-invalid' : ''}} {{ old('phoneProvider') ? 'is-valid' : '' }}" placeholder="Nhập số điện thoại đơn vị cung cấp bản quyền...">
                                                @if($errors->has('phoneProvider'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('phoneProvider') }}
                                                    </div>
                                                @endif
                                                <input type="text" name="addressProvider" value="{{ old('addressProvider') }}" class="form-control custom-input-text {{ $errors->has('addressProvider') ? 'is-invalid' : ''}} {{ old('addressProvider') ? 'is-valid' : '' }}" placeholder="Nhập địa chỉ đơn vị cung cấp bản quyền...">
                                                @if($errors->has('addressProvider'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('addressProvider') }}
                                                    </div>
                                                @endif
                                                <input type="text" name="emailProvider" value="{{ old('emailProvider') }}" class="form-control custom-input-text {{ $errors->has('emailProvider') ? 'is-invalid' : ''}} {{ old('emailProvider') ? 'is-valid' : '' }}" placeholder="Nhập email đơn vị cung cấp bản quyền...">
                                                @if($errors->has('emailProvider'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('emailProvider') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr class="align-middle">
                                    <th scope="row">Số ĐKXB:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('dkxb') ? 'is-invalid' : ''}} {{ old('dkxb') ? 'is-valid' : '' }}" name="dkxb" value="{{ old('dkxb')}}">
                                        @if($errors->has('dkxb'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('dkxb') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Mã số ISBN:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('isbn') ? 'is-invalid' : ''}} {{ old('isbn') ? 'is-valid' : '' }}" name="isbn" value="{{ old('isbn')}}">
                                        @if($errors->has('isbn'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('isbn') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Số QĐXB:</th>
                                    <td>
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('qdxb') ? 'is-invalid' : ''}} {{ old('qdxb') ? 'is-valid' : '' }}" name="qdxb" value="{{ old('qdxb')}}">
                                        @if($errors->has('qdxb'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('qdxb') }}
                                            </div>
                                        @endif
                                    </td>
                                    <th scope="row">Ngày cấp QĐXB:</th>
                                    <td>
                                        <input type="date" class="form-control custom-input-text {{ $errors->has('qdxbDate') ? 'is-invalid' : ''}} {{ old('qdxbDate') ? 'is-valid' : '' }}" name="qdxbDate" value="{{old('qdxbDate')}}">
                                        @if($errors->has('qdxbDate'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('qdxbDate') }}
                                            </div>
                                        @endif
                                    </td>
                                <tr>
                            </tbody>
                        </table>
                        <div class="d-flex flex-column gap-2 px-2" style="font-size: 13px;">
                            <div><strong>Thể loại:</strong></div>
                            <div class="d-flex justify-content-start align-items-center flex-wrap ps-lg-4 ps-3 pe-2">
                                @foreach($categories as $category)
                                    <div class="form-check form-check-inline filter">
                                        <div class="d-flex align-items-center gap-1 flex-nowrap">

                                            <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="categoryCheck.{{$category->id}}" name="categoryCheck[]"
                                                @if(old('categoryCheck'))
                                                    @foreach(old('categoryCheck') as $categoryCheck)
                                                        @if($categoryCheck == $category->id)
                                                            checked
                                                        @endif
                                                    @endforeach
                                                @endif
                                            >
                                            <label class="form-check-label" for="categoryCheck.{{$category->id}}">
                                                {{$category->ten_the_loai}}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-2 ps-lg-5 ps-4 pe-2" style="color:var(--primary)">
                                    <input class="form-check-input" type="checkbox" value="-1" id="categoryCheckNew" name="categoryCheck[]" @if(old('otherCategories')) checked @endif>                           
                                    <label class="form-check-label" for="categoryCheckNew" style="color: black;">Thêm thể loại khác: </label>
                                    <div class="flex-grow-1 flex-fill ">
                                        <input type="text" class="form-control custom-input-text {{ $errors->has('otherCategories') ? 'is-invalid' : ''}} {{ old('otherCategories') ? 'is-valid' : '' }}" name="otherCategories" value="{{old('otherCategories')}}" placeholder="Nhập (các) thể loại mới...">
                                    </div>
                                    @if($errors->has('otherCategories'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('otherCategories') }}
                                        </div>
                                    @endif
                                    <div class=""><i>
                                        <span class="text-danger">* </span>
                                        <span style="color: black;">Nhiều thể loại cách nhau bằng dấu phẩy (,)</span>
                                    </i></div>
                                </div>
                            </div>
                            @if($errors->has('categoryCheck'))
                                <div class="text-danger">
                                    Tác phẩm phải có ít nhất một thể loại
                                </div>
                            @endif
                        </div>
                        <hr>
                    </section>
                    <section class="table-responsive" style="max-width: 450px;">
                        <h5 class="pb-2" style="font-weight: bold;">Thông tin đăng tải</h5>
                        <table class="table">
                            <tbody>
                                <tr class="align-middle">
                                    <th scope="row">Tài khoản đăng tải:</th>
                                    <td>{{Session::get('user.ten_tai_khoan')}}</td>
                                <tr>
                                <tr class="align-middle">
                                    <th scope="row">Trạng thái:</th>
                                    <td>Đang chờ phê duyệt</td>
                                <tr>
                                <tr class="align-middle" name="file">
                                    <th scope="row">Tệp tin tác phẩm:</th>
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
                        {{ old('summary') }}
                    </textarea>
                    @if($errors->has('summary'))
                        <div class="invalid-feedback">
                            {{ $errors->first('summary') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="py-4 text-center new-work">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-upload"></i>
                    <span>Đăng tải</span>
                </button>
            </div>
        </section>
    </form>
</main>
@endsection