@extends('work_management_views.works_management')

@section('editButton')
    <div class="py-4 text-center new-work">
        <a href="{{ route('work.new') }}" class="btn btn-primary">
            <i class="bi bi-file-earmark-plus-fill"></i>
            <span>Tác phẩm mới</span>
        </a>
    </div>
@endsection

@section('content')
    <section class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="custom-table-header">
                <tr class="align-middle">
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Tên tác phẩm</th>
                    <th scope="col" class="text-center">Tác giả</th>
                    <th scope="col" class="text-center">Nguời đăng tải</th>
                    <th scope="col" class="text-center">Trạng thái</th>
                    <th scope="col" class="text-center">Ngày đăng tải</th>
                    <th scope="col" class="text-center">Ngày chỉnh sửa</th>
                    <th scope="col" colspan=2 class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $work)
                <tr class="align-middle">
                    <th scope="row" class="text-center">{{$work->id}}</th>
                    <td>{{$work->tua_de}}</td>
                    <td>{{$work->tac_gia}}</td>
                    <td class="text-center">{{$work->ten_tai_khoan}}</td>
                    <td class="text-center">{{$work->ten_trang_thai_tp}}</td>
                    <td class="text-center">{{$work->created_at}}</td>
                    <td class="text-center">{{$work->updated_at}}</td>
                    <td class="text-center text-truncate custom-text">
                        <a href="{{ route('work.details', ['id' => $work->id]) }}">
                            <i class="bi bi-eye-fill"></i>
                            <span>Chi tiết</span>
                        </a>
                    </td>
                    <td class="text-center text-truncate custom-text">
                        <a href="{{ route('work.edit', ['id' => $work->id]) }}">
                            <i class="bi bi-pencil-fill"></i>
                            <span>Chỉnh sửa</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <section>
    </section>
@endsection