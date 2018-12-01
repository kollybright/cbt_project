@extends('lecturer.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            {{--{{sha1('kolawole1')}}--}}

            <div class="form-group-lg col-sm-12">
                <label for="go_to_course"><b class="text-primary font-weight-bold ">Go to Course</b></label>
                <select id="go_to_course" class=" go_to_course form-control-lg col-sm-12">
                    @if(count($courses)==0)
                        <option>No available course, add new course
                            @else
                        </option><option>Available courses</option>
                    @endif

                    @foreach($courses as $key=>$value)
                        <option value="{{$value->id}}">{{$value->course_code}} - {{$value->course_title}} </option>
                    @endforeach
                </select>
            </div>
            <br>
            <br>
            <div class="card">
                <div class="card-header text-center text-info"><h5>Attached Courses</h5></div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-hover">
                        <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Semester</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $key=>$value )
                            <tr>
                                <td>{{$value->course_code}}</td>
                                <td>{{$value->course_title}}</td>
                                <td>{{$value->semester}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Semester</th>
                        </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection