@extends('index-user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/works.css') }}">
@endsection

@section('title', 'Trang chủ')

@section('main')
<!-- <div class="container ">
        <hr style="color: rgb(0, 0, 0); width: 40%; border: 4px solid rgb(102, 59, 4);">
        <div class="d-flex ">
            <hr style="color: rgb(0, 0, 0); width: 10%; border: 4px solid rgb(252, 23, 23);">
            <h4 class="col" style="font-weight: bold;">
                <em>Chào mừng đến với E-read!</em>
            </h4>
        </div>

    </div> -->
  @if(Session()->has('success'))
    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
        <div><strong>Đăng ký tài khoản thành công.</strong></div>
        <div>Chúc bạn có những trải nghiệm tuyệt vời tại E-read!</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php session()->forget('success'); ?>
  @endif

  <main class="container pb-3">
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
            <div>Bạn có muốn thanh toán ngay để có thể tiếp tục tải xuống tác phẩm không?</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="pt-1">
                <a href="{{ route('payment.account') }}" class="btn px-2" style="color: rgb(102, 77, 3);"><strong>Có</strong></a>
                <button type="button" class="btn btn-alert text-danger px-2" data-bs-dismiss="alert" aria-label="Close"><strong>Không</strong></button>
            </div>
        </div>
        <?php session()->forget('warning-add'); ?>
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
    
    <article class="row container">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="3000">
            <img src="https://lambanner.com/wp-content/uploads/2022/08/MNT-DESIGN-MAU-BIA-SACH-DEP-TOI-GIAN.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item" data-bs-interval="3000">
            <img src="https://blogcdn.muaban.net/wp-content/uploads/2023/07/03202133/nhung-cuon-sach-hay-cua-nguyen-nhat-anh-15.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item" data-bs-interval="3000">
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
    </article>

    <article class="row p-3">
      <section class="row container flex-column align-items-center justify-content-center ">
        <!-- <div class="col-7 d-flex align-items-center justify-content-center"> -->
        <section class="row">
          <div class="col pt-2 pb-3 d-flex align-items-center ">
            <h3 style="font-weight: bold;">
              <i class="icon bi bi-fire"></i>
              <span>{{$nominations[0]->ten_de_cu}}</span> 
            </h3>
          </div>
        </section>
        <div id="carouselHotWorks" class="carousel carousel-dark slide" data-bs-ride="carousel" style="max-width: 1000px;">
          <div class="carousel-inner">
          <?php $i=0; ?>
          @foreach($hotWorks as $work)
            @if($i==0)
              <div class="carousel-item active" data-bs-interval="5000">
            @else
              <div class="carousel-item" data-bs-interval="5000">
            @endif
            <div class="d-flex justify-content-center">
            <div class="card mb-3 px-3" style="max-width: 800px;">
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
                        {{Illuminate\Support\Str::limit($work->tua_de, $limit = 46, $end = '...')}}
                      </h5>
                    </a>  
                    <p class="card-text">Tác giả: <span>{{$work->tac_gia}}</span></p>
                    <p class="card-text">
                      <!-- {{nl2br(str_replace('\n', "\n",Illuminate\Support\Str::limit($work->mo_ta_noi_dung, $limit = 500, $end = '...')))}} -->
                      {{Illuminate\Support\Str::limit($work->mo_ta_noi_dung, $limit = 300, $end = '...')}}
                      <span><a href="{{ route('read.details', ['id' => $work->id]) }}" style="color: var(--primary)">xem chi tiết</a></span>
                    </p>
                    <div class="card-text pb-2">
                      <p class="prices">Giá bản thường: <span>{{$work->gia_ban_thuong}} VNĐ</span></p>
                      <p class="prices" style="color: var(--primary);">Giá bản đặc biệt: <span>{{$work->gia_ban_db}} VNĐ</span></p>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end pb-3" style="gap: 1rem;">
                  <a href="{{ route('read.content', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                    <span>Đọc</span>
                  </a>
                  <a href="{{ route('download', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-download"></i>
                    <span>Tải xuống</span>
                  </a>
                  <a href="{{ route('cart.add', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-bag-plus-fill"></i>
                    <span>Mua sau</span>
                  </a>
                  </div>
                </div>
              </div>
            </div>
            </div>
            
            <?php $i+=1; ?>
          
          @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselHotWorks" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselHotWorks" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
      </section>
    </article>

    <article class="row p-3">
      <section class="row container flex-column align-items-center justify-content-center ">
        <!-- <div class="col-7 d-flex align-items-center justify-content-center"> -->
        <section class="row">
        <div class="col pt-2 pb-3 d-flex align-items-center ">
            <h3 style="font-weight: bold;">
              <i class="icon bi bi-bookmark-heart-fill"></i>
              <span>{{$nominations[1]->ten_de_cu}}</span> 
            </h3>
          </div>
        </section>
        <div id="carouselNomWorks" class="carousel carousel-dark slide" data-bs-ride="carousel" style="max-width: 1000px;">
          <div class="carousel-inner">
          <?php $i=0; ?>
          @foreach($nomWorks as $work)
            @if($i==0)
              <div class="carousel-item active" data-bs-interval="5000">
            @else
              <div class="carousel-item" data-bs-interval="5000">
            @endif
            <div class="d-flex justify-content-center">
            <div class="card mb-3 px-3" style="max-width: 800px;">
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
                        {{Illuminate\Support\Str::limit($work->tua_de, $limit = 46, $end = '...')}}
                      </h5>
                    </a>
                    <p class="card-text">Tác giả: <span>{{$work->tac_gia}}</span></p>
                    <p class="card-text">
                      <!-- {{nl2br(str_replace('\n', "\n",Illuminate\Support\Str::limit($work->mo_ta_noi_dung, $limit = 500, $end = '...')))}} -->
                      {{Illuminate\Support\Str::limit($work->mo_ta_noi_dung, $limit = 300, $end = '...')}}
                      <span><a href="{{ route('read.details', ['id' => $work->id]) }}" style="color: var(--primary)">xem chi tiết</a></span>
                    </p>
                    <div class="card-text pb-2">
                      <p class="prices">Giá bản thường: <span>{{$work->gia_ban_thuong}} VNĐ</span></p>
                      <p class="prices" style="color: var(--primary);">Giá bản đặc biệt: <span>{{$work->gia_ban_db}} VNĐ</span></p>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end pb-3" style="gap: 1rem;">
                  <a href="{{ route('read.content', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                    <span>Đọc</span>
                  </a>
                  <a href="{{ route('download', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-download"></i>
                    <span>Tải xuống</span>
                  </a>
                  <a href="{{ route('cart.add', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-bag-plus-fill"></i>
                    <span>Mua sau</span>
                  </a>
                  </div>
                </div>
              </div>
            </div>
            </div>
            
            <?php $i+=1; ?>
          
          @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselNomWorks" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselNomWorks" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
      </section>
    </article> 
    
    <article class="row p-3">
      <section class="row container flex-column align-items-center justify-content-center ">
        <!-- <div class="col-7 d-flex align-items-center justify-content-center"> -->
        <section class="row">
          <div class="col pt-2 pb-3 d-flex align-items-center ">
              <h3 style="font-weight: bold;">
                <i class="icon bi bi-award-fill"></i>
                <span>{{$nominations[2]->ten_de_cu}}</span> 
              </h3>
          </div>
        </section>
        <div id="carouselAwWorks" class="carousel carousel-dark slide" data-bs-ride="carousel" style="max-width: 1000px;">
          <div class="carousel-inner">
          <?php $i=0; ?>
          @foreach($awWorks as $work)
            @if($i==0)
              <div class="carousel-item active" data-bs-interval="5000">
            @else
              <div class="carousel-item" data-bs-interval="5000">
            @endif
            <div class="d-flex justify-content-center">
            <div class="card mb-3 px-3" style="max-width: 800px;">
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
                        {{Illuminate\Support\Str::limit($work->tua_de, $limit = 46, $end = '...')}}
                      </h5>
                    </a>
                    <p class="card-text">
                      <!-- {{nl2br(str_replace('\n', "\n",Illuminate\Support\Str::limit($work->mo_ta_noi_dung, $limit = 500, $end = '...')))}} -->
                      {{Illuminate\Support\Str::limit($work->mo_ta_noi_dung, $limit = 300, $end = '...')}}
                      <span><a href="{{ route('read.details', ['id' => $work->id]) }}" style="color: var(--primary)">xem chi tiết</a></span>
                    </p>
                    <div class="card-text pb-2">
                      <p class="prices">Giá bản thường: <span>{{$work->gia_ban_thuong}} VNĐ</span></p>
                      <p class="prices" style="color: var(--primary);">Giá bản đặc biệt: <span>{{$work->gia_ban_db}} VNĐ</span></p>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end pb-3" style="gap: 1rem;">
                  <a href="{{ route('read.content', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                    <span>Đọc</span>
                  </a>
                  <a href="{{ route('download', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-download"></i>
                    <span>Tải xuống</span>
                  </a>
                  <a href="{{ route('cart.add', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-bag-plus-fill"></i>
                    <span>Mua sau</span>
                  </a>
                  </div>
                </div>
              </div>
            </div>
            </div>
            
            <?php $i+=1; ?>
          
          @endforeach
          
            <!-- <div class="carousel-item" data-bs-interval="2000">
              <img src="..." class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="..." class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
              </div>
            </div>
          </div> -->
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselAwWorks" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselAwWorks" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
      </section>
    </article>

    <article class="row p-3">
      <section class="row container flex-column align-items-center justify-content-center ">
        <!-- <div class="col-7 d-flex align-items-center justify-content-center"> -->
        <section class="row">
          <div class="col pt-2 pb-3 d-flex align-items-center ">
              <h3 style="font-weight: bold;">
                <i class="icon bi bi-book-half"></i>
                <span>Danh sách tác phẩm</span> 
              </h3>
          </div>
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
                    <div class="card-text pb-2">
                      <p class="prices">Giá bản thường: <span>{{$work->gia_ban_thuong}} VNĐ</span></p>
                      <p class="prices" style="color: var(--primary);">Giá bản đặc biệt: <span>{{$work->gia_ban_db}} VNĐ</span></p>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end pb-3" style="gap: 1rem;">
                  <a href="{{ route('read.content', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                    <span>Đọc</span>
                  </a>
                  <a href="{{ route('download', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-download"></i>
                    <span>Tải xuống</span>
                  </a>
                  <a href="{{ route('cart.add', ['id' => $work->id]) }}" class="px-3 btn btn-primary">
                    <i class="bi bi-bag-plus-fill"></i>
                    <span>Mua sau</span>
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </section>
        <div class="text-center pt-3">
          <a href="{{ route('works') }}" class="see-all-works">Xem tất cả...</a>
        </section>
      </section>
    </article>
  </main>
@endsection



<!--trang chính-->