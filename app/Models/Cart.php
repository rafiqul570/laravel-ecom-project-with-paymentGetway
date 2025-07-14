<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'product_color',
        'product_size',
        'product_img',
        'discount_price',
        'product_price',
        'product_quantity',
        'shippingCost',
        'total_price',
           
       
     ];
 

 public function product()
    {
        return $this->belongsTo(Product::class);
    }


}