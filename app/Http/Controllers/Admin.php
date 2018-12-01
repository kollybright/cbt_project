<?php

namespace App\Http\Controllers;

use App\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use PhpParser\Node\Scalar\String_;
use Psy\Util\Str;

class Admin extends Controller
{
    function __construct(){


    }

   //------------View--------------------
    function index(Request $request){

        $lectuer = new Lecturer();
        $data =$lectuer->orderBy('created_at','DESC')->get();

        return view('admin.dashboard',['data'=>$data]);
        }

    function login(Request $request){
        if($request->session()->has('admin_logged_in')){
            return redirect()->action('Admin@index');
        }
        else {
            return view('admin.login');
        }
    }
    //--------------end of view--------------

    // -------------------Validation-------------------

    function validLogin(Request $request){

        $username= $request->input('username');
        $password= sha1($request->input('password'));
        $user= \App\Admin::where(['username'=>$username,'password'=>$password])->get()->count();

        if($user==1){

            $request->session()->put(['admin_logged_in'=>'true']);
            return redirect()->action('Admin@index');

        }
        else{
            return redirect()->back()->withErrors(['fail'=>'Username/Password incorrect'])->withInput(['username'=>$request->input('username')]);
        }
    }
    function logout(Request $request){
        $request->session()->forget('admin_logged_in');
        return redirect('/admin/login');

    }
     function  addLecturer(Request $request)
     {
         $lecturer = new Lecturer();
         $lecturer->email = $request->email;
         $lecturer->password = sha1($request->password);
         $lecturer->first_name = $request->first_name;
         $lecturer->last_name = $request->last_name;
         $lecturer->remember_token= str_random(60);

         $this->validate($request, [
             'email' => 'required|email|unique:lecturer',
             'password' => 'required',
             'confirm_password'=>'required|same:password',
             'first_name' => 'required',
             'last_name' => 'required',
         ]);
         if ($lecturer->save()){
             return back()->with("success","Added successfully");
         }
         else{
             return back()->with("fail","The was an error ,please try again ");
         }
     }


}
