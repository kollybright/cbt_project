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
            height: 60vh;
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

        </li>
    </ul>
</nav>
<div class="mx-auto mt-5 flex-center">

        <div class="form-group">
         @csrf
        <label for="go_to_test"><b class="text-primary font-weight-bold ">Select from Available Tests</b></label><br>
        <select id="go_to_test" class=" go_to_test form-control-lg">
            @if(count($test)==0)
                <option>No available tests, come back later or contact the examiners
                    @else
                </option><option>Available tests</option>
            @endif

            @foreach($test as $key=>$value)
                <option value="{{$value->id}}">{{$value->course_code}} - {{$value->course_title}} </option>
            @endforeach
        </select>
        </div>



</div>



<script src="{{asset('js/app.js')}}"></script>
<script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script>
    {{--$('#go_to_test').change(function(event){--}}
        {{--event.preventDefault();--}}
        {{--var course= $(this).val();--}}
        {{--if(course!="Available tests" || course !="No available tests, come back later or contact the examiners") {--}}
            {{--var path = "{{url('test')}}";--}}
            {{--window.location = encodeURI(path);--}}
        {{--}--}}
    {{--});--}}
</script>
</body>
</html>