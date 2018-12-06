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
                        <table id="scheduled_test" class="table table-sm table-responsive  table-hover">
                            <thead>
                            <tr>
                                <th>No of Question</th>
                                <th>Exam Duration(Minutes)</th>
                                <th>Session</th>
                                <th>Start Date</th>
                                <th>Update</th>
                                <th>Delete</th>
                                <th>Registered Student</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($test as $key=>$value)
                                <tr>
                                    <td>{{$value->no_of_question}}</td>
                                    <td>{{$value->duration}}</td>
                                    <td>{{$value->session}}</td>
                                    <td width="20%">{{$value->start_time}}</td>

                                        <td><button value="{{$value->id}}"  data-toggle="modal"  data-target="#update_test_modal" class=" modify_test btn btn-sm btn-outline-info"><i class=" fa fa-edit"></i></button></td>
                                    <td><button value="{{$value->id}}" class="delete_test btn btn-sm btn-outline-danger"><i class="fa fa-times-circle"></i></button></td>
                                    <td><a href="{{URL::current()}}/{{$value->id}}"><i class="fa fa-male"></i><i class="fa fa-female"></i></a> </td>
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



            <div class="modal fade" id="update_test_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-light">
                        <div class="modal-header">
                            <h5 class="modal-title text-muted" id="modal_title2">Update Question</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="result">
                            <div class="form-group">
                             <label for="update_test_number">Question no</label>
                            <input name="update_test_number" id="update_test_number" type="number" class="form-control" min="1" max="{{$totalQuestion}}" required>
                                </div>
                            <div class="form-group">
                                <label for="update_test_duration"> Duration</label>
                            <input name="update_test_duration" id="update_test_duration"  class="form-control" type="number" required>
                               </div>
                            <div class="form-group">
                                <label for="update_session">Session</label>
                            <input name="update_session" id="update_session" class="form-control" type="text" required>
                             </div>
                            <div class="form-group">
                                <label for="update_test_start_time"> Start Date</label>
                            <input name="update_test_start_time" id="update_test_start_time" class="form-control" type="datetime-local" required>
                                </div>


                        </div>
                        <div class="modal-footer">


                            <button  type="submit" class="update_test btn btn-primary btn-block">Update</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
