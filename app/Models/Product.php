<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_price',
        'product_quantity',
        'category_id',
        'category_name',
        'sub_category_id',
        'subCategory_name',
        'brand_id',
        'brand_name',
        'color_id',
        'color_name',
        'size_id',
        'size_name',
        'short_description',
        'long_description',
        'shippingCost',
        'product_img',
        'slug',

    ];


    public function subCategory() {
    return $this->belongsTo(SubCategory::class);
}



}
