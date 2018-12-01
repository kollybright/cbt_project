@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-12">

          <div class="container">
              <div class="card">
                  <div class="card-header">
                      Manage Lecturer
                  </div>
                  <div class="card-body">
             <table id="manage_lecturer" class="table table-hover table-responsive-sm">
                 <thead>
                     <tr>
                         <th width="30%">Email</th>
                         <th width="40%">First Name</th>
                         <th width="30%">Last Name</th>

                     </tr>
                 </thead>
                 <tbody>
                 @foreach($data as $key=>$value)
                     <tr>
                         <td>{{$value->email}}</td>
                         <td>{{$value->first_name}}</td>
                         <td>{{$value->last_name}}</td>

                     </tr>
                 @endforeach
                 </tbody>

                 <tfoot>
                 <tr>
                     <th>Email</th>
                     <th>First Name</th>
                     <th>Last Name</th>

                 </tr>
                 </tfoot>

             </table>
                      </div>
                  <div class="card-footer">

                  </div>
                  </div>


          </div>





        </div>
    </div>


@endsection