@extends('index-user')

@section('css')
    <link rel="stylesheet" href=" {{ asset('css/login.css') }}">
@endsection

@section('main')
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
            @yield('form')
        </article>
    </main>
@endsection