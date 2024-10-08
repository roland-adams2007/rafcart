<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIfUserIsLoggedIn;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;



Route::middleware([CheckIfUserIsLoggedIn::class])->group(function () {
    Route::get('/login',[LoginController::class,'create'])->name('login');
    Route::get('/register',[RegisterController::class,'create'])->name('register');
});


Route::get('/',[UserController::class,'index'])->name('home');
Route::post('/login',[LoginController::class,'store'])->name('login.store');
Route::post('/register',[RegisterController::class,'store'])->name('register.store');
Route::get('/account',function(){
    return view('pages.account');
})->middleware('auth')->name('account.show');
Route::get('/shop',[ProductController::class,'show'])->name('shop.show');
Route::get('/product/{id}',[ProductController::class,'showProductDesc'])->name('product.show');
Route::get('/wishlist',function(){
    return view('pages.wishlist');
})->middleware('auth')->name('wishlist.show'); 
Route::post('/logout',[UserController::class,'logout'])->name('logout');
Route::get('/cart',[CartController::class,'show'])->middleware('auth')->name('cart.show');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('cart.add');
Route::get('/checkout',[CartController::class,'showCheckout'])->middleware('auth')->name('checkout.show');
Route::post('/pay', [PaymentController::class, 'paystack'])->name('pay');
Route::post('/order',[OrderController::class,'store'])->name('order');
Route::get('/payment_verify',[PaymentController::class,'verify'])->middleware('auth')->name('pay.verify');
Route::get('/order_successfull',[OrderController::class,'success'])->middleware('auth')->name('order.success');      
