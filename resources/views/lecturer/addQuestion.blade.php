@extends('lecturer.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div>
                <h5 class="text-center">Adding question to {{$course->course_code}}-{{$course->course_title}}</h5>
            </div>
            @if(session('success'))
                <br><div class="alert alert-success">
                    {{session('success')}}
                </div>

            @elseif(session('fail'))
                <br><div class="alert alert-danger">
                    {{session('fail')}}
                </div>
            @endif

            <form method="POST" action="{{url('lecturer/question_add')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="question">Question</label>
                    <textarea name="question" class="form-control" id="question"  required="required">{{old('question')}} </textarea>
                    <small class="text-danger">{{$errors->has('question')?$errors->first('question'):''}}
                    </small>
                </div>
                <div class="form-group">
                    <label for="a">Option A</label>
                    <textarea name="a" class="form-control" id="a"  required="required">{{old('a')}}</textarea>
                    <small class="text-danger">{{$errors->has('a')?$errors->first('a'):''}}</small>
                </div>
                <div class="form-group">
                    <label for="b">Option B</label>
                    <textarea name="b" class="form-control" id="b"  required="required">{{old('b')}}</textarea>
                    <small class="text-danger">{{$errors->has('b')?$errors->first('b'):''}}</small>
                </div>
                <div class="form-group">
                    <label for="c">Option C</label>
                    <textarea name="c" class="form-control" id="c"  required="required">{{old('c')}}</textarea>
                    <small class="text-danger">{{$errors->has('c')?$errors->first('c'):''}}</small>
                </div>
                <div class="form-group">
                    <label for="d">Option D</label>
                    <textarea name="d" class="form-control" id="d"  required="required">{{old('d')}}</textarea>
                    <small class="text-danger">{{$errors->has('d')?$errors->first('d'):''}}</small>
                </div>
                <div class="form-group">
                    <label for="correct_option">Specify Correct Option</label>
                    <select id="correct_option" name="correct_option" class="form-control">
                        <option value="null">Choose correct option</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                    <small class="text-danger">{{$errors->has('correct_option')?$errors->first('correct_option'):''}}</small>
                </div>
               <div class="form-group">
                <button name="id" value="{{$course->id}}" type="submit" class="btn btn-info btn-block">Add</button>
               </div>
            </form>
        </div>
    </div>
@endsection