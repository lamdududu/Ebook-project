<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Nhúng boostrap icon -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <!-- Nhúng boostrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous" />
        <!-- Nhúng angularjs min và route -->
        <script
            src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
        <script
            src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-route.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            <link rel="stylesheet" href="../css/index.css">
        <title>Sáng tác</title>
    </head>
    <body>
        <div class="container-fluid  d-flex justify-content-center m-2" >
            <div class="col">
            <nav class="navbar navbar-expand-lg ">

                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse px-5 "
                    id="navbarTogglerDemo01">
                    <a class="navbar-brand fs-1 "
                        href="trangchu.html"><strong><em>E-read.</em></strong></a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active fs-5" aria-current="page"
                                href="trangchu.html"><strong>Trang chủ </strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="trangchu.html"><strong>Sách</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="login.html"><strong>Box-chat</strong></a>
                        </li>

                    </ul>
                    <div class="d-flex justify-content-end pe-3 "
                style="padding: 15px; ">
<form class="d-flex"  role="search">
                            <input class="form-control me-1 " type="search"
                                placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success me-3"
                                type="submit">Search</button>
                        </form>
                        <!--Buy and Log-->
            
                <a href="writing.html"><button
                    class="btn btn-warning  me-md-2"
                    type="button"><i class="bi bi-pencil-square"></i> </button></a>
            <a href="#"><button class="btn btn-warning me-md-2"
                    type="button"><i class="bi bi-box2-heart-fill"></i> </button></a>
            <a href="login.html"><button
                    class="btn btn-warning "
                    type="button"><i class="bi bi-person-circle"></i> </button></a>
                    </div>
                </div>
            </nav>
           
            </div>
        </div>
        <div class="container "><hr style="color: rgb(0, 0, 0); width: 40%; border: 4px solid rgb(102, 59, 4);">
            <div class="d-flex "><hr style="color: rgb(0, 0, 0); width: 10%; border: 4px solid rgb(252, 23, 23);"><h4 class="col" style="font-weight: bold;">
            <em>Chào mừng đến với E-read!</em>
        </h4></div>
            
    </div>
   
    <!--trang chính-->
    <main class="container pt-4 pb-5">
        <article class="row container">
            
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner col-6">
                  <div class="carousel-item active">
                    <img src="https://laodongcongdoan.vn/stores/news_dataimages/2024/012024/04/19/vi-luong-y-cua-nhung-cuon-sach-cu-20240104190726.jpg?rt=20240104190731" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="https://blogcdn.muaban.net/wp-content/uploads/2023/07/03202133/nhung-cuon-sach-hay-cua-nguyen-nhat-anh-15.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
<img src="https://blogcdn.muaban.net/wp-content/uploads/2023/07/03194117/nhung-cuon-sach-hay-cua-nguyen-nhat-anh-5.jpg" class="d-block w-100" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
           
            <section
                class="row container flex-column align-items-center justify-content-center ">
                <!-- <div class="col-7 d-flex align-items-center justify-content-center"> -->
                <section class="row">
                    <div
                        class="col py-2 d-flex align-items-center ">
                        <h4 style="font-weight: bold;"><i class="text-danger  bi bi-star-fill"></i> Tác phẩm nổi bật</h4>
                    </div>
                </section>
                <div>
                    <div class="row d-flex ">
                    <div class="col-sm-6 col-md-4 col-lg-3 my-3">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://sachtiengviet.com/cdn/shop/products/2edeee9da20c74e0dbc34a39a053b045.jpg?v=1692267425"
                                        class="img-fluid rounded-start"
                                        alt="...">
                                </div>
                                <div class="col-md-8 d-flex align-items-center">
                                    <div
                                        class="card-body d-flex flex-column gap-2">
                                        <h5 class="card-title">
                                            <a href="#">Bảy bước thấy mùa hè</a>
                                        </h5>
                                        <p class="card-text">
                                            Tác giả: Nguyễn Nhật Ánh
                                        </p>
                                        <p class="card-text">
                                            Câu chuyện về một mùa hè ngọt ngào, những trò chơi nghịch ngợm và bâng khuâng tình cảm tuổi mới lớn. Chỉ vậy thôi nhưng chứng tỏ tác giả đúng là nhà kể chuyện
<!-- <span class="collapse" id="collapseExample">
                                                    từ nhỏ cô nàng cùng xóm có đôi mắt tuyệt đẹp - Hà Lan. Tuổi thơ ở nơi làng xóm bình yên giản dị thật là đẹp, nhưng rồi cũng đến lúc kết thúc khi cả hai đều phải lên thành phố tiếp tục việc học, và tấm bi kịch bắt đầu từ đây.
                                                </span>
                                                <span>
                                                    <a data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">...xem thêm</a>
                                                </span> -->
                                            <span><a
                                                    style="color: var(--primary)">...
                                                    xem chi tiết</a></span>
                                        </p>
                                        <p class="card-text"><small
                                                class="text-muted">Last updated
                                                3 mins ago</small></p>
                                        <!-- <div class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="btn btn-primary">Đọc</a>
                                            </div>                  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-3">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1567777635l/50847731._SX318_SY475_.jpg"
                                        class="img-fluid rounded-start"
                                        alt="...">
                                </div>
                                <div class="col-md-8 d-flex align-items-center">
                                    <div
                                        class="card-body d-flex flex-column gap-2">
                                        <h5 class="card-title">
                                            <a href="#">Làm bạn với bầu trời</a>
                                        </h5>
                                        <p class="card-text">
                                            Tác giả: Nguyễn Nhật Ánh
                                        </p>
                                        <p class="card-text">
Viết về điều tốt đã không dễ, viết sao cho người đọc có thể đón nhận đầy cảm xúc tích cực, và muốn được hưởng, được làm những điều tốt dù nhỏ bé... mới thật là khó
                                            <!-- <span class="collapse" id="collapseExample">
                                                    từ nhỏ cô nàng cùng xóm có đôi mắt tuyệt đẹp - Hà Lan. Tuổi thơ ở nơi làng xóm bình yên giản dị thật là đẹp, nhưng rồi cũng đến lúc kết thúc khi cả hai đều phải lên thành phố tiếp tục việc học, và tấm bi kịch bắt đầu từ đây.
                                                </span>
                                                <span>
                                                    <a data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">...xem thêm</a>
                                                </span> -->
                                            <span><a
                                                    style="color: var(--primary)">...
                                                    xem chi tiết</a></span>
                                        </p>
                                        <p class="card-text"><small
                                                class="text-muted">Last updated
                                                3 mins ago</small></p>
                                        <!-- <div class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="btn btn-primary">Đọc</a>
                                            </div>                  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-3">
                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://lh6.googleusercontent.com/gb1npAjCDWgpXk7KU4PuNTqYqzZpCGWvcM7pFYVhgbo2FyHpeaZmXsROsn4kcptIDgPhKeMkqr8KC49GPs3ajpVFa15ioZYjKbRchfrt4jFNpOWGa-_peoWBVhkA-AehhI66B9Q"
                                        class="img-fluid rounded-start"
                                        alt="...">
                                </div>
                                <div class="col-md-8 d-flex align-items-center">
                                    <div
                                        class="card-body d-flex flex-column gap-2">
                                        <h5 class="card-title">
                                            <a href="#">Thiên thần nhỏ của tôi</a>
                                        </h5>
<p class="card-text">
                                            Tác giả: Nguyễn Nhật Ánh
                                        </p>
                                        <p class="card-text">
                                            "Thiên Thần Nhỏ Của Tôi" là một cuốn sách đầy cảm xúc về tình bạn, sự nhân ái và hy vọng. Kha, nhân vật chính của truyện, đã gặp được một cô bạn thân nghèo khó tên Hồng Hoa
                                            <!-- <span class="collapse" id="collapseExample">
                                                    từ nhỏ cô nàng cùng xóm có đôi mắt tuyệt đẹp - Hà Lan. Tuổi thơ ở nơi làng xóm bình yên giản dị thật là đẹp, nhưng rồi cũng đến lúc kết thúc khi cả hai đều phải lên thành phố tiếp tục việc học, và tấm bi kịch bắt đầu từ đây.
                                                </span>
                                                <span>
                                                    <a data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">...xem thêm</a>
                                                </span> -->
                                            <span><a
                                                    style="color: var(--primary)">...
                                                    xem chi tiết</a></span>
                                        </p>
                                        <p class="card-text"><small
                                                class="text-muted">Last updated
                                                3 mins ago</small></p>
                                        <!-- <div class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="btn btn-primary">Đọc</a>
                                            </div>                  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-3">
                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWaG506xSb3BSy9DqOPq7tXqCsnO6i9g7XgraR6-6Kh0nG4Ds-wlwpMecbLLsbva02dOo&usqp=CAU"
                                        class="img-fluid rounded-start"
                                        alt="...">
                                </div>
                                <div class="col-md-8 d-flex align-items-center">
                                    <div
                                        class="card-body d-flex flex-column gap-2">
<h5 class="card-title">
                                            <a href="#">Hoa hồng xứ khác</a>
                                        </h5>
                                        <p class="card-text">
                                            Tác giả: Nguyễn Nhật Ánh
                                        </p>
                                        <p class="card-text">
                                            "Hoa hồng xứ khác" kể về câu chuyện bốn chàng trai đều theo đuổi một cô gái đến từ Hội An, đúng với tên truyện, một "hoa hồng xứ khác". Những cuộc tranh giành
                                            <!-- <span class="collapse" id="collapseExample">
                                                    từ nhỏ cô nàng cùng xóm có đôi mắt tuyệt đẹp - Hà Lan. Tuổi thơ ở nơi làng xóm bình yên giản dị thật là đẹp, nhưng rồi cũng đến lúc kết thúc khi cả hai đều phải lên thành phố tiếp tục việc học, và tấm bi kịch bắt đầu từ đây.
                                                </span>
                                                <span>
                                                    <a data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">...xem thêm</a>
                                                </span> -->
                                            <span><a
                                                    style="color: var(--primary)">... xem chi tiết</a></span>
                                        </p>
                                        <p class="card-text"><small
                                                class="text-muted">Last updated
                                                3 mins ago</small></p>
                                        <!-- <div class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="btn btn-primary">Đọc</a>
                                            </div>                  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                
            </section>
        </article>
    </main>
    <footer class="container  p-1 mt-auto">
        <hr style="color: rgb(19, 86, 68); width: 100%; border: 4px solid rgb(3, 76, 86);">
        <div class="row">
            <nav
                class="d-flex flex-wrap justify-content-center justify-content-md-evenly align-items-center gap-2">
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
        <div class="row pt-2">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="disc">
                    Website được tạo ra với mục đích học tập và hoàn toàn phi
                    lợi nhuận.<br>
                    Tất cả các tác phẩm và một số chi tiết của website được tham
                    khảo từ nhiều nguồn chưa được cho phép sử dụng bản quyền.
                </div>
            </div>
        </footer>
    </body>
</html>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
<script src="../js/index.js"></script>