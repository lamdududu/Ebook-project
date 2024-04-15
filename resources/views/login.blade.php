<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{asset('/css/login.css')}}" rel="stylesheet"></link>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>Đăng nhập</title>
    </head>
    <body class="d-flex flex-column min-vh-100 gap-3 position-relative">
        <header class="d-flex header">
            <article class="d-flex gap-5">
                <div class="logo">
                    <!-- large-screen -->
                    <a href="index.html">
                        <img src="../images/logo.png" alt="logo">
                    </a>
                    <a href="index.html">E-read</a>
                </div>
                <nav class="nav">
                    <!-- large-screen -->
                    <a href="index.html">Sách</a>
                    <a href="login.html">Box-chat</a>
                    <div class="search-btn">
                        <label for="search-btn"><img src="../images/search_logo.png" alt="Tìm"></label>
                        <input type="search" name="search-btn" placeholder="Tìm kiếm">             
                    </div>
                </nav>
            </article>
            <article class="d-flex gap-3 right">
                    <div>
                        <a href="writing.html">Sáng tác</a>
                    </div>    
                    
                    <div class="notification">
                        <a href="#">Thư viện</a>
                    </div>     
                    <a href="login.html">Tài khoản</a>
            </article>
        </header>

        <main class="pt-5 pb-5 container justify-content-center align-items-center">
            <!-- position-absolute top-50 start-50 translate-middle -->
            <article class="row d-flex justify-content-center align-items-center gap-5">
                <div class="col-10 col-xl-6 d-flex justify-content-center">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <!-- <div class="carousel-indicators">
                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div> -->
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="{{asset('images/image.png')}}" class="d-block w-80" alt="...">
                          </div>
                          <div class="carousel-item active">
                            <img src="{{asset('images/image1.png')}}" class="d-block w-80" alt="...">
                          </div>
                          <div class="carousel-item active">
                            <img src="{{asset('images/image.png')}}" class="d-block w-80" alt="...">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div>
                <form class="col-8 col-xl-3 p-3 container needs-validation login-form" novalidate>
                    <legend class="p-2">Đăng nhập</legend>
                    <div class="row justify-content-center pb-2">
                        <div class="col input-group">
                            <span class="input-group-text rounded-start-3" id="basic-addon1">Tài khoản</span>
                            <input type="text" class="form-control shadow-none rounded-end-3" placeholder="Nhập tên tài khoản hoặc mail..." aria-label="Tài khoản" aria-describedby="basic-addon1">
                            <div class="invalid-feedback">
                                Tài khoản không tồn tại.
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center pb-2">
                        <div class="col input-group padding-custom-pass">
                             <span class="input-group-text rounded-start-3" id="basic-addon1">Mật khẩu</span>
                             <input type="password" class="form-control shadow-none rounded-end-3" placeholder="Nhập mật khẩu..." aria-label="Mật khẩu" aria-describedby="basic-addon1">
                        </div> 
                        <div class="invalid-feedback">
                            Sai mật khẩu.
                        </div>
                     </div>
                     <div class="row align-items-center">
                        <div class="col d-flex justify-content-center align-items-center">
                            <button class="btn-sign" type="submit">Đăng nhập</button>
                        </div>
                        <!-- btn btn-primary btn-sm -->
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col d-flex flex-column justify-content-center align-items-center">
                            <div class="forgot-pass-a">
                                <a href="#">Quên mật khẩu?</a>
                            </div>
                            <div class="sign-up">
                                <span>Chưa có tài khoản?</span>
                                <a href="#">Đăng ký</a>
                            </div>
                        </div>
                     </div>                    
                </form>                
            </article>
        </main>

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