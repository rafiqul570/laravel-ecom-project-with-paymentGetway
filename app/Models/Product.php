<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_price',
        'product_quantity',
        'category_id',
        'category_name',
        'color_id',
        'color_name',
        'short_description',
        'long_description',
        'shippingCost',
        'product_img',
        'slug',

    ];


}
