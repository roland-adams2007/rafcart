<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function show(){
        $data=DB::table('carts')->where('user_id','=',Auth::user()->id)->get();
        return view('pages.cart',['carts'=>$data]);
    }

    public function addToCart(Request $request) {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        $product = DB::table('products')->where('id', $request->product_id)->first();
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
    
        $cartItem = Cart::where('user_id', Auth::user()->id)
                        ->where('product_id', $request->product_id)
                        ->first();
    
        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'quantity' => $request->quantity,
                'price' => $product->product_new_price,
                'image' => $product->product_img
            ]);
        }
    
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    

    public function showCheckout(){
        $data=DB::table('carts')->where('user_id','=',Auth::user()->id)->get();
        $countries=DB::table('country')->get();
        return view('pages.checkout',['carts'=>$data,'countries'=>$countries]);
    }
}                            
// INSERT INTO `product` (`id`, `product_name`, `product_img`, `sku`, `product_brand`, `product_category`, `product_quantity`, `product_old_price`, `product_new_price`, `date_added`, `created_at`, `updated_at`) VALUES ('345', 'Guyer Chair', 'assets/uploads/product/product1', 'B5FBKJB8GT', 'Apex', 'Sofa', '200', '400', '250', current_timestamp(), NULL, NULL);