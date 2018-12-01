@extends('lecturer.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            @if(isset($course))
          <div class="text-info">
            <h4 class="text-center">  Registered students for {{$course->course_code}} - {{$course->course_title}}</h4>
          </div>
            @endif
           @if(count($students)==0)
                <div class="alert alert-info">
                    <h4 class="text-center">No registration for this test yet!</h4>
                </div>
            @endif
            <div class="card">
                <div class="card-header text-center">

                </div>
                <div class="card-body">
                    <table id="scheduled_test" class="table table-responsive-sm table-hover">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Matriculation Number </th>
                            <th>Option</th>
                            <th>Email</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $key=>$value)
                            <tr>
                               <td>{{$value->firstname}}</td>
                                <td>{{$value->lastname}}</td>
                                <td>{{$value->matric_no}}</td>
                                <td>{{$value->option}}</td>
                                <td>{{$value->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Matriculation Number </th>
                            <th>Option</th>
                            <th>Email</th>
                        </tr>
                        </tfoot>


                    </table>
                </div>
                <div class="card-footer"></div>
            </div>


        </div>
    </div>
@endsection