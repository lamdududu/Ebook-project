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
            <nav class="navbar navbar-expand-lg ">

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
                        <form class="d-flex justity-content-start" action="{{ route('search') }}" method="post" role="search">
                            @csrf
                            <input class="form-control me-1 search-custom" name="search" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                            <button class="btn me-3 search-btn" type="submit"><i class='bi bi-search'></i></button>
                        </form>
                        <a class="nav-link py-lg-0 py-2 px-lg-4" href="{{ route('library') }}">
                            <i class="bi bi-collection"></i>
                            <strong>Thư viện</strong>
                        </a>
                        <a class="nav-link py-lg-0 py-2 px-lg-4" href="{{ route('cart') }}">
                            <i class="bi bi-bag"></i>
                            <strong>Giỏ hàng</strong>
                        </a>
                        <li class="nav-item dropdown py-lg-0 py-2 px-lg-4">
                            @if(session()->has('user'))
                                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bi bi-person'></i>
                                    <strong>{{Session::get('user.ten_tai_khoan')}}</strong>
                                </a>
                                <ul class="dropdown-menu custom-dropdown-account" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item" href="{{route('bill')}}">Lịch sử thanh toán</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('account-informations', ['id' => Session::get('user.id')]) }}">Thông tin tài khoản</a></li>
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
                                    <li><a class="dropdown-item" style="color: var(--primary)" href="{{ route('register.page') }}">
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

    @if(Session()->has('warning-add-paid'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div class="pb-3"><strong>Bạn đã mua tác phẩm {{Session('warning-add-paid')}}.</strong></div>
            <div>Hãy kiểm tra lại thư viện.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('warning-add-paid'); ?>
    @endif

    @if(Session()->has('warning-download'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div class="pb-3 text-danger"><strong>Bạn chưa có phiên bản đặc biệt của tác phẩm {{Session('warning-download')}}.</strong></div>
            <div>Bạn có muốn thanh toán ngay <span style="color: var(--primary);">{{ number_format(Session('price-download'), 0, ',', '.')}} VNĐ</span> để có thể tiếp tục tải xuống tác phẩm không?</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="pt-1">
                <form action="{{ route('payment.special') }}" method="post">
                    @csrf
                    <input type="hidden" name="work" value="{{Session('work-download')}}">
                    <input type="hidden" name="price" value="{{Session('price-download')}}">
                    <button type="submit" class="btn px-2" style="color: rgb(102, 77, 3);"><strong>Có</strong></button>
                    <button type="button" class="btn btn-alert text-danger px-2" data-bs-dismiss="alert" aria-label="Close"><strong>Không</strong></button>
                </form>
            </div>
        </div>
        <?php
            session()->forget('warning-download');
            session()->forget('work-download');
            session()->forget('price-download');
         ?>
    @endif

    @if(Session()->has('warning-add'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div class="pb-3"><strong>Bạn đã có tác phẩm {{Session('warning-add')}} trong giỏ hàng.</strong></div>
            <div>Đừng quên thanh toán để có thể thưởng thức trọn vẹn tác phẩm nhé!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('warning-add'); ?>
    @endif

    @if(Session()->has('success-add'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div class="pb-3"><strong>Thêm tác phẩm {{Session('success-add')}} thành công.</strong></div>
            <div>Đừng quên thanh toán để có thể thưởng thức trọn vẹn tác phẩm nhé!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('success-add'); ?>
    @endif

    @if(Session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert" style="max-width: 480px;">
            <div class="text-danger pb-3"><strong>Bạn chưa kết nối tài khoản thanh toán!</strong></div>
            <div><strong>Bạn có muốn kết nối để thanh toán đơn hàng của bạn ngay bây giờ không?</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="pt-1">
                <a href="{{ route('payment.account') }}" class="btn px-2" style="color: rgb(102, 77, 3);"><strong>Có</strong></a>
                <button type="button" class="btn btn-alert text-danger px-2" data-bs-dismiss="alert" aria-label="Close"><strong>Không</strong></button>
            </div>
        </div>
        <?php session()->forget('warning'); ?>
    @endif

    @if(Session()->has('success-connection'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div><strong>Kết nối tài khoản thanh toán thành công.</strong></div>
            <div><strong>Bây giờ bạn đã có thể thanh toán đơn hàng của mình.</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('success-connection'); ?>
    @endif

    @if(Session()->has('success-payment'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div><strong>Thanh toán thành công.</strong></div>
            <div><strong>Hy vọng bạn sẽ tiếp tục đọc và sưu tầm những quyển sách hay cùng E-read.</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('success-payment'); ?>
    @endif

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