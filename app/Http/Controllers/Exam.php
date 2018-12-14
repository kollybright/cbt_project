<?php

namespace App\Http\Controllers;

use App\Question;
use App\Test;
use Illuminate\Http\Request;
use DB;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\DocBlock\Tags\Method;

class Exam extends Controller
{
    function index($id){
       abort_if(!session()->has('take_exam'),500);
            $test =  new Test();
            $question= new Question();

       abort_if(!$test->find($id),404);

            $course_id= $test->where(['id'=>$id])->select('course_id')->first()->course_id;
            $test_details = $test->where(['id'=>$id])->first();
            $start_time= $test_details->start_time;
            $duration =$test_details->duration;
            $i= strtotime($start_time);
            $to_start = date('M d, Y H:i:s',$i);
            $to_end = date('M d, Y H:i:s', strtotime('+ '.$duration.' minutes',$i));
            $exam = $question->select('id','question','a','b','c','d','course_id')->where(['course_id'=>$course_id])->get()->toJson();
            return view('exam.exam',['exam'=>$exam,'id'=>$id,'start_time'=>$to_start,'end_time'=>$to_end]);
    }


    function submit(Request $request){
        $id= $request->input('question_id');
        $option = $request->input('option');
        $response =
        $jon = array_merge($id,$option);
        return  response()->json($jon);
    }
     function grade(){

        
     }

}