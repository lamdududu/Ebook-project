@extends('index-user')

@section('css')
    <link rel="stylesheet" href="{{asset('css/works.css')}}">
@endsection

@section('title', 'Tác phẩm')

@section('main')
    <main class="container py-3">
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