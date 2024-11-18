<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Order extends Model
{
    protected $fillable = [
        'user_id', 's_name', 's_phone', 's_address', 's_landmark', 's_city', 
        's_country', 's_state', 's_zip', 'products', 'total_amount', 'payment_status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

//mongodb connection

// class Order extends Eloquent
// {
//     protected $connection = 'mongodb';
//     protected $fillable = [
//         'user_id', 
//         's_name', 
//         's_phone', 
//         's_address', 
//         's_landmark', 
//         's_city', 
//         's_country', 
//         's_state', 
//         's_zip', 
//         'products', 
//         'total_amount', 
//         'payment_status'
//     ];
//     public function user() {
//         return $this->belongsTo(User::class);
//     }
//     use \Illuminate\Database\Eloquent\Factories\HasFactory;
// }
