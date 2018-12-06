<?php

namespace App\Http\Controllers;

use App\Course;
use App\Question;
use App\Registration;
use App\Student;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class Lecturer extends Controller
{
    function __construct(){

    }
    //  -------------------- view -----------------------------------------
    function index(){
        $course= new Course();
        $courses= $course->where('lecturer_id',session('lecturer_id'))->orderBy('created_at','DESC')->get();
        return view('lecturer.dashboard',['courses'=>$courses]);

    }

    function login(Request $request){
        if($request->session()->has('lecturer_logged_in')){
            return redirect()->action('Lecturer@index');
        }
        else {
            return view('lecturer.login');
        }
    }
    function course(Request $request ,$id){
        $question= new Question();
        $course = new Course();
        $all_courses= $course->where('lecturer_id',session('lecturer_id'))->orderBy('created_at','DESC')->get();
        if(!$course->where('lecturer_id',session('lecturer_id'))->find($id)){
            return view('404');
        }
        else {
            $courses = $course->where('id', $id)->first();
            $questions = $question->where(['course_id' => $id])->orderBy('created_at','DESC')
                ->orderBy('updated_at','DESSC')
                ->paginate(20);
            return view('lecturer.course', ['question' => $questions, 'course' => $courses,'courses'=>$all_courses])->with('display',$id);
        }
    }

    function addQuestionView($id){
        $courses= new Course();
        $all_courses= $courses->where('lecturer_id',session('lecturer_id'))->orderBy('created_at','DESC')->get();
        if(!$courses->where('lecturer_id',session('lecturer_id'))->find($id)){
            return view('404');
        }
        else
        {
            $course= $courses->where('id', $id)->first();
            return view('lecturer.addQuestion',['course' => $course,'courses'=>$all_courses])->with('display',$id);;
        }

    }
    function batchInsertView($id){
        $courses= new Course();
        $all_courses= $courses->where('lecturer_id',session('lecturer_id'))->orderBy('created_at','DESC')->get();
        if(!$courses->where('lecturer_id',session('lecturer_id'))->find($id)){
            return view('404');
        }
        else
        {
            $course= $courses->where('id', $id)->first();
            return view('lecturer.batch_insert',['course' => $course,'courses'=>$all_courses])->with('display',$id);;
        }

    }
    function addTestView($id){
        $courses= new Course();
        $all_courses= $courses->where('lecturer_id',session('lecturer_id'))->orderBy('created_at','DESC')->get();
        $totalQuestion= \App\Question::where(['course_id'=>$id])->count();
        if(!$courses->where('lecturer_id',session('lecturer_id'))->find($id)){
            return view('404');
        }
        else
        {
            $course= $courses->where('id', $id)->first();
            return view('lecturer.addTest',['course' => $course,'courses'=>$all_courses,'totalQuestion'=>$totalQuestion])->with('display',$id);
        }
    }
    function scheduledTestView($id){
        $courses= new Course();
        $all_courses= $courses->where('lecturer_id',session('lecturer_id'))->orderBy('created_at','DESC')->get();
        $test = new Test();
        $tests=$test->where('course_id',$id)->orderBy('created_at','DESC')->get();
        $totalQuestion= \App\Question::where(['course_id'=>$id])->count();
        if(!$courses->where('lecturer_id',session('lecturer_id'))->find($id)){
            return view('404');
        }
        else
        {
            $course= $courses->where('id', $id)->first();
            return view('lecturer.sheduledTest',['course' => $course,'test'=>$tests,'courses'=>$all_courses,'totalQuestion'=>$totalQuestion])->with('display',$id);
        }
    }
    function  student($id,$ids){
        $test= new Test();
        $student= new Student();
        $courses= new Course();
        $students= \App\Registration::join('student','registration.student_id','=','student.id')
            ->select('student.*')
            ->where('registration.test_id',$ids)
            ->getQuery()
            ->orderBy('created_at','DESC')
            ->get();
        $all_courses= $courses->where('lecturer_id',session('lecturer_id'))->orderBy('created_at','DESC')->get();
        $tests=$test->where('course_id',$id)->orderBy('created_at','DESC')->get();
        if(($courses->where('lecturer_id',session('lecturer_id'))->find($id) && $test->where('course_id',$id)->find($ids))===false){
            return view('404');
        }
        else{
            $course= $courses->where('id', $id)->first();
            $student->where('id',$ids)->get();
            return view('lecturer.student',['course' => $course,'test'=>$tests,'courses'=>$all_courses,'students'=>$students])->with('display',$id);
        }



    }
    // --------------------    end of view  ----------------------------------------------

    // ------------------------  Validation-------------------------------------------------
    function validLogin(Request $request){

        $username= $request->input('email');
        $password= sha1($request->input('password'));
        $user= \App\Lecturer::where(['email'=>$username,'password'=>$password])->get()->count();

        if($user==1){
            $id = \App\Lecturer::where('email',$username)->first()->id;
            $lecturer=\App\Lecturer::where(['email'=>$username,'password'=>$password])->select('first_name','last_name')->first();
            $request->session()->put(['lecturer_logged_in'=>'true','lecturer_id'=>$id,'lecturer'=>$lecturer->first_name.' '.$lecturer->last_name]);
            return redirect()->action('Lecturer@index');

        }
        else{
            return redirect()->back()->withErrors(['fail'=>'Email/Password incorrect'])->withInput(['email'=>$request->input('email')]);
        }
    }

    function addCourse(Request $request){
        $course= new Course();
        $course->course_code = $request->course_code;
        $course->course_title = $request->course_title;
        $course->lecturer_id = session('lecturer_id');
        $course->semester = $request->semester;;
        $this->validate($request,[
            'course_code'=>'required|unique:course|regex:/(^([a-zA-Z]{3})([0-9]{3})$)/',
            'course_title'=>'required',
            'semester'=>'required'
        ]);
        if ($course->save()){
            return back()->with("success","Added successfully");
        }
        else{
            return back()->with("fail","The was an error ,please try again ");
        }
    }

    function addQuestion(Request $request){
        $question= new Question();
        $this->validate($request,[
            'question'=>'required',
            'a'=>'required',
            'b'=>'required',
            'c'=>'required',
            'd'=>'required',
            'correct_option'=>'required|regex:/[abcd]/',
            'id'=>'required'
        ]);
        $question->question = $request->question;
        $question->a = $request->a;
        $question->b = $request->b;
        $question->c = $request->c;
        $question->d = $request->d;
        $question->correct_option = $request->correct_option;
        $question->course_id = $request->id;
        if ($question->save()){
            return back()->with("success","Added successfully");
        }
        else{
            return back()->with("fail","There was an error ,please try again ");
        }

    }
    function batchInsert( Request $request){
        $file = $request->file('upload');
        $course_id = $request->input('submit');
        $filename=$file->getClientOriginalName();
        $this->validate($request,[
                'upload'=>'required|mimes:csv,txt',
            ]
        );
        $destinationPath = 'uploads/'.session('lecturer_id');

        $file->move($destinationPath,$filename);
        if(($handle=fopen(public_path().'/'.$destinationPath.'/'.$filename,'r'))!==FALSE){
            while(($data= fgetcsv($handle,1000,','))!=FALSE){
               if(!isset($data[0],$data[1],$data[2],$data[3],$data[4],$data[5])){
                   return back()->with('error','Error: ensure that csv  format is consistence');
               }
                $question = new Question();
                $question->question = $data[0];
                $question->a = $data[1];
                $question->b = $data[2];
                $question->c = $data[3];
                $question->d = $data[4];
                $question->correct_option = $data[5];
                $question->course_id = $course_id;
                $question->save();
            }
            fclose($handle);
            return back()->with('message','Uploaded successfully');
        }

    }


    function deleteQuestion(Request $request){
        $question= new Question();
        $id = $request->input('id');
        if($question->destroy($id)){
            return "Deleted successfully";
        }
        else{
            return "There was an error, please try again";
        }
    }
    function trashQuestion(Request $request){
        $question= new Question();
        $course_id = $request->input('id');
        if($question->where('course_id',$course_id)->delete()){
            return "Trashed successfully";
        }
        else{
            return "There was an error, please try again";
        }
    }
    function groupDeleteQuestion(Request $request){
        $question= new Question();
        $id = $request->input('id');
        if($question->destroy($id)){
            return "Deleted successfully";
        }
        else{
            return "There was an error, pls ensure you check at least one delete checkbox ";
        }
    }
    function modifyQuestion(Request $request){
        $question= \App\Question::find($request->id);
        $question->question = $request->question;
        $question->a = $request->a;
        $question->b = $request->b;
        $question->c = $request->c;
        $question->d = $request->d;
        $question->correct_option = $request->correct_option;
        if ($question->save()){
            return "Updated successfully";
        }
        else{
            return "We encountered an error, please try again";
        }


    }


    function addTest(Request $request){
        $test= new Test();
        $this->validate($request,[
            'course_id'=>'required|numeric',
            'no_of_questions'=>'required|numeric',
            'exam_duration'=>'required|numeric',
            'start_date'=>'required',
            'session'=>'required||regex:/(^([0-9]{4})\/([0-9]{4})$)/',

        ]);


        $test->course_id = $request->course_id;
        $test->start_time = $request->start_date;
        $test->duration = $request->exam_duration;
        $test->no_of_question = $request->no_of_questions;
        $test->session = $request->input('session');
        $exists= $test->where(['session'=>$request->input('session'),'course_id'=>$request->course_id])->get()->count();
        if($exists!=0) {
            return  back()->with('exists',$request->input('session').' test has already been created for this course')->withInput();
        }
        else{
            if ($test->save()) {
                return back()->with("success", "Added successfully");
            } else {
                return back()->with("fail", "There was an error ,please try again ");
            }
        }

    }
    function deleteTest(Request $request){
        $test= new Test();
        $reg= new Registration();
        $id = $request->input('id');
        $reg_exist=$reg->where('test_id',$id)->get();
        $delete=count($reg_exist)!=0?($reg->where('test_id',$id)->delete() && $test->destroy($id)):$test->destroy($id);
        if($delete){
            return "Deleted successfully";
        }
        else{
            return "There was an error, please try again";
        }

    }
    function updateTest(Request $request){
        $totalQuestion= \App\Question::where(['course_id'=>$request->course_id])->count();
        if($request->no_of_question > $totalQuestion){
            return "You can only have maximum of ".$totalQuestion." questions; due available questions in the database for this course";
        }
        if(!preg_match(('/(^([0-9]{4})\/([0-9]{4})$)/'),$request->input('session'))){
            return "Please enter correct session format. e.g. 2013/2014";
        }
        $test= \App\Test::find($request->id);
        $test->start_time = $request->start_time;
        $test->duration = $request->duration;
        $test->no_of_question = $request->no_of_question;
        $test->session = $request->input('session');
        if ($test->save()){
            return "Updated successfully";
        }
        else{
            return "We encountered an error, please try again";
        }

    }
    function logout(Request $request){
        $request->session()->forget('lecturer_logged_in');
        return redirect()->action('Lecturer@login');

    }

    //---------------------------- Validation---------------------------------------------

}
