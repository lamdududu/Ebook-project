@extends('account_management_views.accounts_management')

@section('content')
    <section class="table-responsive">
        <form action="" method="post">
            @csrf
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
                        <th scope="col" class="text-center">Chọn</th>
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
                            <td class="text-center">
                                <select class="form-select custom-input-text" name="provider" aria-label="Default select example" style="max-width: 400px;">
                                    <option value="{{$account->trang_thai}}" selected>{{$account->ten_trang_thai}}</option>
                                    @foreach($statuses as $status)
                                        @if($status->id != $account->trang_thai)
                                            <option value="{{$status->id}}">{{$status->ten_trang_thai}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center custom-text">
                                <input class="form-check-input" type="checkbox" value="{{$account->id}}" id="categoryCheck.{{$account->id}}" name="accountCheck[]"
                                    @if(old('account'))
                                        @foreach(old('accountCheck') as $accountC)
                                            @if($accountC == $account->id)
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
        </form>
    </section>
    <div class="d-flex justify-content-end pb-4"><i>
        <span class="text-danger">* </span>
        <span class="desc">Chọn các tài khoản cần chỉnh sửa trước khi thao tác</span>
    </i></div>
    <section class="d-flex gap-3 justify-content-end">
        <div class="text-center new-work">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-lock-fill"></i>
                <span class="btn-custom-mng">Khoá tài khoản</span>
            </button>
        </div>
        <div class="text-center new-work">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-unlock-fill"></i>
                <span class="btn-custom-mng">Mở khóa tài khoản</span>
            </button>
        </div>
        <div class="text-center new-work">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-pencil-fill"></i>
                <span class="btn-custom-mng">Chỉnh sửa</span>
            </button>
        </div>
    </section>
@endsection