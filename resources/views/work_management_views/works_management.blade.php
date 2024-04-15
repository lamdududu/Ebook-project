@extends('index-admin')

@section('title', 'Quản lý tác phẩm')

@section('main')
    <main class="container py-5 px-1">
        <div class="row">
            <article class="col-lg-2">
                <nav class="nav flex-column nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Danh sách tác phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works.management') }}">Tác phẩm đã đăng tải</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works.management') }}">Tác phẩm chờ duyệt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works.management') }}">Tác phẩm đã ẩn</a>
                    </li>
                </nav>
                <div class="py-4 text-center new-work">
                    <a href="{{ route('work.edit', ['id' => 0]) }}" class="btn btn-primary">
                        <i class="bi bi-file-earmark-plus-fill"></i>
                        <span>Tác phẩm mới</span>
                    </a>
                </div>
            </article>
            <article class="col">
                @yield('content')
            </article>
        </div>
    </main>
@endsection