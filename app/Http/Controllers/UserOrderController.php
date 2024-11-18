<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function previousOrders()
    {
        // Fetch the currently authenticated user
        $user = Auth::user();

        // Fetch the user's orders
        $orders = $user->orders()->orderBy('created_at', 'desc')->get();

        // Pass the orders to the view
        return view('user-components.user-order', compact('orders'));
    }
}
