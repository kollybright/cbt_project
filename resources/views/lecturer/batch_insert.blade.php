@extends('lecturer.layout')
@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-12">
            <div class="alert alert-info">
                <h6 class="text-center">Uploading batch questions to {{$course->course_code}}:{{$course->course_title}}</h6>
            </div>
            <div class="card notice">
                <div class="card-header text-danger">
                    *** Notice: You can only upload CSV and txt files and they have to be in the formats of the images below <i class="fa fa-hand-o-down"></i>
                    <br>Questions followed by fours options (a-d) followed by the correct options.***
                </div>
                <div class="card-body">
                    <span class="text-info font-weight-bold">csv file</span>
                    <img  src="{{asset('example.png')}}" alt="csv file format" class="img-responsive img-fluid card-img-top">
                    <span class="text-info font-weight-bold">txt file</span>
                    <img  src="{{asset('txt.png')}}" alt="txt file format" class="img-responsive img-fluid card-img-bottom">

                </div>

            </div>


            <br>
            <div class="card">
                <div class="card-header">
                    <span class="text-danger font-weight-bold">Upload  CSV or TXT file</span>
                       @if(session()->has('error'))
                           <div class="alert alert-danger">
                               <i class="fa fa-warning"> {{session('error')}}</i>
                           </div>
                        @endif
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                            <i class="fa fa-thumbs-up"></i>  {{session('message')}}
                            </div>
                        @endif


                </div>
                <form method="post" action="{{url('lecturer/batch_insert')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input name="upload" id="upload" type="file" class=" form-control form-control-file"  value="{{old('upload')}}" required="required">
                        <small class="upload_error text-danger">
                            @if($errors->has('upload'))
                                {{$errors->first('upload')}}
                            @endif
                        </small>
                    </div>
                    <div class="form-group">
                    <button name="submit" value="{{$course->id}}" type="submit" class="btn btn-info text-center form-control">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection