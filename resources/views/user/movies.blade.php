@extends('layouts.master')
@section('title')
    Hello Linker
@endsection
@section('styles')
    <style>
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 ">
                <div class="forBoxAds">

                </div>
            </div>
            <!-- -- Links --  -->
            <div class="col-md-8 mb-5 mt-2">
                <h5 class="mt-3 text-center"><i class="fa-solid fa-clapperboard fs-4"></i> <span language="eng">Enjoy Movies
                    </span></h5>
                <div class="line-mf"></div>
                <!--<div class="align-items-center">{{ $movies->appends(request()->query())->links() }}</div>-->
                <div></div>
                <div class="paginationTop mt-2">
                </div>
                <!-- Links Cards -->
                <div class="linkContainer d-flex justify-content-evenly flex-wrap">
                    @if (count($movies) == 0)
                        <div class="text-center mt-5">
                            <div class="d-flex justify-content-center annimateLogo">
                                <img class=" rounded rounded-circle" src="{{ asset('user/img/linklogo.jpg') }}"
                                    height="100" alt="">
                            </div>
                            <h3>There is Nothing To Show Movie</h3>
                            <h5>Search Key: <span class="text-danger">{{ request('searchKey') }}</span></h5>
                        </div>
                    @endif
                    @foreach ($movies as $m)
                        <div class=" m-1 my-2 movieCard" style="width: 10rem">
                            <div class=" position-relative overflow-hidden">
                                <img src="@if ($m->image == null) {{ $m->image_link }} @else {{ asset('storage/movie_photos/' . $m->image) }} @endif"
                                    class="card-img-top" style="height: 8rem">
                                <div class=" position-absolute bg-dark p-1 rounded   end-0 bottom-0" style="opacity: 0.9">
                                    @php  $floorRate= round($m->rating($m->id)) @endphp
                                    @for ($a = 0; $a < 4; $a++)
                                        <i
                                            class="fa-solid fa-star
                            @if ($floorRate > $a) text-warning @endif"></i>
                                    @endfor
                                    <small class="fs-smallest opacity-75 text-muted"><i class="fa-solid fa-eye "></i>
                                        @if ($m->view_count <= 999)
                                            {{ $m->view_count }}
                                        @else
                                            {{ round($m->view_count / 1000, 1) }}K
                                        @endif
                                    </small>
                                </div>
                                <div class=" position-absolute start-50 top-50 translate-middle">
                                    <a href="{{ route('user#movie_info', $m->id) }}"
                                        class="fs-1 d-none text-primary shadow  movLink " id=""><i
                                            class="fa-solid fa-play"></i></a>
                                </div>
                            </div>
                            <div class="" style="background: #303030">
                                <div class="text-center">
                                    <a href="{{ route('user#movie_info', $m->id) }}" class="text-light"><small
                                            class="card-title ">{{ $m->name }}</small></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $movies->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="forBoxAds">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.nav-movies').addClass('active');
            $('.card-img-top').click(function() {
                let link = $(this).parent().find('.movLink').attr('href')
                window.location.href = link;
            })
            $('.card-img-top,.movLink').hover(function() {
                $('.card-img-top').addClass('low-light')
                $(this).parent().parent().find('.card-img-top').addClass('hover-img').removeClass(
                    'low-light');
                let item = $(this).parent().parent().find('.movLink').removeClass('d-none');
            }, function() {
                $('.movLink').addClass('d-none');
                $('.card-img-top').removeClass('hover-img');
                $('.card-img-top').removeClass('low-light');
            });
        });
    </script>
@endpush
