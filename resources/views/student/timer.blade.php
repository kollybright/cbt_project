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
<body onload="show()">
<nav class="navbar  navbar-dark bg-dark">
    <a class="navbar-brand" href="#">CBT</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa fa-clock-o"></i></a>
        </li>
    </ul>
</nav>
<div id="app" class="flex-center">
    <div class="container">
        <br>
        <navbar></navbar>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script>


    $(function (){

        var c= JSON.parse(localStorage.getItem('q'));
       // alert(question_ids);

    });
     function show(){
         var a= localStorage.getItem('current');
         $('#'+a).removeClass('d-none').addClass('d-block');
     }




</script>
</body>
</html>
 