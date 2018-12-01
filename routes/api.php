<?php
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
Route::get('question',function(){
    $question = \App\Question::select('id','question','a','b','c','d')->where(['course_id'=>2])->get();
    return  ($question);
});

Route::middleware('Exam')->get('fetch_exam', function(Request $request){
});





