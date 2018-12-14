<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Lecturer Dashboard</title>
    <link href="{{URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{URL::asset('assets/css/sb-admin.css')}}" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <style>
       body{

       }
    </style>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="#">CBT</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{url('lecturer')}}">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            @if(isset($display))

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add Test">
                    <a class="nav-link" href="{{url('lecturer')}}/{{$display}}/add_test">
                        <i class="fa fa-fw fa-plus-square"></i>
                        <span class="nav-link-text"> Create Test</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Scheduled Tests">
                    <a class="nav-link" href="{{url('lecturer')}}/{{$display}}/scheduled_test">
                        <i class="fa fa-fw fa-book"></i>
                        <span class="nav-link-text">Scheduled Tests</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add question">
                    <a class="nav-link" href="{{url('lecturer')}}/{{$display}}/add_question">
                        <i class="fa fa-fw fa-plus-square"></i>
                        <span class="nav-link-text">Insert Question</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Upload question batch">
                    <a class="nav-link" href="{{url('lecturer')}}/{{$display}}/question_upload ">
                        <i class="fa fa-fw fa-file"></i>
                        <span class="nav-link-text">Upload Question Batch</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manage existing questions ">
                    <a class="nav-link" href="{{url('lecturer')}}/{{$display}}">
                        <i class="fa fa-fw fa-wrench"></i>
                        <span class="nav-link-text">Manage Existing Questions</span>
                    </a>
                </li>


            @endif
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Logout">
                <a class="nav-link" data-toggle="modal" data-target="#LogoutModal">
                    <i class="fa fa-fw fa-sign-out"></i>
                    <span class="nav-link-text">Logout</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">

        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
        @if(isset($courses))
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><span class="nav-link-text">Courses</span></button>
                   <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">{{count($courses)!=0?'Available Courses':'No course has been registered'}}</div>
                   <div class="dropdown-divider"></div>
                    @foreach($courses as $k=>$v)
                    <a class="dropdown-item text-info" href="{{url('lecturer')}}/{{$v->id}}">{{$v->course_code}}-{{$v->course_title}}</a>
                    @endforeach

                  </div>
            </div>
            @endif
            <li class="nav-item">
                <a class="nav-link text-white" href="{{url('lecturer/add_new_course')}}"><i class="fa fa-plus-square text-secondary"></i><span class="nav-link-text"> New Course</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white"><i class="fa fa-user-circle text-warning">&nbsp;&nbsp;</i>
                    Hello, {{session('lecturer')}}
                </a></li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">
    <div class="container-fluid">

        @yield('content')
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer" id="footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © OAU Computer Science & Engineering CBT System 2018</small>
            </div>
        </div>
    </footer>
    {{--Loadind--}}
    <div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-labelledby="Request processing" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

                    <img src="{{asset('Spinner-1s-200px (3).gif')}}" class="" alt="Processing Request" style="display:block;
                            margin-left:auto;
                            margin-right:auto">


            </div>
        </div>


    <!-- Logout Modal-->
    <div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{url('lecturer/logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>
{{--Response Modal--}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Response</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="result">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="refresh">Refresh</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{URl::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{URL::asset('assets/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.js')}}"></script>


   @include('lecturer.lecturerJs')


</div>
</body>
</html>
