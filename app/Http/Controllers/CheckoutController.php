<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('pages.checkout', compact('cartItems'));
    }
}
