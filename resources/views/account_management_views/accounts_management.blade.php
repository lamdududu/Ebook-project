@extends('index-admin')

@section('title', 'Quản lý tài khoản')

@section('main')
    @if(Session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div><strong>Cập nhật trạng thái thành công.</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('success'); ?>
    @endif
    <main class="container py-5 px-1">
        <div class="row">
            <article class="col-lg-3">
                <nav class="nav flex-column nav-tabs ">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('accounts.management') }}">Tài khoản người dùng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('editor.management') }}">Tài khoản biên tập viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.management') }}">Tài khoản quản trị viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('normal.account') }}">Tài khoản đang hoạt động</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blocked.account') }}">Tài khoản bị khóa</a>
                    </li>
                </nav>
                <div class="py-4 text-center new-work">
                    <a href="{{ route('work.edit', ['id' => 0]) }}" class="btn btn-primary">
                        <i class="bi bi-file-earmark-plus-fill"></i>
                        <span>Tài khoản quản lý mới</span>
                    </a>
                </div>
            </article>
            <article class="col">
                @yield('content')
            </article>
        </div>
    </main>
@endsection