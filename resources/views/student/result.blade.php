@extends('student.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            {{--{{$test}}--}}

                    <div class="card">
                        <div class="card-body">
                            <table id="scheduled_test" class="table table-responsive-sm  table-hover">
                                <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Score</th>
                                    <th>Total</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $key=>$value)
                                    <td>{{$value->course_code}}</td>
                                    <td>{{$value->course_title}}</td>
                                    <td>{{$value->score}}</td>
                                    <td>{{$value->total}}</td>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Score</th>
                                    <th>Total</th>




                                </tr>
                                </tfoot>


                            </table>
                        </div>
                        <div class="card-footer bg-dark"></div>
                    </div>


        </div>
    </div>
@endsection
