@extends('layout')
@section('header')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Contact Us</title>
    <!-- Bootstrap core CSS-->
    <!-- Bootstrap core CSS-->
    <link href="{{URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    {{--<link href="{{URL::asset('assets/css/sb-admin.css')}}" rel="stylesheet">--}}
    <!-- Page level plugin CSS-->
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <style>
        .center-img{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="py-4 container ">
          <div class="card  mx-auto mt-5 mb-5">
              <div class="card-header text-center">
                  Contact admin, for technical problems
                  <p>Email:</p>
                  <span><i class="fa fa-envelope  text-primary"></i> <a href="mailto:kolaoyafajo@gmail.com">kolaoyafajo@gmail.com</a></span>
                  <p>Or</p>
                  <span><i class="fa fa-envelope text-primary"></i> <a href="mailto:kolaoyafajo@yahoo.com"> kolaoyafajo@yahoo.com</a></span>
                  <p>Phone:</p>
                  <span> <i class="fa fa-phone text-success"></i> +2348168112963</span>
              </div>

          </div>
    </div>
@endsection

