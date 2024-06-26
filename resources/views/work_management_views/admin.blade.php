@extends('index-admin')

@section('title', 'Quản lý tác phẩm')

@section('main')
    <main class="container py-5 px-1">
        <div class="row">
            <article class="col-lg-2 col">
                <nav class="nav flex-column nav-tabs">
                <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('works.admin') }}">Danh sách tác phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works.public.admin') }}">Tác phẩm đã đăng tải</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works.approve.admin') }}">Tác phẩm chờ duyệt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works.hidden.admin') }}">Tác phẩm đã ẩn</a>
                    </li>
                </nav>
                <div class="py-4 text-center new-work">
                    <a href="{{ route('prices.new') }}" class="btn btn-primary">
                        <i class="bi bi-plus-square"></i>
                        <span>Giá mới</span>
                    </a>
                </div>
            </article>
            <article class="col">
                @yield('content')
            </article>
        </div>
    </main>
@endsection
