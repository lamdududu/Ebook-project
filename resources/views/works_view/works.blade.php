@extends('index-user')

@section('css')
    <link rel="stylesheet" href="{{asset('css/works.css')}}">
@endsection

@section('title', 'Tác phẩm')

@section('main')
    <main class="container p-3">
        <article class="row align-items-center justify-content-center px-2 pt-3">
            <section class="d-flex align-items-center justify-content-between px-5">
                <h2 style="font-weight: bold;">Thể loại</h2>
                <div>
                    <button type="submit" class="btn btn-primary btn-custom">
                        <i class="bi bi-funnel"></i>
                        <span>Lọc</span>
                    </button>
                </div>
            </section>

            <section class="row">
                <div class="d-flex justify-content-center gap-3 py-2 flex-wrap">

                    <form action="{{ route('filter') }}" method="post"  style="font-size: 15px;">
                        @csrf
                        <div class="form-check form-check-inline filter">
                            <input class="form-check-input" type="checkbox" value="999999" id="categoryCheck99999" name="categoryCheck[]">
                            <label class="form-check-label" for="categoryCheckAll">Tất cả</label>           
                        </div>
                        @foreach($categories as $category)
                        <div class="form-check form-check-inline filter">
                            <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="categoryCheck.{{$category->id}}" name="categoryCheck[]">
                            <label class="form-check-label" for="categoryCheck.{{$category->id}}">
                                {{$category->ten_the_loai}}
                            </label>                
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-end pt-2">
                        </div>
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