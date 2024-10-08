<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
     protected $primaryKey='order_id';
    protected $fillable = [
        'order_refno',
        'user_id',
        'shipping_name',
        'shipping_country',
        'shipping_address',
        'shipping_city',
        'shipping_phone',
        'shipping_email',
        'total_amt',
        'payment_status'
    ];

}
