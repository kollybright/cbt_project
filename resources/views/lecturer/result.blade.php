@extends('lecturer.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <h6 class="text-center text-info">{{$course->course_code}}-{{$course->course_title}} Result</h6>

            <div class="form-group">
                <label for="view-result">Select by Session </label>
                <select id="view-result"  class="form-control">
                    <option>Available results</option>
                    @foreach($test as $key=>$value)
                        <option value="{{$value->id}}">
                            {{$value->session}}
                        </option>
                        @endforeach
                </select>
            </div>

            <div id="view_result_status" class="text-danger text-center font-weight-bold"></div>
            <div class="card" id="result_card">
                <div class="card-header">
                    <div id="print_download"><button class="btn btn-sm btn-outline-secondary"><i class="fa fa-download"></i></button>
                    <button id="print" class="btn btn-sm btn-outline-info float-right" onclick="print()"><i class="fa fa-print"></i></button>
                    </div>

                </div>
                <div class="card-body">
                    <table id="view_result_table" class="table table-responsive-sm table-striped">
                        <thead>
                        <tr>
                            <th>Reg no</th>
                            <th>Surname</th>
                            <th>First Name</th>
                            <th>Score</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Reg no</th>
                            <th>Surname</th>
                            <th>First Name</th>
                            <th>Score</th>
                            <th>Total</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection
