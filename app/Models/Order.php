<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use  Notifiable;

     protected $fillable = [
        'user_id',
       
        'city',
        'postcode',
        'email',
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
