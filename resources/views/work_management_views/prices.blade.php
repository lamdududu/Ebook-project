@extends('work_management_views.admin')

@section('title', 'Quản lý tác phẩm')

@section('editButton')
    <div class="py-4 text-center new-work">
        <a href="{{ route('prices.new') }}" class="btn btn-primary">
            <i class="bi bi-plus-square"></i>
            <span>Giá mới</span>
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
                    <th scope="col" class="text-center">Nguời đăng tải</th>
                    <th scope="col" class="text-center">Trạng thái</th>
                    <th scope="col" class="text-center">Thời điểm</th>
                    <th scope="col" class="text-center">Giá bán</th>
                </tr>
            </thead>
            <tbody>
                @foreach($works as $work)
                <tr class="align-middle">
                    <th scope="row" class="text-center">{{$work->id}}</th>
                    <td>{{$work->tua_de}}</td>
                    <td class="text-center">{{$work->ten_tai_khoan}}</td>
                    <td class="text-center">{{$work->ten_trang_thai_tp}}</td>
                    <td class="text-center">{{$work->thoi_diem}}</td>
                    <td class="text-center">{{$work->gia_thanh}} VND</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
