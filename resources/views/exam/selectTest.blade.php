@extends('student.layout')
@section('content')

    <div class="mx-auto mt-5  flex-center font-weight-bold">
        @if(count($test)!=0)
            <div class="form-group">
                <form method="post" action="{{url('student/taking_test')}}">
                    @csrf
                    <label for="go_to_test"><b class="text-danger">Select from the available tests</b></label><br>
                    <select id="go_to_test" name="test_id" class=" go_to_test form-control"  >
                        @if(count($test)==0)
                            <option value="null">No available tests, come back later or contact the examiners
                                @else
                            </option>
                            <option value="null">Available tests</option>
                        @endif

                        @foreach($test as $key=>$value)
                            <option value="{{$value->id}}">{{$value->course_code}} - {{$value->course_title}} </option>
                        @endforeach
                    </select>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger btn-sm">Take Test</button>

                    @if(session()->has('fail'))
                        <br><br>
                        <div class="alert-danger text-center">
                            {{session('fail')}}
                        </div>
                    @endif
                </form>
            </div>
        @else
            <div class="alert  alert-danger">
                You have not registered for any test.
            </div>
        @endif
    </div>

@endsection
