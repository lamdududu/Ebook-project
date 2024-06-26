@extends('works_view.works')

@section('title', 'Tác Phẩm')

@section('content')

    @if(!$books)
        <p>Không tìm thấy tác phẩm</p>
    @else
        @foreach($books as $book)
            <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-5 col-md-3 d-flex justify-content-center align-items-center">
                @if ($book->anh_bia)
                <img src="{{ asset($coverStoragePath . '/' . $book->anh_bia) }}" class="img-fluid rounded" alt="...">
                @endif
                </div>
                <div class="col">
                <div class="card-body">
                    <a href="#" class="title">
                    <h5 class="card-title" data-bs-toggle="tooltip" data-bs-placement="right" title="{{$book->tua_de}}" style="font-weight: bold;">
                        {{Illuminate\Support\Str::limit($book->tua_de, $limit = 30, $end = '...')}}
                    </h5>
                    </a>
                    <p class="card-text">Tác giả: <span>{{$book->tac_gia}}</span></p>
                    <p class="card-text">
                    <!-- {{nl2br(str_replace('\n', "\n",Illuminate\Support\Str::limit($book->mo_ta_noi_dung, $limit = 500, $end = '...')))}} -->
                    {{Illuminate\Support\Str::limit($book->mo_ta_noi_dung, $limit = 300, $end = '...')}}
                    <span><a style="color: var(--primary)">... xem chi tiết</a></span>
                    </p>
                    <div class="card-text pb-2">
                        <p class="prices">Giá bản thường: <span>{{$book->gia_ban_thuong}} VNĐ</span></p>
                        <p class="prices" style="color: var(--primary);">Giá bản đặc biệt: <span>{{$book->gia_ban_db}} VNĐ</span></p>
                    </div>
                </div>
                </div>
                <div class="d-flex justify-content-end pb-3" style="gap: 1rem;">
                    <a href="{{ route('read.content', ['id' => $book->id]) }}" class="px-3 btn btn-primary">
                        <i class="bi bi-eye-fill"></i>
                        <span>Đọc thử</span>
                    </a>
                    <a href="{{ route('download', ['id' => $book->id]) }}" class="px-3 btn btn-primary">
                        <i class="bi bi-download"></i>
                        <span>Tải xuống</span>
                    </a>
                    <a href="{{ route('cart.add', ['id' => $book->id]) }}" class="px-3 btn btn-primary">
                        <i class="bi bi-bag-plus-fill"></i>
                        <span>Mua sau</span>
                    </a>
                </div>
            </div>
            </div>
        @endforeach
        <article class="row">
            {!! $books->links() !!}
        </article>
    @endif

@endsection