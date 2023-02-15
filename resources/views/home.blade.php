@extends('layouts.master')
@section('title')
    Hello Linker
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="carouselExampleCaptions" class="carousel slide carousel-fade shadow-3-strong m-0 p-0"
                data-mdb-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @for ($i = 0; $i < count($slideShows); $i++)
                        <li data-mdb-target="#carouselExampleCaptions" data-mdb-slide-to="{{ $i }}"
                            class="@if ($i == 0) active @endif" aria-current="true">
                        </li>
                    @endfor
                </ol>

                <!-- Inner -->

                <div class="carousel-inner">
                    <!-- Single item -->
                    @foreach ($slideShows as $slide)
                        <div class="carousel-item  @if ($loop->first) active @endif " style="">
                            <a href="{{ $slide->link }}" class="m-0 p-0">
                                <img src="@if ($slide->image == null) {{ $slide->image_link }} @else {{ asset('storage/slideShows/' . $slide->image) }} @endif"
                                    class="d-block w-100 slideshowContainer" alt="..."></a>
                            <a href="{{ $slide->link }}">
                                <div class="carousel-caption d-none d-md-block rounded"
                                    style="backdrop-filter: blur(60px)  grayscale(30%);">
                                    <h5>{{ $slide->title }}</h5>
                                    <p style="overflow: auto;height:130px">
                                        {{ $slide->description }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- Inner -->

                <!-- Controls -->
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>

        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row py-2 px-4">
            <div class="row">
                <div class="col-md-12 text-center forBoxAds">
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                        crossorigin="anonymous"></script>
                    <!-- New Box Ads -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4711089720936751"
                        data-ad-slot="6565579201" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
            <!--<div class="card text-dark" style="background: #D4AF37">-->
            <!--    <div class="card-body">-->
            <!--        <h5 class="card-title">-->
            <!--            <h4><i class="fa-solid fa-bullhorn"></i> ဖုန်းဘေတစ်ထောင်(1000MMK)ကံစမ်းရန်</h4>-->
            <!--        </h5>-->
            <!--        <p class="card-text">-->
            <!--            @if (!Auth::user())
    -->
            <!--                <span>ကံစမ်းရန်-->
            <!--                    <u><a href="{{ route('register') }}" class="text-dark">အကောင့်ကိုဖွင့်ပါ</a></u>(သို့)-->
            <!--                    <u><a class="text-dark" href="{{ route('login') }}">၀င်ရောက်ပါ</a></u>-->
            <!--                </span>-->
        <!--            @else-->
            <!--                <span class="me-2">-ကံစမ်းနိုင်သည့်အကြိမ်အရေအတွက်</span><span-->
            <!--                    class="crypto_point">{{ Auth::user()->ctypto_points }}</span>-->
            <!--
    @endif-->
            <!--        </p>-->
            <!--        @if (Auth::user())
    -->
            <!--            <button @if (!Auth::user()) disabled @endif href="#" id="phoneBillBtn"-->
            <!--                class="btn btn-success my-2">-->
            <!--                <i class="fa-regular fa-square-check"></i> ဖုန်းဘေကံစမ်းရန်နှိပ်ပါ</button>-->
            <!--
    @endif-->
            <!--        <button id="billRuleBtn" class="btn btn-dark my-2"><i class="fa-solid  fa-clipboard-question"></i>-->
            <!--            စည်းကမ်းချက်များဖတ်ရန်</button>-->
            <!--        <div class="d-flex align-items-center">-->
            <!--            <iframe-->
            <!--                src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fm.facebook.com%2Fstory.php%3Fstory_fbid%3Dpfbid02Bx1GtG8xJCXy5BACpg2CeLMDioXwDjRvcohosH5Zq4rKekHV1SJamYTu9oQdabb7l%26id%3D100064007530178%26mibextid%3DNif5oz&layout=button_count&size=large&width=88&height=28&appId"-->
            <!--                width="88" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0"-->
            <!--                allowfullscreen="true"-->
            <!--                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>-->
            <!--            <span class="fs-3">-->
            <!--                << share ရန်နှိပ်ပါ VPN ဖွင့်ထားရန်လိုအပ်ပါသည်</span>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>

    </div>
    <!-- New Arrive -->
    <div class="container-fluid mt-4">
        <div class="text-end">
            <a href="{{ route('user#movies') }}" class="btn btn-primary"> <span language="eng">All Movies</span></a>
        </div>
        <h5 class="text-center"><span language="eng">New Arrive</span></h5>
        <div class="line-mf rounded"></div>
        <div class="owl-carousel owl-theme owl-loaded ">
            @foreach ($newMovies as $newM)
                <div class="mx-2">
                    <div class="card w-100 rounded" style="height: 200px">
                        <div class="bg-image hover-overlay ripple " data-mdb-ripple-color="light">
                            <img style="height: 200px"
                                data-src="@if ($newM->image == null) {{ $newM->image_link }} @else {{ asset('storage/movie_photos/' . $newM->image) }} @endif"
                                class="img-fluid  owl-lazy w-100">
                            <a href="{{ route('user#movie_info', $newM->id) }}" class="h-100">
                                <div class="mask w-100" style="background-color: rgba(251, 251, 251, 0.15)">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--@if ($loop->index % 2 == 0)
    -->
                <!--    <div class="mx-2">-->
                <!--        <div class="card w-100 rounded" style="height: 200px">-->
                <!--            <div class="bg-image hover-overlay ripple " data-mdb-ripple-color="light">-->
                <!--                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751" -->
                                <!--                    crossorigin="anonymous"></script>-->
                <!--                <ins class="adsbygoogle" style="display:block" data-ad-format="fluid"-->
                <!--                    data-ad-layout-key="-6t+ed+2i-1n-4w" data-ad-client="ca-pub-4711089720936751"-->
                <!--                    data-ad-slot="5352553970"></ins>-->
                <!--                <script>
                    -- >
                    <
                    !--(adsbygoogle = window.adsbygoogle || []) -- >
                    <
                    !--.push({});
                    -- >
                    <
                    !--
                </script>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--
    @endif-->
            @endforeach
        </div>
    </div>
    <!-- Populer -->
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12 text-center forBoxAds">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                    crossorigin="anonymous"></script>
                <!-- New Box Ads -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4711089720936751"
                    data-ad-slot="6565579201" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
        <h5 class="text-center"><span language="eng"><i class="fa-solid fa-fire-flame-curved"></i> Popular Movie</span>
        </h5>
        <div class="line-mf rounded"></div>
        <div class="owl-carousel owl-theme owl-loaded ">
            @foreach ($popMovies as $popMov)
                <div class="mx-2">
                    <div class="card w-100 rounded" style="height: 200px" style="background: #303030">
                        <div class="bg-image hover-overlay ripple " data-mdb-ripple-color="light">
                            <img style="height: 200px"
                                data-src="@if ($popMov->image == null) {{ $popMov->image_link }} @else {{ asset('storage/movie_photos/' . $popMov->image) }} @endif"
                                class="img-fluid  owl-lazy w-100">
                            <a href="{{ route('user#movie_info', $popMov->id) }}" class="h-100">
                                <div class="mask w-100" style="background-color: rgba(251, 251, 251, 0.15)">
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            @php  $floorRate= round($popMov->rating($popMov->id)) @endphp
                            @for ($a = 0; $a < 4; $a++)
                                <i
                                    class="fa-solid fa-star
                            @if ($floorRate > $a) text-warning @endif"></i>
                            @endfor
                            <small class="fs-smallest opacity-75 text-muted"><i class="fa-solid fa-eye "></i>
                                @if ($popMov->view_count <= 999)
                                    {{ $popMov->view_count }}
                                @else
                                    {{ round($popMov->view_count / 1000, 1) }}K
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
                {{-- For Ads  --}}
                <!--@if ($loop->index % 2 == 0)
    -->
                <!--    <div class="mx-2">-->
                <!--        <div class="card w-100 rounded" style="height: 200px" style="background: #303030">-->
                <!--            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751" -->
                                <!--                crossorigin="anonymous"></script>-->
                <!--            <ins class="adsbygoogle" style="display:block" data-ad-format="fluid"-->
                <!--                data-ad-layout-key="-6t+ed+2i-1n-4w" data-ad-client="ca-pub-4711089720936751"-->
                <!--                data-ad-slot="5352553970"></ins>-->
                <!--            <script>
                    -- >
                    <
                    !--(adsbygoogle = window.adsbygoogle || []) -- >
                    <
                    !--.push({});
                    -- >
                    <
                    !--
                </script>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--
    @endif-->
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let _token
        $(".owl-carousel").owlCarousel({
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 5000,
            smartSpeed: 700,
            items: 4.5,
            nav: true,
            loop: true,
            lazyLoad: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false
                }
            }
        });
        $(document).ready(function() {
            $('.nav-home').addClass('active')
            $('#phoneBillBtn').click(function() {
                let status = parseInt($('.crypto_point').html());
                console.log(status);
                if (status > 0) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('user#is_winner') }}",
                        data: {
                            status
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.error) {
                                Swal.fire('Sorry', response.error, 'error');
                            }
                            if (response.success) {
                                Swal.fire('Congratulation', response.success, 'success');
                                window.location.href = '{{ route('user#lucky_add_phone') }}'
                            }
                        }
                    });
                } else {
                    Swal.fire('Sorry', 'ကံစမ်းခွင့် မလုံလောက်ပါ', 'info');
                }
            });
        });
    </script>
@endpush
