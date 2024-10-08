<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function show(){
        $data=DB::table('products')->get();
        $data2=DB::table('carts')->where('user_id','=',Auth::user()->id)->get();
        return view('pages.shop',['products'=>$data,'carts'=>$data2]);
    }

    public function showProductDesc($id){
        $data=DB::table('products')->where('id','=',$id)->first();
        return view('pages.product',['product'=>$data]);
    }
}
