<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('order_refno');
            $table->unsignedBigInteger('user_id');
            $table->string('shipping_name');
            $table->integer('shipping_country');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_phone');
            $table->string('shipping_email');
            $table->double('total_amt')->nullable();
            $table->string('payment_status')->default('Pending');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order__id');
            $table->unsignedBigInteger('product_id');
            $table->double('product_amount');
            $table->string('quantity');
            $table->timestamps();

            // $table->foreign('order__id')->references('order_id')->on('orders')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });


        //  $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
