<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Brand extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'image',
    ];
    
    public function products(){
        return $this->hasMany(Product::class, 'brand_id');
    }

    use HasFactory;
}

//mongodb connection

// class Brand extends Eloquent
// {
//     protected $connection = 'mongodb';
//     protected $fillable = [
//         'name',
//         'slug',
//         'image',
//     ];
//     public function products()
//     {
//         return $this->hasMany(Product::class, 'brand_id');
//     }
//     use \Illuminate\Database\Eloquent\Factories\HasFactory;
// }