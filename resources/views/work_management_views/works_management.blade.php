@extends('index-admin')

@section('title', 'Quản lý tác phẩm')

@section('main')
    <main class="container py-5 px-1">
        <div class="row">
            <article class="col-lg-2 col">
                <nav class="nav flex-column nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('works.editor') }}">Danh sách tác phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works.public') }}">Tác phẩm đã đăng tải</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works.approve') }}">Tác phẩm chờ duyệt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works.hidden') }}">Tác phẩm đã ẩn</a>
                    </li>
                </nav>
                @yield('editButton')
            </article>
            <article class="col">
                @yield('content')
            </article>
        </div>
    </main>
@endsection