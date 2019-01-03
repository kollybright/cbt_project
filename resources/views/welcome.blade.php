<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CBT</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-laravel bg-dark">
        <div class="container">
            <a class="navbar-brand"  href="{{ url('/') }}">
                <img class="img-responsive img-round" src="{{asset('OAU_logo.jpg')}}"  height="90" alt="OAU_LOGO">
                <span class="">CBT System</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{url('lecturer')}}">
                        Examiner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{url('admin')}}">Admin</a>
                </li>
                <li class="nav-item">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle text-white" type="button" id="menu1" data-toggle="dropdown">Student</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">Student Pages</div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-info" href="{{url('student/register')}}">Registeration Page</a>
                        <a class="dropdown-item text-info" href="{{url('student')}}">Homepage</a>
                    </div>
                </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">About Us</a>
                </li>
            </ul>
                </div>

        </div>

    </nav>

    <main class="py-4">
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                {{--<div class="carousel-item active">--}}
                    {{--<img height="100%" width="100%" src="{{asset('images(6).jpg')}}"  alt="">--}}
                {{--</div>--}}
                <div class="carousel-item active">
                    <img src="{{asset('teachers_background.jpg')}}" alt="slider-1">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('review-bg.jpg')}}" alt="slider-2">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>


            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>

    </main>
</div>
<footer class="sticky-footer fixed-bottom btn-dark text-center" style="height:3em;">
    Copyright © OAU Computer Science & Engineering CBT System 2018
</footer>

</body>
</html>
