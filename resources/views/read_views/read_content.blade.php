@extends('index-user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/work_management.css') }}">
    <link rel="stylesheet" href="{{ asset('css/read.css') }}">
@endsection

@section('title', 'Đọc')

@section('main')
    <main class="container py-3">
        <article class="row gap-3">
            <div class="col d-flex align-items-center justify-content-center gap-5">
                <div class="col-4 text-end cover-read-view">
                    <img src="{{ asset($coverStoragePath . '/' . $work->anh_bia) }}" alt="{{$work->anh_bia}}" class="img-fluid rounded">
                </div>
                <form action="{{ route('payment.now', ['id' => $work->id]) }}" method="post" style="font-size: 14px;" class="col d-flex flex-column gap-3">
                    @csrf
                    <h2 style="font-weight: bold;">{{$work->tua_de}}</h2>
                    <div class="custom-info-read">
                        <div>
                            <span class="title-info">Tác giả: </span>
                            <span>{{$work->tac_gia}}</span>
                        </div>
                        @if($work->dich_gia)
                            <div>
                                <span class="title-info">Dịch giả: </span>
                                <span>{{$work->dich_gia}}</span>
                            </div>
                        @endif
                        <div>
                            <span class="title-info">Ngôn ngữ:</span>
                            <span>{{$work->ngon_ngu}}</span>
                        </div>
                        <div>
                            <span class="title-info">Năm xuất bản:</span>
                            <span>{{$work->nam_xuat_ban}}</span>
                        </div>
                        <div>
                            <span class="title-info">Nhà xuất bản:</span>
                            <span>{{$work->nha_xuat_ban}}</span>
                        </div>
                        <div>
                            <span class="title-info">Thể loại:</span>
                            @foreach($categories as $category)
                                <span>{{$category->ten_the_loai}}</span>
                                @if(!$loop->last)
                                    <span>/</span>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <span class="title-info">Phiên bản:</span>
                            <div>
                                <div>
                                    <input type="hidden" name="normalPrice" value="{{$prices->gia_ban_thuong}}">
                                    <input type="hidden" name="specialPrice" value="{{$prices->gia_ban_db}}">
                                    <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-2">
                                        <input class="form-check-input" type="radio" name="payNow" id="inlineRadio1.{{$work->id}}" value="1" style="margin: 0;" checked>
                                        <label class="form-check-label d-flex gap-3" for="inlineRadio2">
                                            <strong>Bản thường:</strong>
                                            <strong>{{ number_format($prices->gia_ban_thuong, 0, ',', '.') }} VNĐ</strong>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline d-flex justify-content-start align-items-center gap-2" style="color:var(--primary)">
                                        <input class="form-check-input" type="radio" name="payNow" id="inlineRadio2.{{$work->id}}" value="2" style="margin: 0;">
                                        <label class="form-check-label d-flex gap-3" for="inlineRadio2">
                                            <strong>Bản đặc biệt:</strong>
                                            <strong>{{ number_format($prices->gia_ban_db, 0, ',', '.') }} VNĐ</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex py-3 align-items-end new-work gap-2">
                        <a href="{{ route('download', ['id' => $work->id]) }}" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                            <span>Tải xuống</span>
                        </a>
                        <a href="{{ route('cart.add', ['id' => $work->id]) }}" class="btn btn-primary">
                            <i class="bi bi-bag-plus-fill"></i>
                            <span>Mua sau</span>
                        </a>
                        <div class="text-center new-work">
                            <button type="submit" name="block" class="btn btn-primary">
                                <i class="bi bi-credit-card-fill"></i>
                                <span class="btn-custom-mng">Mua ngay</span>
                            </button>
                        </div> 
                        
                    </div>
                </form>
            </div>     
            
        </article>
        <hr class="hr">
        <article class="row gap-3">
            <div class="col-lg-2"></div>
            <div class="col-lg work-content py-5">
                @foreach ($workContents as $workContent)
                    {!! nl2br($workContent) !!}
                @endforeach
            </div>
            <div class="col-lg-2"></div>
        </article>
        <article class="row">
            <div class="col-lg-3"></div>
            <div class="col d-flex flex-column align-items-center justify-content-center">
                @if(isset($notiPayment))
                    <div class="warning">
                        Đã hết nội dung đọc thử.
                    </div>
                    <div class="warning text-center" >Bạn cần mua tác phẩm ở phiên bản bất kì để có thể thưởng thức hoàn chỉnh tác phẩm</div>
                    <!-- <div class="warning">Bạn cần mua tác phẩm ở phiên bản bất kì để có thể thưởng thức hoàn chỉnh tác phẩm</div> -->
                @endif
                {!! $workContents->links() !!}
            </div>
            <div class="col-lg-3"></div>
        </article>
    </main>
    
@endsection