<?php

namespace App\Http\Controllers;

use App\Question;
use App\Test;
use Illuminate\Http\Request;
use DB;
use Illuminate\Http\Response;

class Exam extends Controller
{
    function index(){
        $question= new Question();



        $exam = $question->select('question','a','b','c','d','course_id')->where(['course_id'=>1])->get()->toJson();

        return view('exam.exam',['exam'=>$exam]);
    }

    function  selectTest(){
        $tests= \App\Test::join('course','test.id','=','course.id')
            ->select('test.*','course.course_code','course.course_title')
            ->orderBy('test.created_at','DESC')
            ->getQuery()
            ->get();
        return view('exam.selectTest',['test'=>$tests]);

    }
    function submit(Request $request){
        $id= $request->input('question_id');
        $option = $request->input('option');
        $jon = array_merge($id,$option);
        return  response()->json($jon);
    }

}