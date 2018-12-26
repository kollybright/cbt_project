<script>
    $(function(){
        $('#refresh').click(function(){
            $('#modal').modal('hide');
            location.reload();
        });

        $('#courses,#scheduled_test').dataTable({
            "order":[]
        });

        $('#view-result').change(function(event){
            event.preventDefault();
            // table.ajax.reload();
            var test_id= $(this).val();
            var txt = $(this).text();
            var token = "{{csrf_token()}}";
            var url="{{url('lecturer/view_result')}}/"+test_id;

            if(test_id!=="Available results") {
                $.ajax({
                    type:'POST',
                    url:"{{url('lecturer/view_result')}}",
                    data:{id:test_id,_token:token},
                    dataType:'json',
                    beforeSend: function() {
                        $('#view_result_status').html('Wait, please!.....');
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Error: Not connected.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Error: Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Error: Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Error: Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Error: Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Error: Ajax request aborted.';
                        }
                        //laravel
                        else if (jqXHR.status == 405) {
                            msg = 'Error: Http method not allowed';
                        }
                        else if (jqXHR.status == 419) {
                            msg = 'Error: No active session,refresh or login';
                        }

                        else {
                            // msg = 'Uncaught Error.\n' + jqXHR.responseText;
                            msg= 'Uncaught Error';
                        }

                        $('#view_result_status').html(msg);
                    },

                        success:function(result){
                        if(result.length==0){
                            $('#view_result_status').html('No result availabe');
                        }
                        else {
                            $('#view_result_status').html('now showing');
                        }

                      assignToEventsColumns(result);
                    },

                });


            }
        });
        function assignToEventsColumns(data){
            var table = $("#view_result_table").dataTable({
               "processing":true,
                "paging":true,
                "destroy":true,
                "bAutoWidth":false,
                "aaData":data,
                "columns":[{
                    "data":"matric_no"
                },{
                    "data": "lastname"
                },{
                    "data":"firstname"
                },
                {
                    "data":"score"
                },{
                    "data":"total"
                    }
                    ]
            });
        }


        $('#go_to_course').change(function(event){
            event.preventDefault();
            var course= $(this).val();
            if(course!="Available courses" || course !="No available course, add course") {
                var path = "{{url('lecturer')}}/"+course;
                window.location = encodeURI(path);
            }
        });

        $('.delete_question').click(function(){
            var id= $(this).val();
            var token ="{{csrf_token()}}";
            if (confirm('Are you sure?')==true){
                $.ajax({
                    type:'POST',
                    url:"{{url('lecturer/delete_question')}}",
                    data:{'id':id,'_token':token},
                    beforeSend: function() {
                        $('#loading').modal();
                    },
                    complete: function() {
                        $('#loading').modal('hide');
                    },
                    success:function(result){
                        $('#modal #result').html(result+"<br>"+" Click refresh to reflect changes");
                        $('#modal').modal();
                    }
                });
            }

        });
        $('#trash').click(function(){
            var id= $(this).val();
            var token ="{{csrf_token()}}";
            if (confirm("Are you sure?\nclicking 'Ok' will erase all questions for this course.")==true){
                $.ajax({
                    type:'POST',
                    url:"{{url('lecturer/trash_question')}}",
                    data:{'id':id,'_token':token},
                    beforeSend: function() {
                        $('#loading').modal();
                    },
                    complete: function() {
                        $('#loading').modal('hide');
                    },
                    success:function(result){
                        $('#modal #result').html(result+"<br>"+" Click refresh to reflect changes");
                        $('#modal').modal();
                    }
                });
            }

        });

        $('#delete_group').click( function(){
            var checked= [];
            var token ="{{csrf_token()}}";
            $("input:checkbox[name=group_delete]:checked").each(function(){
                checked.push($(this).val());
            });
            if (confirm('Are you sure?')==true){
                $.ajax({
                    type:'POST',
                    url:"{{url('lecturer/group_delete_question')}}",
                    data:{'id':checked,'_token':token},
                    beforeSend: function() {
                        $('#loading').modal();
                    },
                    complete: function() {
                        $('#loading').modal('hide');
                    },
                    success:function(result){
                        $('#modal #result').html(result+"<br>"+" Click refresh to reflect changes");
                        $('#modal').modal();
                    }
                });
            }
        });

        $('.edit_question').click(function(){
            var question, a, b, c, d,correct_option,course_id;
            correct_option= $(this).prevAll().eq(1).text();
            d= $(this).prevAll().eq(4).text();
            c= $(this).prevAll().eq(6).text();
            b= $(this).prevAll().eq(8).text();
            a= $(this).prevAll().eq(10).text();
            course_id=$(this).val();
            question= $(this).prevAll().eq(12).text();
            localStorage.setItem('course_id',course_id);
            $('#update_question_modal #question').val(question);
            $('#update_question_modal #a').val(a);
            $('#update_question_modal #b').val(b);
            $('#update_question_modal #c').val(c);
            $('#update_question_modal #d').val(d);
            $('#update_question_modal #correct_option').val(correct_option);
            $('#update_question_modal').modal();
        });

        $('.update_question').click(function(){
            var question, a, b, c, d,correct_option,course_id;
            question= $('#question').val();
            var token ="{{csrf_token()}}";
            a=$('#a').val();
            b=$('#b').val();
            c=$('#c').val();
            d=$('#d').val();
            correct_option=$('#correct_option').val();
            course_id=localStorage.getItem('course_id');
//                alert(question+a+b+c+d+correct_option+course_id)
            if(question!='' && a!='' && b!='' && c!='' && d!='' && correct_option!='null') {
                $.ajax({
                    type: 'POST',
                    url: "{{url('lecturer/modify_question')}}",
                    data: {
                        id: course_id,
                        question: question,
                        a: a,
                        b: b,
                        c: c,
                        d: d,
                        correct_option: correct_option,
                        _token:token
                    },
                    beforeSend: function() {
                        $('#update_question_modal #update_error').addClass('d-block').html('Handling request...');
                    },
                    complete: function() {
                        $('#update_question_modal #update_error').html('Sent');
                        $('#update_question_modal').modal('hide');
                    },
                    success: function(result) {
                        $('#modal #result').html(result + "<br>" + " Click refresh to reflect changes");
                        $('#modal').modal();

                    }
                });
            }
            else{
                $('#update_error').addClass('d-block');
            }

        });

        $('table').on( 'click','.delete_test',function(){
            var id= $(this).val();
            var token ="{{csrf_token()}}";

            if (confirm('Are you sure?')==true){
                $.ajax({
                    type:'POST',
                    url:"{{url('lecturer/test_delete')}}",
                    data:{'id':id,'_token':token},
                    beforeSend: function() {
                        $('#loading').modal();
                    },
                    complete: function() {
                        $('#loading').modal('hide');
                    },
                    success:function(result){
                        $('#modal #result').html(result+"<br>"+" Click refresh to reflect changes");
                        $('#modal').modal();
                    }
                });
            }

        });
        $('table').on('click','.modify_test',function(){
            var question_no, duration, session, start_date,test_id;
            test_id= $(this).val();
            // question_no= $(this).parent().prevAll().eq(4).text();
            duration= $(this).parent().prevAll().eq(3).text();
            session= $(this).parent().prevAll().eq(2).text();
            start_date= $(this).parent().prevAll().eq(1).text();
            $('input[name=update_test_number]').val(question_no);
            $('input[name=update_test_duration]').val(duration);
            $('input[name=update_test_start_time]').val(start_date);
            $('input[name=update_session]').val(session);
            localStorage.setItem('test_id', test_id)


        });
        $('.update_test').click(function(){
            var id,test_number,test_duration,start_time,session,course_id,token,max_question;
            // test_number=$('input[name=update_test_number]').val();
            test_duration=$('input[name=update_test_duration]').val();
            start_time=$('input[name=update_test_start_time]').val();
            session=$('input[name=update_session]').val();
            course_id="{{isset($course)?$course->id:''}}";
            token ="{{csrf_token()}}";
            id= localStorage.getItem('test_id');
            {{--max_question= "{{isset($totalQuestion)?$totalQuestion:''}}";--}}
            $('#update_test_modal').modal('hide');



            if(test_duration!='' && start_time!='' ){
                    $.ajax({
                        type:'POST',
                        url:"{{url('lecturer/update_test')}}",
                        data: {
                            id:id,
                            no_of_question:test_number,
                            duration:test_duration,
                            start_time:start_time,
                            session:session,
                            course_id:course_id,
                            _token: token
                        },
                        beforeSend: function() {
                            $('#loading').modal();
                        },
                        complete: function() {
                            $('#loading').modal('hide');
                        },
                        success:function(result){
                            $('#modal #result').html(result+"<br>"+" Click refresh to reflect changes");
                            $('#modal').modal();
                        }
                    });

            }
            else{
                alert(`Please enter necessary fields properly
 NB: total number of available question = ${max_question}`);
            }
        });


    });

</script>