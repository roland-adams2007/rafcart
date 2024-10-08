<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(){
        return view('pages.login');
    }

    public function store(Request $request){
        $validatedData=$request->validate([
           'email'=>"required|string|email|max:255",
           'password'=>"required|string",
        ]);
         $data=[
            'email'=>$validatedData['email'],
            'password'=>$validatedData['password']
         ];

         if(Auth::attempt($data)){
            $user=Auth::user();
            session(['user_id'=>$user->id]);
            return redirect()->route('home');
         }else{
            return back()->withErrors([
                'error'=>'Invaild Credentials'
            ]); 
         }

    }
}
