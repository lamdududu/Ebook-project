@extends('work_management_views.admin')

@section('title', 'Quản lý tác phẩm')

@section('content')
    @if($errors->has('accountCheck'))
        <div class="d-flex justify-content-end text-danger">
            Chọn ít nhất một tài khoản để thao tác
        </div>
    @endif
    <form action="" method="post">
        @csrf
        <section class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="custom-table-header">
                    <tr class="align-middle">
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col" class="text-center">Tên tác phẩm</th>
                        <th scope="col" class="text-center">Nguời đăng tải</th>
                        <th scope="col" class="text-center">Trạng thái</th>
                        <th scope="col" class="text-center">Thời điểm</th>
                        <th scope="col" class="text-center">Bản thường</th>
                        <th scope="col" class="text-center">Bản đặc biệt</th>
                        <th scope="col" class="text-center">Chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($works as $work)
                    <tr class="align-middle">
                        <th scope="row" class="text-center">{{$work->id}}</th>
                        <td>{{$work->tua_de}}</td>
                        <td class="text-center">{{$work->ten_tai_khoan}}</td>
                        <td class="text-center">
                            @if($work->ten_trang_thai_tp)
                                {{$work->ten_trang_thai_tp}}
                            @elseif($work->trang_thai == 2)
                                Đã ẩn
                            @else Đang chờ phê duyệt
                            @endif
                        </td>
                        <td class="text-center">{{$work->thoi_diem}}</td>
                        <td class="text-center">{{$work->gia_ban_thuong}} VND</td>
                        <td class="text-center">{{$work->gia_ban_db}} VND</td>
                        <td class="text-center">
                            <input class="form-check-input" type="checkbox" value="{{$work->id}}" id="categoryCheck.{{$work->id}}" name="workCheck[]"
                                @if(old('work'))
                                    @foreach(old('workCheck') as $check)
                                        @if($check == $work->id)
                                            checked
                                        @endif
                                    @endforeach
                                @endif
                            >
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </section>
        <div class="d-flex justify-content-end pb-2"><i>
            <span class="text-danger">* </span>
            <span class="desc">Chọn các tác phẩm cần ẩn trước khi thao tác</span>
        </i></div>
        <section class="d-flex gap-3 justify-content-end">
            <div class="text-center new-work">
                <button type="submit" name="block" class="btn btn-primary">
                    <i class="bi bi-eye-slash-fill"></i>
                    <span class="btn-custom-mng">Ẩn tác phẩm</span>
                </button>
            </div>
        </section>
        <div>
            {!! $works->links() !!}
        </div>
    </form>
@endsection
