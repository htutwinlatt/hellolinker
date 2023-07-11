<!DOCTYPE html>
<html lang="en">

<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
        crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('user/img/linklogo-circle.ico') }}">
    <!-- MDB icon -->
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/3b62b87f85.js" crossorigin="anonymous"></script>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <!-- Dark MDB theme -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('user/css/mdb.dark.min.css') }}" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('owncorousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owncorousel/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/custom.css') }}" />
    <!-- Sweet Alert -->
    <!--<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="{{ asset('user/css/ads.css') }}">
    <!--Google Ads -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
        crossorigin="anonymous"></script>
    @yield('styles')
    <style>
        .forBoxAds {
            background-image: url("{{ asset('user/img/undraw_online_ad_re_ol62.svg') }}");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
        }
    </style>
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-BVFNMG63JW"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-BVFNMG63JW');
</script>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky top-0 mainNav" style="z-index: 100">
        <!-- Container wrapper -->
        <div class="navbar-toggler">
            <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('user#home') }}">
                <img src="{{ asset('user/img/linklogo.jpg') }}" height="40" class="rounded rounded-circle"
                    alt="Linker Logo" />
                <strong>Hello Linker</strong>
            </a>
        </div>
        <div class="container-fluid">
            <!-- Toggle button -->

            <button class="navbar-toggler float-end" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0 hideMobileView" href="{{ route('user#home') }}">
                    <img src="{{ asset('user/img/linklogo.jpg') }}" height="40"
                        class="rounded shadow  rounded-circle" alt="Liner Logo" loading="lazy" />
                    <strong>Hello Linker</strong>
                </a>
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link nav-home" href="{{ url('/') }}"><span language="eng">
                                <i class="fa-solid fa-house"></i> Home</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link nav-movies" href="{{ route('user#movies') }}">
                            <span language="eng"><i class="fa-solid fa-clapperboard"></i> Movies</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link nav-category" href="{{ route('user#category_page') }}"><span
                                language="eng"><i class="fa-regular fa-rectangle-list"></i> Categories</span></a>
                    </li>
                    @if (!empty(Auth::user()))
                        @if (Auth::user()->role == 'admin')
                            <li>
                                <a class="nav-link nav-other" href="{{ route('admin#movie_list') }}"><span><i
                                            class="fa-solid fa-user-shield"></i> Admin-Dashboard</span></a>
                            </li>
                        @endif
                    @endif
                </ul>
                <!-- Search Bar -->
                <div class="nav-item ml-3">
                    <form action="{{ route('user#movies') }}" class="searchForm" method="get">
                        <div class="input-group me-2">
                            <div class="form-outline">
                                <input type="search" id="searchL" name="searchKey" class="form-control"
                                    value="{{ request('searchKey') }}" />
                            </div>
                            <button type="submit" id="searchBtn" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            <button title="Voice Search" type="button" id="vSearchBtn" class="btn btn-secondary">
                                <i class="fa-solid fa-microphone"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Language -->
                <div class="nav-item me-3 me-lg-0 dropdown" style="width: fit-content">
                    <a class="dropdown-toggle btn btn-link text-light m-2 d-flex align-items-center hidden-arrow"
                        href="#" id="languages" role="button" data-mdb-toggle="dropdown"
                        aria-expanded="false"><i class="fa-solid fa-globe me-1"></i>
                        <span class="selLanguage"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="laguage" id="languages">
                        <li>
                            <a class="dropdown-item" language="eng"></i>English</a>
                        </li>
                        {{-- <li>
                            <hr class="dropdown-divider">
                        </li> --}}
                    </ul>
                </div>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">

                @if (Auth::user())
                    <!-- Avatar -->
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                            id="userMore" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo_path) }}"
                                    class="rounded-circle" width="25" height="25" alt=""
                                    loading="lazy" />
                            @else
                                <img src="{{ asset('user/img/default_user.webp') }}" class="rounded-circle"
                                    height="25" alt="User Photo" loading="lazy" />
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMore">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.show') }}"><i
                                        class="fa-solid fa-circle-user me-2"></i>
                                    {{ Auth::user()->name }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault();document.querySelector('.logout-form').submit()"><i
                                        class="fa-solid fa-arrow-right-from-bracket me-2"></i> <span
                                        language="eng">Logout</span></a>
                                <form action="{{ route('logout') }}" method="POST" class="d-none logout-form">@csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex align-items-center">
                        <a href="{{ route('login') }}" class="btn btn-link px-3 me-2">
                            <span language='eng'>login</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary me-3">
                            <span language='eng'>Sign up for free</span>
                        </a>
                    </div>
                @endif

                <!-- Notifications -->
            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    {{-- <div class="container-fluid">
        @if (Auth::user())
            @if (Auth::user()->role == 'user')
                @include('Ads.topPopUp')
                @include('Ads.bottomPopUp')
            @endif
        @else
            @include('Ads.topPopUp')
            @include('Ads.bottomPopUp')
        @endif
    </div> --}}
    @yield('content')
    <!-- Footer Start -->
    <footer class="text-center text-lg-start bg-dark text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="https://m.facebook.com/HelloLinker/" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://t.me/hellolinker" class="me-4 text-reset">
                    <i class="fa-brands fa-telegram"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fa-solid fa-link"></i> Hello Linker
                        </h6>
                        <p>
                            <span language="eng">Hello Linker is trying to become one of the best entertainment
                                channal.</span>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Movie Linker</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Music Linker</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">News Linker</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset"></a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Others
                        </h6>
                        <p>
                            <a href="{{ route('policy') }}" class="text-reset"><i class="fa-solid fa-shield-halved"></i> Privacy Policies</a>
                        </p>
                        <p>
                            <a href="{{ route('aboutUs') }}" class="text-reset"><i class="fa-solid fa-circle-info"></i> About Us</a>
                        </p>
                        <p>
                            <a href="{{ route('contactUs') }}" class="text-reset"><i class="fa-solid fa-door-open"></i> Contact Use</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset"></a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fa-brands fa-facebook me-3"></i> <a
                                href="https://m.facebook.com/HelloLinker/">Hello Linker</a></p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            hellolinkermail@gmail.com
                        </p>
                        <p>
                            <i class="fa-brands fa-telegram me-3"></i>
                            <a href="https://t.me/hellolinker">Hello Linker</a>
                        </p>
                        {{-- <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p> --}}
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/"></a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer End -->

    <!-- Custom scripts -->
    <script src="{{ asset('user/js/jquery.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <!-- MDB -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('user/js/mdb.min.js') }}"></script>
    <!-- Owlcorousel -->
    <script src="{{ asset('owncorousel/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('owncorousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/voicetotext.js') }}"></script>
    <script src="{{ asset('user/js/custom.js') }}"></script>
    <script>
        // AOS.init();
    </script>
    <script>
        if ('{{ session('success') }}') {
            Swal.fire(
                'Success',
                '@php echo session("success") @endphp',
                'success'
            )
        } else if ('{{ session('error') }}') {
            Swal.fire(
                'Fail',
                '@php echo session("error") @endphp',
                'error')
        }
    </script>
    @if (Auth::user())
        @if (Auth::user()->role == 'member')
            <script>
                $('.forBoxAds').addClass('d-none');
                $('.forMovieAds').addClass('d-none');
            </script>
        @endif
    @endif
    @stack('scripts')
</body>

</html>
