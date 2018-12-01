<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use DB;
use Illuminate\Http\Response;

class Exam extends Controller
{
function index(){
    $question= new Question();

    $exam= $question->select('question','a','b','c','d','course_id')->where(['course_id'=>1])->get()->toJson();
//    var_dump($exam);

//    session()->flush('exam');
//    return response()->json($question->select('question','a','b','c','d','course_id')->where(['course_id'=>1])->get());

    return view('exam.exam',['exam'=>$exam]);
}

function submit(Request $request){
	$id= $request->input('question_id');
	$option = $request->input('option');
	 $jon = array_merge($id,$option);
	return  response()->json($jon);
} 

}