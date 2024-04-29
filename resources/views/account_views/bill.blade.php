@extends('index-user')

@section('title', 'Lịch sử thanh toán')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}">
@endsection

@section('main')
    <main class="container p-3">
        <article class="row">
            <h3 class="text-center py-4"><strong>Lịch sử thanh toán</strong></h3>
            <section class="col d-flex gap-2 flex-column justify-content-center align-items-center pb-5 flex-wrap">
                
                @foreach($bills as $bill)
                    <div class="col-lg-5 col-md-9 d-flex flex-column gap-2 bill p-3">
                        <div><h5><strong>Hoá đơn #{{$bill->id + 1000}}</strong></h5></div>
                        <div class="row justify-content-center pb-2">
                            <?php $count=0; ?>
                            @foreach($bill_details as $bill_detail)
                                @if($bill_detail->hoa_don == $bill->id)
                                    <div class="list-group-item list-group-item-action px-3">
                                        <div class="list-group-item list-group-item-action list-group-custom">
                                            <div class="d-flex w-100 gap-5 px-4 py-2 justify-content-between align-items-center">
                                                <div class="flex-grow-1 pl-2" style="max-width: 50px;">
                                                    <img src="{{$coverStoragePath . '/' . $bill_detail->anh_bia}}" class="rounded-3" alt="Product 1" style="width: 50px; height: auto;">
                                                </div>                                     
                                                <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                    <p><strong>{{$bill_detail->tua_de}}</strong></p>
                                                    <p class="desc">Phiên bản:
                                                        @if($bill_detail->phien_ban == 1)
                                                            Bản thường
                                                        @else Bản đặc biệt
                                                        @endif
                                                    </p>                                            
                                                    <p class="desc">Giá bán: {{$bill_detail->gia_thanh}} VNĐ<span></span></p>
                                                </div>
                                                <div class="desc">x1</div> 
                                            </div>
                                        </div>
                                    </div>
                                    <?php $count++; ?>
                                @endif
                            @endforeach
                        </div>
                        <div class="row p text-end px-2" style="font-size: 14px;">
                            <div><strong>Số lượng: </strong><span>{{$count}}</span></div>
                            <div><strong>Thành tiền: <span style="color: var(--primary);">{{$bill->thanh_tien}} VNĐ</span></strong></div>
                            <div><strong>Ngày thanh toán: </strong><span>{{\Carbon\Carbon::parse($bill->ngay_lap)->format('d-m-Y')}}</span></div>
                        </div>
                    </div>
                @endforeach
            </section>
            {!! $bills->links() !!}
        </article>
    </main>
@endsection