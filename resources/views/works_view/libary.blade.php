@extends('index-user')

@section('css')
    <link rel="stylesheet" href="{{asset('css/works.css')}}">
@endsection

@section('title', 'Thư viện')

@section('main')
    <main class="container py-3">
        <article class="row align-items-center justify-content-center container">
            <section class="row">
                <h2 style="font-weight: bold;">Thể loại</h2>
            </section>

            <section class="row">
                <div class="d-flex justify-content-center gap-3 pt-2 pb-4 flex-wrap">

                    <form action="#" method="post">
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
                <h2 class="pt-4" style="font-weight: bold;">Thư viện của tôi</h2>
            </section>
            <section class="row d-flex justify-content-center gap-3">
            @foreach($works as $work)
            <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-5 col-md-3 d-flex justify-content-center align-items-center">
                @if ($work->anh_bia)
                <img src="{{ asset($coverStoragePath . '/' . $work->anh_bia) }}" class="img-fluid rounded" alt="...">
                @endif
                </div>
                <div class="col">
                <div class="card-body">
                    <a href="{{ route('read.details', ['id' => $work->id]) }}" class="title">
                    <h5 class="card-title" data-bs-toggle="tooltip" data-bs-placement="right" title="{{$work->tua_de}}" style="font-weight: bold;">
                        {{Illuminate\Support\Str::limit($work->tua_de, $limit = 30, $end = '...')}}
                    </h5>
                    </a>
                        
                    <p class="card-text">Tác giả: <span>{{$work->tac_gia}}</span></p>
                    <p class="card-text">
                    <!-- {{nl2br(str_replace('\n', "\n",Illuminate\Support\Str::limit($work->mo_ta_noi_dung, $limit = 500, $end = '...')))}} -->
                    {{Illuminate\Support\Str::limit($work->mo_ta_noi_dung, $limit = 250, $end = '...')}}
                    <span><a href="{{ route('read.details', ['id' => $work->id]) }}" style="color: var(--primary)">xem chi tiết</a></span>
                    </p>
                    <p>Phiên bản: @if($work->phien_ban == 1) Thường @else Đặc biệt @endif</p>
                </div>
                </div>
                <div class="d-flex justify-content-end pb-3" style="gap: 1rem;">
                <a href="{{ route('read.content', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                    <span>Tiếp tục đọc</span>
                </a>
                <a href="{{ route('download', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-download"></i>
                    <span>Tải xuống</span>
                </a>
                </div>
            </div>
            </div>
        @endforeach
            </section>
        </article>
        <article class="row">
            {!! $works->links() !!}
        </article>
    </main>
@endsection