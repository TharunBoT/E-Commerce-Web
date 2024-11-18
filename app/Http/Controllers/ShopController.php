<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //shop page
    public function index(){
        $products = Product::orderBy('created_at', 'DESC')->paginate(24);
        return view('pages.shop', ['products' => $products]);
    }

    //product details page
    public function productDetails($slug){
        $product = Product::where('slug', $slug)->first();
        return view('pages.detail', ['product' => $product]);
    }
}