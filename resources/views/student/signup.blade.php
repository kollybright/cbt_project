<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student Registration</title>
    <!-- Bootstrap core CSS-->
    <!-- Bootstrap core CSS-->
    <link href="{{URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{URL::asset('assets/css/sb-admin.css')}}" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
</head>

<body class="bg-secondary">
<div class="container">
    <div class="card card-register bg-dark text-white mx-auto mt-5">
        <div class="card-header text-center font-weight-bold">Student Registration Form<br>
            @if(session('success'))
                <br><div class="alert alert-success">
                    {{session('success')}}<br>
                    <a href="{{url('student/login')}}">Login now</a>
                </div>

            @elseif(session('fail'))
                <br><div class="alert alert-danger">
                    {{session('fail')}}
                </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{url('student/valid_register')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                            <label for="firstname">First name</label>
                            <input class="form-control" name="firstname" id="firstname" value="{{old('firstname')}}" type="text" aria-describedby="nameHelp" placeholder="Enter first name" required>
                    <small class="text-danger">{{$errors->has('firstname')?$errors->first('firstname'):''}}</small>
                        </div>
                <div class="form-group">
                            <label for="lastname">Last name</label>
                            <input class="form-control" name="lastname" id="lastname" type="text" value="{{old('lastname')}}" aria-describedby="nameHelp" placeholder="Enter last name" required>
                    <small class="text-danger">{{$errors->has('lastname')?$errors->first('lastname'):''}}</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name="password" id="password" type="password"  aria-describedby="nameHelp" placeholder="Enter password" required>
                    <small class="text-danger">{{$errors->has('password')?$errors->first('password'):''}}</small>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confrim Password</label>
                    <input class="form-control {{$errors->has('confirm_password')?$errors->first('confirm_password'):''}}" name="confirm_password" id="confirm_password" type="password"  aria-describedby="nameHelp" placeholder="Enter confirm password" required>
                    <small class="text-danger">{{$errors->has('confirm_password')?$errors->first('confirm_password'):''}}</small>
                </div>
                <div class="form-group">
                    <label for="matric_no">Matric Number</label>
                    <input class="form-control" name="matric_no" id="matric_no" type="text" value="{{old('matric_no')}}" aria-describedby="nameHelp" placeholder="Enter Matric No" required>
                    <small class="text-danger">{{$errors->has('matric_no')?$errors->first('matric_no'):''}}</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input class="form-control" name="email" id="email" type="email" value="{{old('email')}}" aria-describedby="emailHelp" placeholder="Enter email" required>
                    <small class="text-danger">{{$errors->has('email')?$errors->first('email'):''}}</small>
                </div>
                <div class="form-group">
                    <label for="option">Option</label>
                    <select name="option" id="option" class="form-control" required>
                        <option value="mathematics">Mathematics</option>
                        <option value="economics">Economics</option>
                        <option value="engineering">Engineering</option>
                    </select>
                    <small class="text-danger">{{$errors->has('option')?$errors->first('option'):''}}</small>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>

        </div>
    </div>
    <div class="card-footer">

    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Core plugin JavaScript-->
<script src="{{URl::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
</body>

</html>
