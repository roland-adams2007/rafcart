<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Paystack;
use App\Services\CurrencyConverter;

class PaymentController extends Controller
{

  protected $currencyConverter;

  public function __construct(CurrencyConverter $currencyConverter)
  {
      $this->currencyConverter = $currencyConverter;
  }
    public function paystack(){
        $email=Auth::user()->email;
        $ref=session('ref_no');
        $data=DB::table('orders')->where('order_refno','=',$ref)->first();
        $amt=$data->total_amt;
        $amtInUSD = $this->currencyConverter->convertToNGN($amt, 'USD');
        $postRequest = [
            "email"=> $email,
            "amount"=> $amtInUSD * 100,
            "reference"=> $ref,
            "callback_url"=>route('pay.verify'),
        ];
        $headers = ['Content-Type: application/json', 'Authorization: Bearer sk_test_55ea63fa0f071099b7db6e20a105ca1cf6d2165e'];
        $url ='https://api.paystack.co/transaction/initialize';
        ////Step 1, initialize curl
        $cURLConnection = curl_init($url);
        ////step 2, Set the curl options using the functions curl_setopt()
        curl_setopt($cURLConnection, CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, json_encode($postRequest));
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false);
        ////step 3, execute the curl session using curl_exec()
        $apiResponse = curl_exec($cURLConnection);
        if($apiResponse){
            curl_close($cURLConnection);
            $response = json_decode($apiResponse);
            if($response->status == true){
              $url=$response->data->authorization_url;
              return redirect($url);
            }else{
              return redirect(route('checkout.show'));
            }
        }else{
            $r = curl_error($cURLConnection);
          session()->flash('message','Poor Connection Status');
          return redirect()->route('checkout.show');
        }
    }

    public function verify(){
        $ref=session('ref_no');
        $headers = ['Content-Type: application/json', 'Authorization: Bearer sk_test_55ea63fa0f071099b7db6e20a105ca1cf6d2165e'];
        $url ="https://api.paystack.co/transaction/verify/$ref";
        ////Step 1, initialize curl
        $cURLConnection = curl_init($url);
        ////step 2, Set the curl options using the functions curl_setopt()
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false);
        $apiResponse = curl_exec($cURLConnection);
        $order=Order::where('order_refno','=',$ref)->first();
        if($apiResponse){
            curl_close($cURLConnection);
            $response = json_decode($apiResponse);
            if($response->status == true){
               $order->payment_status="Paid";
               $order->save();
               Cart::where('user_id',Auth::user()->id)->delete();
               return redirect()->route('order.success');
              }else{
                $order->payment_status="Failed";
                $order->save();
                return redirect()->route('cart.show');
              }
        }else{
            $r = curl_error($cURLConnection);
            session()->flash('message','Payment Failed');
            $order->payment_status="Failed";
            $order->save();
            return redirect()->route('cart.show');
        }

    }
}