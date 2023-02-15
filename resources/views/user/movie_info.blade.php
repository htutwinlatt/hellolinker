@extends('layouts.master')
@section('title')
    {{ $movie->name }}
@endsection
@section('styles')
    <style>
        .watchBtn {
            position: relative;
            animation: playBtnAnnimate 2s infinite alternate;
            animation-timing-function: ease-in-out;
            z-index: 10;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-2 ">
                <div class="forBoxAds">
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                        crossorigin="anonymous"></script>
                    <!-- Box ads -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4711089720936751"
                        data-ad-slot="9318935328" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
            <!-- -- Links --  -->
            <div class="col-md-8 mb-5 mt-2">
                <div class="row ">
                    <div class="col-md-12 my-3">
                        <a href="javascript:history.back()" title="back page" class="btn btn-primary"><i
                                class="fs-6 fa-solid fa-arrow-left-long"></i></a>
                        <a href="{{ route('user#movies') }}" class="btn btn-primary" title="Movie List"><i
                                class="fs-6 fa-solid fa-clapperboard"></i></a>
                    </div>
                    <div class="col-md-12">
                        <div>@php echo $movie->trailer @endphp</div>
                    </div>
                    <div class="col-md-4">
                        <img data-aos="fade-right"
                            src="@if ($movie->image == null) {{ $movie->image_link }} @else {{ asset('storage/movie_photos/' . $movie->image) }} @endif"
                            class="w-100" alt="...">
                    </div>
                    <div class="col-md-8">
                        <!-- About Movie -->
                        <div class="card" data-aos="zoom-out-down">
                            <div class="card-header bg-white text-center py-3">
                                <button data-aos="fade-left" title="report issue" class="float-end btn btn-secondary btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#reportToAdmin">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    <span language="eng"> Report</span></button>
                                <h5 class="mb-0 fw-bold">{{ $movie->name }}
                                    @if ($movie->role != 'free')
                                        <i class="fa-solid fa-crown text-warning"></i>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li class="my-2"><strong class="me-3"><span language="eng">Actors</span> ->
                                        </strong> {{ $movie->actors }}</li>
                                    <li class="my-2"><strong class="me-3"><span language="eng">Director</span>
                                            -></strong> {{ $movie->director }}</li>
                                    <li class="my-2"><strong class="me-3"><span language="eng">Studio</span>-></strong>
                                        {{ $movie->studio }}</li>
                                    <li class="my-2"><strong class="me-3"><span language="eng">Release Date</span>
                                            -></strong> {{ $movie->released_at }}
                                    </li>
                                    <li class="my-2"><strong class="me-3"><span language="eng">Movie Type</span>
                                            -></strong>
                                        <h5 class=" d-inline-block">@php
                                            $types = explode(',', $movie->type);
                                        @endphp
                                            @foreach ($types as $type)
                                                <a href="{{ route('user#category_search', $type) }}"><span
                                                        class="badge bg-primary">{{ $type }}</span></a>
                                            @endforeach
                                        </h5>
                                    </li>
                                    <li class="my-2"><strong class="me-3"><span language="eng">Rating</span> ->
                                        </strong>
                                        <span>{{ $movie->rating($movie->id) }}</span>
                                    </li>
                                    <li class="my-2"><strong class="me-3"><span language="eng">View</span> -></strong>
                                        <i class="fa-solid fa-eye"></i>
                                        @if ($movie->view_count <= 999)
                                            {{ $movie->view_count }}
                                        @else
                                            {{ round($movie->view_count / 1000, 1) }}K
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer bg-white  py-3">
                                <div class="generate_link_text">
                                    <span language="eng">Generating link,please wait..</span>
                                </div>
                                <div class="position-relative">
                                    <div class="position-absolute downloadBtnCoverAds">

                                    </div>
                                    <div class="text-center  m-2">
                                        @if (!empty(Auth::user()))
                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'member')
                                                <a href="{{ route('user#movie_get_link', [$movie->id, $movie->name]) }}"
                                                    target="_black" class="btn btn-success watchBtn w-100"><i
                                                        class="fa-solid fa-download me-2"></i>
                                                    <span language='eng'>Get Download Link</span></a>
                                            @else
                                                <!-- Normal User -->
                                                <span class="p-3 countForWatch rounded border fs-4">5</span>
                                                <a href="{{ route('user#movie_get_link', [$movie->id, $movie->name]) }}"
                                                    target="_black" class="btn btn-success d-none watchBtn w-100"><i
                                                        class="fa-solid me-2 fa-download"></i> <span language='eng'> Get
                                                        Download Link</span></a>
                                            @endif
                                        @else
                                            <!-- not Auth User -->
                                            <span class="p-3 countForWatch rounded border fs-4">5</span>
                                            <a href="{{ route('user#movie_get_link', [$movie->id, $movie->name]) }}"
                                                target="_black" class="btn btn-success d-none watchBtn w-100"><i
                                                    class="fa-solid fa-download me-2"></i> <span language='eng'> Get
                                                    Download
                                                    Link</span></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row  my-4 w-100 mx-0">
                        <h5 class="text-center"><span language='eng'>Short Description</span></h5>
                        <div class="line-mf"></div>
                        <p data-aos="zoom-in" class=" text-muted bg-dark p-2 rounded">
                            <!-- Google Adscence -->
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                                crossorigin="anonymous"></script>
                            <ins class="adsbygoogle" style="display:block; text-align:center;"
                                data-ad-layout="in-article" data-ad-format="fluid"
                                data-ad-client="ca-pub-4711089720936751" data-ad-slot="7642396731"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            <!-- Google Adscence -->
                            {{ $movie->description }}
                        </p>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="row">
                            <h5 class="text-center mb-3"><i class="fa-solid fa-comments text-primary"></i> <span
                                    language='eng'>Comments</span>(
                                {{ $totalCmt }} )</h5>
                            <div class="line-mf"></div>
                        </div>
                        <!-- Commments -->
                        <div class="col-md-6" id="Preview_Comment">

                        </div>
                        <div class="col-md-6 mb-4 align-items-center">
                            <form action="" class="commentForm">
                                @csrf
                                <!-- Comment Input -->
                                <label class="form-label" for="form1"><span language="eng">Entert
                                        Comment</span></label>
                                <textarea type="search" minlength="5" required id="form1" name="comment"
                                    class="form-control @error('comment') is-invalid @endif" rows="4"></textarea>
                            @error('comment')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <!-- Rating -->
                            <div class="mt-3">
                                                                <label class="form-label" for="customRange1"><span language="eng">Rating</span></label>
                                                                <input type="range" required min="1" max="4" name="rating" class="form-range cmtRating d-none" autocompleted="none" value="3">
                                                            </div>
                                                            <div class="d-flex ratingIconContainer justify-content-around fs-3 text-warning">
                                                                <p><i class="ratIcon-1 fa-solid fa-face-frown rounded rounded-circle"></i></p>
                                                                <p><i class="ratIcon-2 fa-solid fa-face-meh rounded rounded-circle"></i></p>
                                                                <p><i class="ratIcon-3 fa-solid fa-face-smile-beam rounded rounded-circle border border-4 scaletwo"></i>
                                                                </p>
                                                                <p><i class="ratIcon-4 fa-solid fa-face-grin-hearts rounded rounded-circle"></i></p>
                                                            </div>
                                                            <p class="text-end">Rating : <span id="ratText"><span language="eng">good</span></span></p>
                                                            <!-- Submit button -->
                                                            <button type="submit" @if (empty(Auth::user())) disabled @endif class="btn btn-primary btn-block mt-2">
                                                                <i class="fa-solid fa-paper-plane"></i>
                                                                <span language="eng">Send</span>
                                                            </button>
                                                            @if (empty(Auth::user()))
<div class="mt-2">
                                                                <span class="" language="eng">Please Login First to Give Comment <a href="{{ route('login') }}">Login..</a></span>
                                                            </div>
@endif
                                                        </form>
                                                    </div>
                                                </div>
                                                <hr class="my-1">
                                                <!-- Random Movies-->
                                                <section class="row mt-2 m-0 p-0">

                                                    <h5 class="text-center"><span language='eng'>Random Movie</span></h5>
                                                    <div class="line-mf"></div>
                                                    <div class="d-flex justify-content-evenly flex-wrap">
                                                        @foreach ($rmovies as $rmovie)
<div class="card m-1 my-2 movieCard" style="width: 10rem;">
                                                            <div class=" position-relative overflow-hidden">
                                                                <img src="@if ($rmovie->image == null) {{ $rmovie->image_link }} @else {{ asset('storage/movie_photos/' . $rmovie->image) }} @endif" class="card-img-top" style="height: 8rem;" alt="...">
                                                                <div class=" position-absolute bg-dark p-1 rounded   end-0 bottom-0" style="opacity: 0.9">
                                                                    @php $floorRate= round($rmovie->rating($rmovie->id)) @endphp
                                                                    @for ($a = 0; $a < 4; $a++)
<i class="fa-solid fa-star
                                    @if ($floorRate > $a) text-warning @endif"></i>
@endfor
                                                                        <small class="fs-smallest opacity-75 text-muted"><i class="fa-solid fa-eye "></i>
                                                                            @if ($rmovie->view_count <= 999)
{{ $rmovie->view_count }}
@else
{{ round($rmovie->view_count / 1000, 1) }}K
@endif </small>
                                                                </div>
                                                                <div class=" position-absolute start-50 top-50 translate-middle">
                                                                    <a href="{{ route('user#movie_info', $rmovie->id) }}" class="fs-1 d-none text-primary shadow  movLink " id=""><i class="fa-solid fa-play"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="text-center">
                                                                    <h6 class="card-title ">
                                                                        {{ $rmovie->name }}</h6> <small class="fs-smallest opacity-75"></small>
                                                                </div>
                                                            </div>
                                                        </div>
@endforeach
                                                    </div>
                                                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                                                        crossorigin="anonymous"></script>
                                                    <ins class="adsbygoogle"
                                                         style="display:block"
                                                         data-ad-format="autorelaxed"
                                                         data-ad-client="ca-pub-4711089720936751"
                                                         data-ad-slot="6304978928"></ins>
                                                    <script>
                                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                                    </script>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="col-md-2 ">
                                            <div class="forBoxAds">
                                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                                                    crossorigin="anonymous"></script>
                                            <!-- Box ads -->
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-client="ca-pub-4711089720936751"
                                                 data-ad-slot="9318935328"
                                                 data-ad-format="auto"
                                                 data-full-width-responsive="true"></ins>
                                            <script>
                                                (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                                                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                                                                                            crossorigin="anonymous"></script>
                                            <!-- Box ads -->
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-client="ca-pub-4711089720936751"
                                                 data-ad-slot="9318935328"
                                                 data-ad-format="auto"
                                                 data-full-width-responsive="true"></ins>
                                            <script>
                                                (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                                                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                                                                                            crossorigin="anonymous"></script>
                                            <!-- Box ads -->
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-client="ca-pub-4711089720936751"
                                                 data-ad-slot="9318935328"
                                                 data-ad-format="auto"
                                                 data-full-width-responsive="true"></ins>
                                            <script>
                                                (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                                                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                                                                                            crossorigin="anonymous"></script>
                                            <!-- Box ads -->
                                            <ins class="adsbygoogle"
                                                 style="display:block"
                                                 data-ad-client="ca-pub-4711089720936751"
                                                 data-ad-slot="9318935328"
                                                 data-ad-format="auto"
                                                 data-full-width-responsive="true"></ins>
                                            <script>
                                                (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>

    {{-- =====================================Modals============================================= --}}
    <div class="modal fade" id="reportToAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Report to Admin</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="reportForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="">
                            <select required class="form-select bg-dark text-light" name="type" id="">
                                <option value="">Please select reason...</option>
                                <option value="link_dead">link is not work!</option>
                                <option value="movie_cannot_watch">can't play movie!</option>
                                <option value="movie_trailer_error">can't play movie trailer!</option>
                            </select>
                    </div>
                    <div class="mt-2">
                        <textarea name="remark" class="form-control" placeholder="Remark"  rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><span language="eng">Submit</span></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {
                let opentime = localStorage.getItem('openTime');
                if (!opentime) {
                    localStorage.setItem('openTime',0);
                    opentime = 0;
                }
                if (opentime % 2 == 0) {
                    $('.downloadBtnCoverAds').addClass('d-none');
                }
                opentime++;
                localStorage.setItem('openTime',opentime)
                getComments();
                let _token = '{{ csrf_token() }}';
                $('.nav-movies').addClass('active');
                ratingFunction();
                $('.card-img-top').click(function() {
                    let link = $(this).parent().find('.movLink').attr('href')
                    window.location.href = link;
                })

                //Comment Submit Form
                $('.commentForm').submit(function(e) {
                    e.preventDefault();
                    let language = localStorage.getItem('language');
                    let comment = $(this).find('textarea[name="comment"]').val();
                    let rating = $(this).find('input[name="rating"]').val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user#comment_add', $movie->id) }}",
                        data: {
                            comment,
                            rating,
                            _token
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.success) {
                                Alert(data);
                            }
                            $('.commentForm').find('textarea[name="comment"]').val('');
                            getComments();

                        }
                    });
                });

                $('#reportForm').submit(function(e) {
                    e.preventDefault();
                    let parent = $(this).parent();
                    movieId = "{{ $movie->id }}",
                        type = parent.find('select[name="type"]').val(),
                        remark = parent.find('textarea[name="remark"]').val(),
                        $.ajax({
                            type: "POST",
                            url: "{{ route('user#report') }}",
                            data: {
                                movieId,
                                type,
                                remark,
                                _token
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Success', 'Reported.', 'success');
                                    parent.find('button[data-bs-dismiss="modal"]').click();
                                    $('button[data-bs-target="#reportToAdmin"]').remove();
                                }
                                if (response.error) {
                                    let errText = '';
                                    for (let i = 0; i < response.error.length; i++) {
                                        errText += response.error[i]
                                    }
                                }
                            }
                        });
                });

                $('.card-img-top,.movLink').hover(function() {
                    $('.card-img-top').addClass('low-light')
                    $(this).parent().parent().find('.card-img-top').addClass('hover-img').removeClass(
                        'low-light');
                    let item = $(this).parent().parent().find('.movLink').removeClass('d-none');
                }, function() {
                    $('.movLink').addClass('d-none');
                    $('.card-img-top').removeClass('hover-img');
                    $('.card-img-top').removeClass('low-light');
                });;

            });

            let watchCount = setInterval(() => {
                $('.countForWatch').toggleClass('border-primary')
                $('.countForWatch').html(parseInt($('.countForWatch').html()) - 1)
                if (parseInt($('.countForWatch').html()) == 0) {
                    $('.generate_link_text').addClass('d-none')
                    showWatchBtn();
                }
            }, 1000);

            setInterval(() => {
                getComments();
            }, 500000);

            // Comment get ajax
            let getComments = () => {
                $('#Preview_Comment').html(loading())
                $('#Preview_Comment').load('{{ route('user#comment_preview', $movie->id) }}');

            }

            function showWatchBtn() {
                clearInterval(watchCount);
                $('.countForWatch').remove();
                $('.watchBtn').removeClass('d-none').addClass('d-block')
            }
        </script>
    @endpush
