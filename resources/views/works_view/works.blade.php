@extends('index-user')

@section('css')
    <link rel="stylesheet" href="{{asset('css/works.css')}}">
@endsection

@section('title', 'Tác phẩm')

@section('main')
    <main class="container py-3">
    @if(Session()->has('warning-download'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div class="pb-3 text-danger"><strong>Bạn chưa có phiên bản đặc biệt của tác phẩm {{Session('warning-download')}}.</strong></div>
            <div>Bạn có muốn thanh toán ngay để có thể tiếp tục tải xuống tác phẩm không?</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="pt-1">
                <a href="{{ route('payment.account') }}" class="btn px-2" style="color: rgb(102, 77, 3);"><strong>Có</strong></a>
                <button type="button" class="btn btn-alert text-danger px-2" data-bs-dismiss="alert" aria-label="Close"><strong>Không</strong></button>
            </div>
        </div>
        <?php session()->forget('warning-dowload'); ?>
    @endif

    @if(Session()->has('warning-add'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div class="pb-3"><strong>Bạn đã có tác phẩm {{Session('warning-add')}} trong giỏ hàng.</strong></div>
            <div>Đừng quên thanh toán để có thể thưởng thức trọn vẹn tác phẩm nhé!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('warning-add'); ?>
    @endif

    @if(Session()->has('warning-add-paid'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div class="pb-3"><strong>Bạn đã mua tác phẩm {{Session('warning-add-paid')}}.</strong></div>
            <div>Hãy kiểm tra lại thư viện.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('warning-add-paid'); ?>
    @endif

    @if(Session()->has('success-add'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <div class="pb-3"><strong>Thêm tác phẩm {{Session('success-add')}} thành công.</strong></div>
            <div>Đừng quên thanh toán để có thể thưởng thức trọn vẹn tác phẩm nhé!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session()->forget('success-add'); ?>
    @endif
    
        <article class="row align-items-center justify-content-center container">
            <section class="row">
                <h2 style="font-weight: bold;">Thể loại</h2>
            </section>

            <section class="row">
                <div class="d-flex justify-content-center gap-3 pt-2 pb-4 flex-wrap">

                    <form action="{{ route('filter') }}" method="post">
                        @method('POST')
                        @csrf
                        <!-- <div class="form-check form-check-inline filter">
                            <input class="form-check-input" type="checkbox" value="All" id="categoryCheckAll" name="categoryCheck">
                            <label class="form-check-label" for="categoryCheckAll">Tất cả</label>           
                        </div> -->
                        @foreach($categories as $category)
                        <div class="form-check form-check-inline filter">
                            <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="categoryCheck.{{$category->id}}" name="categoryCheck">
                            <label class="form-check-label" for="categoryCheck.{{$category->id}}">
                                {{$category->ten_the_loai}}
                            </label>                
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-funnel"></i>
                            <span>Lọc</span>
                        </button>
                    </form>

                </div>
            </section>
        </article>
        <article class="row container align-items-center justify-content-center">
            <section class="row pb-4">
                <hr class="hr">
                <h2 class="pt-4" style="font-weight: bold;">Tác phẩm</h2>
            </section>
            <section class="row d-flex justify-content-center gap-3">
                @yield('content')
            </section>
        </article>
    </main>
@endsection