<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index(){
       if(Auth::check()){
        $data=DB::table('carts')->where('user_id','=',Auth::user()->id)->get();
        return view('index',['carts'=>$data]);
       }else{
        return view('index');
       }
    
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
