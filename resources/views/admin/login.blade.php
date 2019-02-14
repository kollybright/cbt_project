@extends('layout')
@section('header')

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin Login</title>
  <!-- Bootstrap core CSS-->
    <!-- Bootstrap core CSS-->
    <link href="{{URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    {{--<link href="{{URL::asset('assets/css/sb-admin.css')}}" rel="stylesheet">--}}
    <!-- Page level plugin CSS-->
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header text-center">Admin Login page</div>
      <div class="card-body">
        <form method="POST" action="{{url('admin/valid_login')}}">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" name="username" id="username"  type="text"  value="{{old('username')}}" placeholder="Username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control"  name="password" id="password" type="password"  placeholder="Password" required>
          </div>
          <input type="submit"  value="Login" class="btn btn-info btn-block">
        </form>
      </div>
        <div class="card-footer text-center">
            <span class="text-danger ">
            @if ( $errors->has('fail') )
                    <i class="fa fa-warning"></i> {{$errors->first('fail')}}
                @endif
            </span>
        </div>
    </div>
  </div>
  @endsection

