<!DOCTYPE tml>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('css/index-user.css')}}">
    @yield('css')
    <title>@yield('title')</title>
</head>

<body class="d-flex flex-column min-vh-100 gap-1 position-relative">
    <header class="header container-fluid  d-flex justify-content-center custom-header">
        <div class="col">
            <nav class="navbar navbar-expand-md ">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse px-5" id="navbarTogglerDemo01">
                    <a class="navbar-brand fs-3" href="{{ route('home') }}" style="color: var(--primary);">
                        <i class='bi bi-book'></i>
                        <span><strong>E-read</strong></span>
                    </a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 px-lg-5">
                        <li class="nav-item px-lg-3">
                            <a class="nav-link fs-5" href="{{ route('works') }}">
                                <i class='bi bi-view-list'></i>
                                <strong>Tác phẩm</strong>
                            </a>
                        </li>
                        <li class="nav-item px-lg-3">
                            <a class="nav-link fs-5" href="#">
                                <i class='bi bi-chat-right-dots'></i>
                                <strong>Box-chat</strong>
                            </a>
                        </li>
                    </ul>
                    <!-- <div class="d-flex justify-content-end pe-3 flex-lg-row align-items-center gap-lg-3" style="padding: 15px; "> -->
                        <form class="d-flex justity-content-start" role="search">
                            
                            <input class="form-control me-1 search-custom" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                            <button class="btn me-3 search-btn" type="submit"><i class='bi bi-search'></i></button>
                        </form>
                        <a class="nav-link px-lg-4" href="#">
                            <i class="bi bi-collection"></i>
                            <strong>Thư viện</strong>
                        </a>
                        <li class="nav-item dropdown">
                            @if(session()->has('userName'))
                                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bi bi-person'></i>
                                    <strong>{{session('userName')}}</strong>
                                </a>
                                <ul class="dropdown-menu custom-dropdown-account" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item" href="#">Thông tin tài khoản</a></li>
                                    <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="{{ route('logout') }}" >
                                        <i class="bi bi-box-arrow-left"></i>
                                        <span>Đăng xuất</span>
                                    </a></li>
                                </ul>
                            @else
                                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bi bi-person'></i>
                                    <strong>Tài khoản</strong>
                                    
                                </a>
                                <ul class="dropdown-menu custom-dropdown-account" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item" href="{{ route('login.page') }}">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                        <span>Đăng nhập</span>
                                    </a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" style="color: var(--primary)" href="#">
                                        <i class="bi bi-person-add"></i>
                                        <span>Đăng ký</span>
                                    </a></li>
                                </ul>
                            @endif
                        </li>
                </div>
            </nav>

        </div>
    </header>

    @yield('main')

    <footer class="container p-1 mt-auto">
        <hr class="row hr">
        <div class="row">
            <nav class="d-flex flex-wrap justify-content-center justify-content-md-evenly align-items-center gap-2">
                <a href="#">Liên hệ</a>
                <a href="#">Về chúng tôi</a>
                <a href="#">Hợp tác</a>
                <a href="#">Điều khoản</a>
                <a href="#">Bảo mật</a>
                <a href="#">Thiết lập</a>
                <a href="#">Hỗ trợ</a>
                <a href="#">E-read</a>
            </nav>
        </div>
        <div class="row pt-3">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="disc">
                    Website được tạo ra với mục đích học tập và hoàn toàn phi lợi nhuận.<br>
                    Tất cả các tác phẩm và một số chi tiết của website được tham khảo từ nhiều nguồn chưa được cho phép sử dụng bản quyền.
                </div>
            </div>
    </footer>

</body>

</html>