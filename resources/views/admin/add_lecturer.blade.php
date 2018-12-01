@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="add">
                <form method="POST" action="{{url('admin/lecturer_add')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input class="form-control" name="email" id="email" type="email" value="{{old('email')}}" placeholder="Enter email address" required>
                        <span class="text-danger">@if($errors->has('email')){{$errors->first('email')}}@endif </span>

                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" name="password" id="password" type="password"  placeholder="Enter password" required>
                        <span class="text-danger">@if($errors->has('password')){{$errors->first('password')}}@endif </span>

                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input class="form-control" name="confirm_password" id="confirm_password" type="password"  placeholder="Confirm password" required>
                        <span class="text-danger">@if($errors->has('confirm_password')){{$errors->first('confirm_password')}}@endif </span>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input class="form-control" name="first_name" id="first_name" type="text" value="{{old('first_name')}}"  placeholder="Enter first name" required>
                        <span class="text-danger">@if($errors->has('first_name')){{$errors->first('first_name')}}@endif </span>

                    </div>
                    <div class="form-group">
                        <label for=last_name">Last Name</label>
                        <input class="form-control" name="last_name" id="last_name" type="text"  value="{{old('last_name')}}" placeholder="Enter last name" required>
                        <span class="text-danger">@if($errors->has('last_name')){{$errors->first('last_name')}}@endif </span>

                    </div>

                    <button type="submit" class="btn btn-dark btn-block" id="add_lecturer">Add</button>
                </form>
                @if(session('success'))
                    <br><div class="alert alert-success">
                        {{session('success')}}
                    </div>

                @elseif(session('fail'))
                    <br><div class="alert alert-danger">
                        {{session('fail')}}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection