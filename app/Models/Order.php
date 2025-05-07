<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
       
        'city',
        'postcode',
        'phone',

        'product_id',
        'product_name',
        'product_color',
        'product_size',
        'product_img',
        'product_price',
        'product_quantity',
        'shippingCost',
        'total_price',
           
       
     ];
}
