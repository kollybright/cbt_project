<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Student;
use App\Test;
use Faker\Provider\zh_CN\DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\App;

class StudentController extends Controller
{
    function __construct(){

    }
//--------------------------------view-------------------------------
    function index(){
        $id= session('student_id');
        $test= \App\Registration::join('test','registration.test_id','=','test.id')
            ->join('course','test.course_id','=','course.id')
            ->join('lecturer','course.lecturer_id','=','lecturer.id')
            ->select('registration.*','test.session','test.start_time','course.course_code','course.course_title','course.semester','lecturer.first_name','lecturer.last_name')
            ->where('registration.student_id',$id)
            ->orderBy('test.created_at','DESC')
            ->getQuery()
            ->get();

        return view('student.home',['test'=>$test]);
    }
    function  login(){
        if(session()->has('student_logged_in')){
            return redirect()->action('StudentController@index');
        }
        else{
            return view('student.login');
        }
    }

    function courseReg(){
        $registered_course=[];
        $id= session('student_id');
        $registered=\App\Registration::where('student_id',$id)
            ->select('test_id')
            ->orderBy('created_at','DESC')
            ->get();
        foreach($registered as $key=>$value){
            array_push($registered_course,$value->test_id);
        }

        $test= \App\Test::join('course','test.course_id','=','course.id')
            ->join('lecturer','course.lecturer_id','=','lecturer.id')
            ->select('test.*','course.course_code','course.course_title','course.semester','lecturer.first_name','lecturer.last_name')
            ->whereNotIn('test.id',$registered_course)
            ->orderBy('test.created_at','DESC')
            ->getQuery()
            ->get();
        return view('student.course',['test'=>$test]);
    }
    function testIds(){
        $id= session()->get('student_id');
        $test_ids=[];
        $test= new Registration();
        $data= $test->where(['student_id'=>$id])->select('test_id')->get();
        foreach ($data as $val){
            array_push($test_ids,$val->test_id);
        }
        return $test_ids;
    }
    function  selectTest(){

        $tests= \App\Test::join('course','test.course_id','=','course.id')
            ->select('test.*','course.course_code','course.course_title')
            ->whereIn('test.id',$this->testIds())
            ->orderBy('test.created_at','DESC')
            ->getQuery()
            ->get();
        return view('exam.selectTest',['test'=>$tests]);

    }


    ///-----------------------validation-----------------------------
    function register(Request $request){
        $student= new Student();
        $this->validate($request,[
            'email'=>'required|email|unique:student',
            'firstname'=>'required',
            'lastname'=>'required',
            'password'=>'required',
            'confirm_password'=>'required|same:password',
            'matric_no'=>'required|unique:student|regex:/(^([a-zA-Z]{3})\/([0-9]{4})\/([0-9]{3})$)/',
            'option'=>'required',

        ]);
        $student->email = $request->input('email');
        $student->firstname = $request->input('firstname');
        $student->lastname = $request->input('lastname');
        $student->password = sha1($request->input('password'));
        $student->matric_no =  $request->input('matric_no');
        $student->option = $request->input('option');

        if ($student->save()){
//            $id = \App\Student::where('matric_no',$request->input('matric_no'))->first()->id;
//            $request->session()->put(['student_logged_in'=>'true','student_id'=>$id]);
//            return redirect()->action('StudentController@index');
            return back()->with('success', 'Successfully registered as a student');

        }
        else{
            return back()->with("fail","There was an error ,please try again ");
        }


    }

    function validLogin(Request $request){

        $username= $request->input('matric_no');
        $password= sha1($request->input('password'));
        $user= \App\Student::where(['matric_no'=>$username,'password'=>$password])->get()->count();

        if($user==1){
            $id = \App\Student::where('matric_no',$username)->first()->id;
            $student = \App\Student::where('matric_no',$username)->select('firstname','lastname')->first();
            $request->session()->put(['student_logged_in'=>'true','student_id'=>$id,'student'=>$student->firstname.' '.$student->lastname]);
            return redirect()->action('StudentController@index');

        }
        else{
            return redirect()->back()->withErrors(['fail'=>'Matric no/Password incorrect'])->withInput(['matric_no'=>$request->input('matric_no')]);
        }
    }


    function validReg(Request $request){
        $id=session('student_id');
        $courses=$request->courses;
        $this->validate($request,[
            'courses'=>'required'
        ]);

        if (StudentController::saveReg($id,$courses)){
            return back()->with("success","You have successfully registered");
        }
        else{
            return back()->with("fail","The was an error ,please try again ");
        }


    }
    function saveReg($id,$courses){
        $query='';
        foreach($courses as $course) {
            $query= DB::table('registration')->insert([
                'student_id'=>$id,
                'test_id'=>$course,
                'created_at'=> new \DateTime(),
                'updated_at'=> new \DateTime()
            ]);
        }
        if($query==true){
            return true;
        }
        else{
            return false;
        }
    }
    function dropCourse(Request $request){
        $reg= new Registration();
        $courses=$request->courses;
        $this->validate($request,[
            'courses'=>'required'
        ]);
        if ($reg->destroy($courses)){
            return back()->with("success","Successfully dropped");
        }
        else{
            return back()->with("fail","The was an error ,please try again ");
        }

    }
    function take_test(Request $request){
        $this->validate($request,[
            'test_id'=>'required'
        ]);
        if ($request->input('test_id')=="null"){

            return back()->with("fail","Please select a valid test.");
        }
        else{
            session()->put('take_exam',true);
            return redirect("test/".$request->input('test_id'));
        }
    }

    function logout(Request $request){
        $request->session()->forget(['student_logged_in','take_exam']);
        return redirect('student/login');

    }





}
