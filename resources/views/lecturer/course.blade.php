@extends('lecturer.layout')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">{{$course->course_code}}-{{$course->course_title}}</h1>
            <h6 class="text-danger text-center ">You have {{$question->total()}} questions available for this course <i class="fa fa-hand-pointer-o"></i></h6>
         {{--<br>--}}
          <div class="questions">
              @if(count($question)==0)
                  <p class="alert alert-info font-weight-bold">No question is available for this course, you can start adding questions </p>
              @else
                  <div class="text-center">
                      <label for="trash" class="text-danger">Recyle questions</label>
                      <button name="trash" id="trash" value="{{$course->id}}" class="btn btn-white"><i class="fa fa-recycle text-danger"></i></button>
                  </div>
              @endif

             <div class="questions">
            @foreach($question as $key=>$value)
                <span>{{$value->question}}</span><br>
                  A:&nbsp;<span>{{$value->a}}</span><br>
                  B:&nbsp;<span>{{$value->b}}</span><br>
                  C:&nbsp;<span>{{$value->c}}</span><br>
                  D:&nbsp;<span>{{$value->d}}</span><br>
                  <b class="text-secondary">Correct Option:&nbsp;</b><span><b class="text-capitalize">{{($value->correct_option)}}</b></span>
                  <br>
                <button value="{{$value->id}}" name="edit_question"  data-toggle="modal" class="edit_question btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></button>
                <button value="{{$value->id}}" name="delete_question" class="delete_question btn btn-sm btn-outline-danger"><i class="fa fa-times-circle"></i></button>
                <br>
                <input  value="{{$value->id}}" id="{{$value->id}}" type="checkbox" class=" form-control-lg  group_delete" name="group_delete">
                <label for="{{$value->id}}">Batch delete</label>
                <br><br>
            @endforeach
              </div>
             </div>
            @if(count($question)!=0)
                <button class="btn btn-sm btn-outline-danger float-right" id="delete_group">Delete Marked</button>
            @endif
            <br><br>
            <div class="float-left"> {{$question->links()}}</div>

        </div>
    </div>
    <div class="modal fade" id="update_question_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <label for="question">Question</label>
                        <textarea name="question" class="form-control" id="question" > </textarea>

                    </div>
                    <div class="form-group">
                        <label for="a">Option A</label>
                        <textarea name="a" class="form-control" id="a" ></textarea>

                    </div>
                    <div class="form-group">
                        <label for="b">Option B</label>
                        <textarea name="b" class="form-control" id="b" ></textarea>

                    </div>
                    <div class="form-group">
                        <label for="c">Option C</label>
                        <textarea name="c" class="form-control" id="c" ></textarea>

                    </div>
                    <div class="form-group">
                        <label for="d">Option D</label>
                        <textarea name="d" class="form-control" id="d" ></textarea>

                    </div>
                    <div class="form-group">
                        <label for="correct_option">Specify Correct Option</label>
                        <select id="correct_option" name="correct_option" class="form-control">
                            <option value="null">Choose correct option</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>

                    </div>

                    <p id="update_error" class="text-danger text-center d-none">Please enter required fields</p>
                </div>
                <div class="modal-footer">


                    <button  value="{{$course->id}}" type="submit" class="update_question btn btn-primary btn-block">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection