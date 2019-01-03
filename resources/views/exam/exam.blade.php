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
    <script>window.Laravel= {csrfToken: '{{csrf_token()}}'}
    </script>
    <title>Test</title>
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
     .big-text{
         font-size: x-large;
         font-weight: bold;
         font-family: "Britannic Bold";

     }

    </style>
</head>
<body>
<nav class="navbar  navbar-dark bg-dark">
<a class="navbar-brand" href="#">CBT</a>
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
    </li>
</ul>
</nav>
<br>
<div id="app" class="">

    <div class="container">
        <exam
                v-bind:questions="{{json_encode($exam,true)}}"
                v-bind:id="{{json_encode($id,true)}}"
                v-bind:start_time="{{json_encode($start_time,true)}}"
                v-bind:end_time="{{json_encode($end_time,true)}}">
        </exam>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Response</h5>
                </div>
                <div class="modal-body text-danger big-text" id="result">
                </div>
            </div>
        </div>
    </div>
    <span id="submitted" data-toggle="modal" data-target="#examResponse"></span>
</div>

<footer class="sticky-footer fixed-bottom btn-dark">
    <div class="container-fluid">
        <div class="text-center">
            <small>Copyright © OAU Computer Science & Engineering CBT System 2018</small>
        </div>
    </div>
</footer>
<div class="modal fade" id="examResponse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Examination Response</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="result">
                Your Response has been submitted and graded <i class="fa fa-thumbs-up"></i>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('js/app.js')}}"></script>
<script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script>

$(function () {


    document.onkeydown=function () {

        switch (event.keyCode) {
            case 8:
                if (! $('#d').focus()){
                    event.returnValue=false;
                    event.keyCode= 0;
                    // return false;
                }
                break;
            case 17:
                if(event.ctrlKey){
                event.returnValue=false;
                event.keyCode= 0;
                // return false;
                }
                break;
            case 18:

                    event.returnValue=false;
                    event.keyCode= 0;
                    // return false;

                break;


            case 82:
                event.returnValue=false;
                event.keyCode= 0;
                // return false;
                break;

            case 115:
                event.returnValue=false;
                event.keyCode=0;
                // return false
                break;


            case 116:
                event.returnValue=false;
                event.keyCode=0;
                // return false
                 break;
        }

    };

});

</script>
</body>
</html>
