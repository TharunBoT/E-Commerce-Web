<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Category extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }
    
    use HasFactory;
}

//mongodb connection

// class Category extends Eloquent
// {
//     protected $connection = 'mongodb';
//     protected $fillable = [
//         'name',
//         'slug',
//         'image',
//     ];
//     public function products()
//     {
//         return $this->hasMany(Product::class, 'category_id');
//     }
//     use \Illuminate\Database\Eloquent\Factories\HasFactory;
// }