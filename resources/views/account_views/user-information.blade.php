@extends('index-user')

@section('title', 'Thông tin tài khoản')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account-info.css') }}">
@endsection

@section('main')
<main class="container py-3">
    <article class="row gap-5">
        <section class="col-lg-3">
        </section>
        <section class="col">
            <div class="text-center mt-4 rounded-circle avatar">
                <?php $avt = 'https://static.vecteezy.com/system/resources/previews/022/123/337/non_2x/user-icon-profile-icon-account-icon-login-sign-line-vector.jpg'; ?>
                <img src="{{$account->anh_dai_dien ?: $avt}}" class="img-fluid" alt="avatar">
            </div>
            <section class="table-responsive py-5">
                    <h5 class="pb-2" style="font-weight: bold;">Thông tin cơ bản</h5>
                    <table class="table" style="font-size: 15px;">
                        <tbody>
                            <tr class="align-middle">
                                <th scope="row">Họ và tên:</th>
                                <td>{{$account->ho_ten_nguoi_dung}}</td>
                            <tr class="align-middle">
                                <th scope="row">Tên tài khoản:</th>
                                <td>{{$account->ten_tai_khoan}}</td>
                            </tr>
                                <th scope="row">Ngày sinh:</th>
                                <td>{{\Carbon\Carbon::parse($account->ngay_sinh)->format('d-m-Y')}}</td>
                            <tr class="align-middle">
                                <th scope="row">Giới tính:</th>
                                <td>
                                    @if($account->gioi_tinh == 1)
                                    Nam
                                    @elseif($account->gioi_tinh == 2)
                                    Nữ
                                    @else Khác
                                    @endif
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th scope="row">Email:</th>
                                <td>{{$account->email}}</td>
                            </tr>
                            <tr class="align-middle">
                                <th scope="row">Số điện thoại:</th>
                                <td>{{$account->so_dien_thoai}}</td>
                            <tr>
                            @if(Session::get('user.loai_tai_khoan') == 3)
                                <tr class="align-middle">
                                    <th scope="row">Số tài khoản thanh toán:</th>
                                    <td>{{$accPayment ? $accPayment->so_tai_khoan : 'Chưa có tài khoản thanh toán'}}</td>
                                <tr>
                            @endif
                    </table>
                    <div class="py-2 text-center new-work">
                        <a href="{{ route('admin.edit', ['id' => $account->id]) }}" class="btn btn-primary btn-edit-info">
                            <i class="bi bi-pencil-fill"></i>
                            <span>Chỉnh sửa thông tin</span>
                        </a>
                    </div>
                </section>
        </section>
        <section class="col-lg-3">
        </section>
    </article>
</main>
@endsection