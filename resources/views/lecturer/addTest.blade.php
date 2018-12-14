@extends('lecturer.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div>
                <h5>Creating test for {{$course->course_code}}-{{$course->course_title}}</h5>
                @if(session()->has('exists'))
                <div class="alert-danger text-center font-weight-bold">
                    {{session('exists')}}
                </div>
                 @endif
            </div>
            <br>
            <form method="POST"  action="{{url('lecturer/test_add')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                {{--<div class="form-group">--}}
                    {{--<label for="no_of_questions">No of Questions</label>--}}
                    {{--<input class="form-control{{$errors->has('no_of_questions')?'is-invalid':''}}" name="no_of_questions" id="no_of_questions"  value="{{old('no_of_questions')}}" type="number" min="1"  max="{{$totalQuestion}}" placeholder="Enter Number Of Questions" required>--}}
                    {{--<small class="text-danger">{{$errors->has('no_of_questions')?$errors->first('no_of_questions'):''}}--}}
                    {{--</small>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label for=exam_duration"">Exam Duration (minutes)</label>
                    <input class="form-control{{$errors->has('exam_duration')?'is-invalid':''}}" name="exam_duration" id="exam_duration"  value="{{old('exam_duration')}}" type="number" min="1"  placeholder="Enter Exam Duration In Minutes" required>
                    <small class="text-danger">{{$errors->has('exam_duration')?$errors->first('exam_duration'):''}}</small>
                </div>
                <div class="form-group">
                    <label for="exam_start_date">Date Time</label>
                    {{--<input class="form-control" name="start_time" id="exam_start_date" type="datetime-local"  value="{{old('start_time')}}" placeholder="Enter Date Of Exam" required>--}}
                    <input class="form-control{{$errors->has('start_date')?'is-invalid':''}}" name="start_date" id="exam_start_date" type="datetime-local"  value="{{old('start_date')}}" placeholder="Enter Date Of Exam" required>
                    <small class="text-danger">{{$errors->has('start_date')?$errors->first('start_date'):''}}</small>

                </div>
                <div class="form-group">
                    <label for=session"">Session <small class="text-info"> E.g. 2013/2014 </small></label>
                    <input class="form-control{{$errors->has('session')?'is-invalid':''}}" name="session" id="session"  value="{{old('session')}}" type="text"   placeholder="Enter the correct Academic Session" required>
                    <small class="text-danger">{{$errors->has('session')?$errors->first('session'):''}}</small>
                </div>
                <button name="course_id" value="{{$course->id}}" type="submit" class="btn btn-primary btn-block">Add</button>
            </form>
            <br>
             @if(session('success'))
                <div class="alert alert-success">
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