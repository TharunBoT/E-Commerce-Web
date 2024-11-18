<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'regular_price',
        'sale_price',
        'SKU',
        'stock_status',
        'quantity',
        'featured',
        'image',
        'category_id',
        'brand_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    
    use HasFactory;
}

//mongodb connection

// class Product extends Eloquent
// {
//     protected $connection = 'mongodb';  
//     protected $fillable = [
//         'name',
//         'slug',
//         'short_description',
//         'description',
//         'regular_price',
//         'sale_price',
//         'SKU',
//         'stock_status',
//         'quantity',
//         'featured',
//         'image',
//         'category_id',
//         'brand_id',
//     ];
//     public function category()
//     {
//         return $this->belongsTo(Category::class, 'category_id');
//     }
//     public function brand()
//     {
//         return $this->belongsTo(Brand::class, 'brand_id');
//     }
//     use HasFactory;
// }