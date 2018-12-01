<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <script>window.Laravel= {csrfToken: '{{csrf_token()}}'} </script>
    <title>test</title>
    <style>
        html,body{

            font-size:larger;

        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .full-height {
            height: 100vh;
        }
        .content {
            text-align: center;
        }



    </style>
</head>
<body>
{{--onkeydown ="return( event.keyCode == 154)"--}}
<nav class="navbar  navbar-dark bg-dark">
    <a class="navbar-brand" href="#">CBT</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">
                    <p id="demo" class="float-right text-danger"></p>

                </a>
        </li>
    </ul>
</nav>
<br>
{{--<div id="timer" class="text-center">--}}
{{--<span id="minutes"></span>:<span id="seconds"></span>--}}
{{--</div>--}}
{{--{{strtotime('+ 30 minutes')}}--}}
{{--{{date('M d,Y H:i:s',strtotime('now'))}}--}}
<div id="app" class="flex-center">
    {{--<Timer></Timer>--}}
    {{--{{date('M d, Y H:i:s',strtotime('+ 30 minutes'))}}--}}
    <?php// $a = strtotime('10/24/2018 11:11 PM')?>
    {{--{{date('M d, Y H:i:s', strtotime('+  minutes',$a))}}--}}

    {{--{{}}--}}


    <div class="container">
        <exam v-bind:duration="{date:'{{date('M d, Y H:i:s',strtotime('+ 61 minutes'))}}'}"></exam>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script>

</script>
</body>
</html>