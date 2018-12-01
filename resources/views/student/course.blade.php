@extends('student.layout')
@section('content')
    <div class="row">
        <div class="col-12">
{{--{{$test}}--}}
       @if(count($test)==0)
          <div class="alert alert-info">There are no new scheduled tests yet, please come back later.</div>
       @else
                <h4 class="text-center text-info"> Available Course for Registration</h4>
            <form method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="card">
                <div class="card-header bg-dark ">
                   @if($errors->has('courses'))
                       <div class="alert alert-dismissible alert-info ">Please select at least one test</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>

                    @elseif(session('fail'))
                        <br><div class="alert alert-danger">
                            {{session('fail')}}
                        </div>
                    @endif
                    <button  type="submit" class="float-right btn btn-sm btn-info" formaction="{{url('student/valid_reg')}}">Register</button>
                </div>
                <div class="card-body">
                    <table id="scheduled_test" class="table table-responsive-sm  table-hover">
                        <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Session</th>
                            <th>Course Lecturer</th>
                            <th>Exam Date</th>
                            <th>Check to Add course</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($test as $key=>$value)
                            <tr>
                                <td>{{$value->course_code}}</td>
                                <td>{{$value->course_title}}</td>
                                <td>{{$value->session}}</td>
                                <td>{{$value->first_name}}&nbsp;{{$value->last_name}}</td>
                                <td>{{$value->start_time}}</td>
                                <td><label for="course"></label><input type="checkbox"  value="{{$value->id}}" name="courses[]" id="course"></td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Session</th>
                            <th>Course Lecturer</th>
                            <th>Exam Date</th>
                            <th>Check to Add course</th>



                        </tr>
                        </tfoot>


                    </table>
                </div>
                <div class="card-footer bg-dark"></div>
            </div>
           </form>
           @endif


        </div>
    </div>
@endsection
