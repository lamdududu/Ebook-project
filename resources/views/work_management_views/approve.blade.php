@extends('work_management_views.admin')

@section('title', 'Quản lý tác phẩm')

@section('content')
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
                    <th scope="col" class="text-center">Thao tác</th>
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
                    <td class="text-center text-truncate custom-text">
                        <a href="{{ route('admin.details', ['id' => $work->id]) }}">
                            <i class="bi bi-eye-fill"></i>
                            <span>Xem chi tiết</span>
                        </a>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </section>
@endsection
