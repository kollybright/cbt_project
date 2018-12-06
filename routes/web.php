<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//------------------      Admin -------------------------
Route::get('admin/login','Admin@login');


Route::middleware(['admin'])->group(function() {
    Route::get('admin', 'Admin@index');
    Route::View('admin/add_lecturer','admin.add_lecturer');
});
//validation-------------------
Route::post('admin/valid_login', 'Admin@validLogin');
Route::get('admin/logout', 'Admin@logout');
Route::post('admin/lecturer_add','Admin@addLecturer');
//
//  ---------------   Lecturer  ---------------------------------------------------------------------------------------------
Route::view('lecturer/denied_access','lecturer.denied');
Route::get('lecturer/login','Lecturer@login');
Route::middleware(['lecturer'])->group(function(){
// ------------view-------------------
    Route::get('lecturer', 'Lecturer@index');
    Route::get('lecturer/add_new_course',function(){
        $course= new \App\Course();
        $courses= $course->where('lecturer_id',session('lecturer_id'))->get();
        return view('lecturer.addNewCourse',['courses'=>$courses]);
    });
    Route::get('lecturer/{id}/scheduled_test/{ids}','Lecturer@student')->where(['id'=>'[0-9]+','ids'=>'[0-9]+']);
    Route::get('lecturer/{id}','Lecturer@course')->where('id','[0-9]+');
    Route::get('lecturer/{id}/add_question','Lecturer@addQuestionView')->where('id','[0-9]+');
    Route::get('lecturer/{id}/add_test','Lecturer@addTestView')->where('id','[0-9]+');
    Route::get('lecturer/{id}/scheduled_test','Lecturer@ScheduledTestView')->where('id','[0-9]+');
    Route::get('lecturer/{id}/question_upload','Lecturer@batchInsertView')->where('id','[0-9]+');


});
//validation-----------------------------
Route::get('lecturer/logout', 'Lecturer@logout');
Route::post('lecturer/valid_login', 'Lecturer@validLogin');
Route::post('lecturer/add_course','Lecturer@addCourse');
Route::post('lecturer/test_add','Lecturer@addTest');
Route::post('lecturer/question_add','Lecturer@addQuestion');
Route::post('lecturer/batch_insert','Lecturer@batchInsert');
Route::post('lecturer/delete_question','Lecturer@deleteQuestion');
Route::post('lecturer/trash_question','Lecturer@trashQuestion');
Route::post('lecturer/group_delete_question','Lecturer@groupDeleteQuestion');
Route::post('lecturer/modify_question','Lecturer@modifyQuestion');
Route::post('lecturer/test_delete','Lecturer@deleteTest');
Route::post('lecturer/update_test','Lecturer@updateTest');


//----------------------------------- Student---------------------------------------------------------------------------
//                    ---view----
Route::view('student/register','student.signup');
Route::view('student/login','student.login');
Route::middleware(['student'])->group(function() {
    Route::get('student', 'StudentController@index');
    Route::get('student/course_reg', 'StudentController@CourseReg');

});
//---------------validation---------------
Route::post('student/valid_register', 'StudentController@register');
Route::post('student/valid_login', 'StudentController@validLogin');
Route::get('student/logout', 'StudentController@logout');
Route::post('student/valid_reg', 'StudentController@validReg');
Route::post('student/drop_course', 'StudentController@dropCourse');


//-----------------------------Exam-----------------------------------------
//Route::view('exam','exam.exam');
Route::get('test','Exam@index');
Route::get('test/select','Exam@selectTest');
Route::post('test/submit','Exam@submit');









//
