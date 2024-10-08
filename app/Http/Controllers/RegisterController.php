<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function create(){
        $data=DB::table('country')->get();
        return view('pages.register',['countries'=>$data]);
    }

    public function store(Request $request){
        $id=rand(1,2000)+1;
          $validataData=$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'confirm' => 'required|string|same:password',
          ]);


          $data = [
             'id'=>$id,
             'name'=>$validataData['name'],
             'email'=>$validataData['email'],
             'country'=>$validataData['country'],
             'password'=>bcrypt($validataData['password'])
          ];

          $user=User::create($data);
           Auth::login($user);
          session(['user_id'=>$user->id]);
          return redirect()->route('home');



    }
}
