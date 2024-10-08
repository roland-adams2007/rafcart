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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('product_name');
            $table->string('product_img');
            $table->string('sku');
            $table->string('product_brand');
            $table->string('product_category');
            $table->string('product_quantity');
            $table->float('product_old_price')->nullable();
            $table->float('product_new_price');
            $table->timestamp('date_added');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
