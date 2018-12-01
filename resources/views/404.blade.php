<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Page not found / Denied Access</title>
    <!-- Bootstrap core CSS-->
    <!-- Bootstrap core CSS-->
    <link href="{{URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{URL::asset('assets/css/sb-admin.css')}}" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <style>
        body,html{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;;
            background-color: #f5f5f5;
        }
        a{
            color: #0069d9;
            font-size: large;
            text-decoration: none;
        }
    </style>
</head>

<body class="bg-dark">
<div class="container">
    {{--{{sha1('kolawole1')}}--}}
    <div class="card card-login mx-auto mt-5">
        <div class="card-body">
            <h4 class="text-danger">Sorry, it seems you don't have clearance for this page.</h4>
        </div>
        <div class="card-footer">
            {{--<a href="{{URL::current()}}">Return back to dashboard <i class="fa fa-arrow-left"></i></a>--}}
        </div>


    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Core plugin JavaScript-->
<script src="{{URl::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
</body>

</html>
