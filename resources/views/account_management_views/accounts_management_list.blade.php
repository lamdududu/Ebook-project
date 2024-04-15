@extends('account_management_views.accounts_management')

@section('content')
    <section class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="custom-table-header">
                <tr class="align-middle">
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Tên tài khoản</th>
                    <th scope="col" class="text-center">Họ tên người dùng</th>
                    <th scope="col" class="text-center">Ngày sinh</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Số điện thoại</th>                                     
                    <th scope="col" class="text-center">Trạng thái</th>
                    <th scope="col" class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $account)
                    <tr class="align-middle">
                        <th scope="row" class="text-center">{{$account->id}}</th>
                        <td class="text-center">{{$account->ten_tai_khoan}}</td>
                        <td class="text-center">{{$account->ho_ten_nguoi_dung}}</td>
                        <td class="text-center">{{$account->ngay_sinh}}</td>
                        <td>{{$account->email}}</td>
                        <td class="text-center">{{$account->so_dien_thoai}}</td>
                        <td class="text-center">{{$account->trang_thai}}</td>
                        <!-- <td class="text-center text-truncate custom-text">
                            <a href="#"> 
                                <i class="bi bi-eye-fill"></i>
                                <span>Chi tiết</span>
                            </a>
                        </td> -->
                        <td class="text-center text-truncate custom-text">
                            <a href="#">
                                <i class="bi bi-pencil-fill"></i>
                                <span>Chỉnh sửa trạng thái</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection