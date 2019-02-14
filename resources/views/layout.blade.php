<!DOCTYPE html>
<html lang="en">
<head>
   @yield('header')
</head>
<body class="bg-light">
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-laravel bg-dark">
        <div class="container">
            <a class="navbar-brand"  href="{{ url('/') }}">
                <img class="img-responsive img-round" src="{{asset('OAU_logo.jpg')}}"  height="90" alt="OAU_LOGO">
                <small style="font-size: 0.7em">Computer Science & Engineering CBT System</small>
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
                        <a  href="{{url('contact')}}" class="nav-link text-white">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('about')}}" class="nav-link text-white">About Us</a>
                    </li>
                </ul>
            </div>

        </div>

    </nav>

    <div class="container-fluid">
       @yield('content')

    </div>
</div>

<footer class="sticky-footer fixed-bottom btn-dark text-center" style="height:3em;">
    Copyright © OAU Computer Science & Engineering CBT System 2018
</footer>
<!-- Bootstrap core JavaScript-->
<script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Core plugin JavaScript-->
<script src="{{URl::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
</body>
</html>

