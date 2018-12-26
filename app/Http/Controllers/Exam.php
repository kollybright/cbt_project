<?php

namespace App\Http\Controllers;

use App\Question;
use App\Result;
use App\StudentResponse;
use App\TakenTest;
use App\Test;
use Illuminate\Http\Request;
use DB;
use Illuminate\Http\Response;
use mysql_xdevapi\Exception;
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
        $taken_test = new TakenTest();
        $responses= json_decode($request->input('responses'),true);
        $test_id = $request->input('test_id');
        $total = $request->input('total');
        $student_id = session('student_id');
        if($taken_test->where(['student_id'=>$student_id,'test_id'=>$test_id])->count()==0){

            foreach($responses as $key=>$value){
                try{
                    $studentResponse = new StudentResponse();
                    $studentResponse->student_id = $student_id;
                    $studentResponse->test_id = $test_id;
                    $studentResponse->question_id = $value[0];
                    $studentResponse->response = $value[1];
                    $studentResponse->save();
                }
                catch (\Exception $err){

                     $err->getTrace();
                }
            }
            try{
                $taken_test->student_id = $student_id;
                $taken_test->test_id = $test_id;
                if($taken_test->save()){
                    session()->forget(['take_exam']);
                    $this->grade($student_id,$test_id,$total);
                }
            }
            catch (\Exception $err){

                $err->getTrace();

            }

        }


    }
    function grade($student_id,$test_id,$total){

        $tab = new StudentResponse();
        $result = new Result();
        $score =0;
        $query= $tab->join('questions','response.question_id','=','questions.id')
            ->where(['response.student_id'=>$student_id,'response.test_id'=>$test_id])
            ->select('response.response', 'questions.correct_option')
            ->getQuery()
            ->get();
        foreach ($query as $value){
            if($value->response == $value->correct_option){
                ++$score;
            }
        }
        $result->student_id = $student_id;
        $result->test_id = $test_id;
        $result->score = $score;
        $result->total  = $total;
        $result->save();


    }

}