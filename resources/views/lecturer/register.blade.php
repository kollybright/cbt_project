@extends('lecturer.layout')
@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header text-center">
                    <h4>Scheduled Tests for {{$course->course_code}}-{{$course->course_title}}
                    </h4>
                </div>
                <div class="card-body">
                    <table id="scheduled_test" class="table table-responsive table-hover">
                        <thead>
                        <tr>
                            <th>No of Question</th>
                            <th>Exam Duration(Minutes)</th>
                            <th>Session</th>
                            <th>Start Date</th>
                            <th>Update</th>
                            <th>Delete</th>
                            <th>View Registered Student</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($test as $key=>$value)
                            <tr>
                                <td><input name="update_test_number" type="number" min="1" value="{{$value->no_of_question}}" required></td>
                                <td><input name="update_test_duration" type="number" min="1" value="{{$value->duration}}" required></td>
                                <td><input name="session" type="text" value="{{$value->session}}" required></td>
                                <td><input name="update_test_start_time" type="date" value="{{$value->start_time}}" required></td>
                                <td><button value="{{$value->id}}" class=" modify_test btn btn-sm btn-outline-info"><i class=" fa fa-edit"></i></button></td>
                                <td><button value="{{$value->id}}" class="delete_test btn btn-sm btn-outline-danger"><i class="fa fa-times-circle"></i></button></td>
                                <td><a href="{{URL::current()}}/student"><i class="fa fa-male"></i><i class="fa fa-female"></i></a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No of Question</th>
                            <th>Exam Duration(Minutes)</th>
                            <th>Session</th>
                            <th>Start Date</th>
                            <th>Update</th>
                            <th>Delete</th>
                            <th>View Registered Student</th>

                        </tr>
                        </tfoot>


                    </table>
                </div>
                <div class="card-footer"></div>
            </div>


        </div>
    </div>
@endsection