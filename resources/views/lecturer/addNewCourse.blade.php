@extends('lecturer.layout')
@section('content')
    <div class="row">
        <div class="col-12">
    <form method="POST" action="{{url('lecturer/add_course')}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group {{$errors->has('course_code')?'has-error':''}}">
            <label for="course_code">Course Code</label>
            <input class="form-control" name="course_code" id="course_code" value="{{old('course_code')}}" type="text"  placeholder="Enter Course Code" required>
            <span class="text-danger">{{$errors->has('course_code')?$errors->first('course_code'):''}}</span>
        </div>
        <div class="form-group {{$errors->has('course_title')?'has-error':''}}">
            <label for="course_title">Course Title</label>
            <input class="form-control" name="course_title" id="course_title" type="text" value="{{old('course_title')}}" placeholder="Enter Course Title" required>
            <span class="text-danger">{{$errors->has('course_title')?$errors->first('course_title'):''}}</span>
        </div>
        <div class="form-group {{$errors->has('semester')?'has-error':''}}">
            <label for="semester">Select Course Semester</label>
            <select class="form-control" name="semester" id="semester" required>
                <option value="rain">Rain</option>
                <option value="harmattan">Harmattan</option>
                </select>
            <span class="text-danger">{{$errors->has('semester')?$errors->first('semester'):''}}</span>
        </div>
        <button type="submit" class="btn btn-dark btn-block">Add new course</button>
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
@endsection
