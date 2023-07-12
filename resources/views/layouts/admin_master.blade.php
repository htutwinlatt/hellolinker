<!DOCTYPE html>
<html lang="en">

<head>
    <!--Google Ads -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4675805736722330"
        crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('user/img/linklogo-circle.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/3b62b87f85.js" crossorigin="anonymous"></script>

    <!-- Theme style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @yield('styles')
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('user#home') }}" class="nav-link">View As User</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link"></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline searchForm" method="GET">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" value="{{ request('searchKey') }}"
                                    name="searchKey" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin#dashboard') }}" class="brand-link">
                <img src="{{ asset('user/img/linklogo.jpg') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Hello Liner </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo_path) }}"
                            class="rounded elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group searchForm" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('admin#dashboard') }}" class="nav-link side-movies-dashboard">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Main Dashboard
                                </p>
                            </a>
                        </li>
                        </li>
                        <!-- Movie List -->
                        <li class="nav-item">
                            <a href="#" class="nav-link side-movies">
                                <i class="fa-solid fa-clapperboard"></i>
                                <p>
                                    Movies
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{ route('admin#movie_list') }}" class="nav-link side-movies-list ">
                                        <i class="fa-solid fa-list-ul"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin#movie_insert') }}" class="nav-link side-movies-insert">
                                        <i class="fa-solid fa-square-plus"></i>
                                        <p>Insert</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin#movie_new_arrives') }}"
                                        class="nav-link side-movies-new_arrive">
                                        <i class="fa-solid fa-file-import"></i>
                                        <p>New Arrive</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin#user_list') }}?filterBy=admin" class="nav-link side-users">
                                <i class="fa-solid fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin#slideshow_list') }}" class="nav-link side-slideShows">
                                <i class="fa-solid fa-layer-group"></i>
                                <p>
                                    Slideshows
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin#lucky') }}" class="nav-link side-lucky_draw">
                                <i class="fa-solid fa-sack-dollar"></i>
                                <p>
                                    Lucky Draw
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}" class="nav-link side-post">
                                <i class="fa-solid fa-signs-post"></i>
                                <p>
                                    Posts
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin#report') }}" class="nav-link side-report">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <p>
                                    Report
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('application.index') }}" class="nav-link side-application">
                                <i class="fa-brands fa-google-play"></i>
                                <p>
                                    Applications
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                                onclick="event.preventDefault();document.querySelector('.logoutForm').submit();"
                                class="nav-link">
                                <i class="fa-solid fa-arrow-right-from-bracket" style="transform: rotate(180deg)"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                            <form action="{{ route('logout') }}" class="logoutForm" method="POST">@csrf</form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Main Conatiner -->
        <div class="content-wrapper">
            @yield('routes')
            {{-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
            </div> --}}
            <div class="content-header">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        {{-- <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer> --}}

        {{-- Alert --}}
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            @if (session('status'))
                <div id="liveToast" class="toast show rounded" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="toast-header">
                        <img src="{{ asset('user/img/linklogo.jpg') }}" class="rounded" style="width: 20px"
                            alt="...">
                        <strong class="me-auto">{{ Auth::user()->name }}</strong>
                        <small></small>
                        <button type="button" class="btn btn-link text-light" data-bs-dismiss="toast"
                            aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="toast-body bg-light">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- -- JQuery UI --  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
