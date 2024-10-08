<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request){
        $ref_no=rand(1,20000);
        $validatedData=$request->validate([
         'first-name'=>"required|string",
         'last-name'=>"required|string",
         'region'=>"required",
         'address'=>"required|string",
          'city'=>"required|string",
          'phone'=>"required|string",
          'email'=>"required|string|email",
        ]);
        $data=[
             'order_refno'=>$ref_no,
             'user_id'=>Auth::user()->id,
             'shipping_name'=>$validatedData['first-name']." ".$validatedData['last-name'],
             'shipping_country'=>$validatedData['region'],
             'shipping_address'=>$validatedData['address'],
             'shipping_city'=>$validatedData['city'],
             'shipping_phone'=>$validatedData['phone'],
             'shipping_email'=>$validatedData['email'],
             'total_amt'=>'0'
        ];
       $order = Order::create($data);
  $order_id=$order->order_id;
  
        if($order){
          session(['ref_no'=>$ref_no]);  
          $data=DB::table('carts')->where('user_id','=',Auth::user()->id)->get();
          $total_amt=0;
         foreach($data as $details){
             $total_amt= $total_amt + $details->price * $details->quantity;
            $data2=[
                'order__id'=>$order_id,
                'product_id'=>$details->product_id,
                'product_amount'=>$details->price,
                'quantity'=>$details->quantity
              ];
            
              OrderItems::create($data2);
         }
         $order2 = Order::find($order_id,'order_id');
         $order2->total_amt = $total_amt;
         $order2->save();
         return view('pages.redirecttopay');
        }else{
          return redirect()->route('cart.show');
        }
    }

    public function success(){
        return view('pages.success');
    }
}
