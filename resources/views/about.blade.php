@extends('layout')
@section('header')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>About Us</title>
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
            /*width: 50%;*/
        }
    </style>
@endsection

@section('content')
    <div class="py-4 container ">
        <div class="card  text-center mx-auto mt-5 mb-5">
            <div class="card-header text-center text-info">
                About
            </div>
            <div class="card-body text-secondary">
            <div class="card-img mb-1">
                <img src="{{asset('IMG_20170620_172816.jpg')}}" class="center-img" alt="Admin">
                <div class="card-title">Developer: Kolawole Oyafajo</div>
                <p>Department: of Computer Science and Engineering</p>
                <p> Major: Computer Science With Mathematics</p>
                <p>Nationality: Nigeria</p>
                <p>State of Origin: Oyo State </p>
                </div>
            </div>
        </div>
    </div>
@endsection

