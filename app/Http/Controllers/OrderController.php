<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Cart;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
{
    $user = Auth::user();

    //validate request data
    $validatedData = $request->validate([
        's_name' => 'required|string',
        's_phone' => 'required|string',
        's_address' => 'required|string',
        's_city' => 'required|string',
        's_state' => 'required|string',
        's_zip' => 'required|string',
    ]);

    //Get cart items
    $cartItems = Cart::instance('cart')->content();
    $totalAmount = Cart::instance('cart')->total();

    // Create the order
    $order = Order::create([
        'user_id' => $user->id,
        's_name' => $request->s_name,
        's_phone' => $request->s_phone,
        's_address' => $request->s_address,
        's_landmark' => $request->s_landmark,
        's_city' => $request->s_city,
        's_country' => $request->s_country,
        's_state' => $request->s_state,
        's_zip' => $request->s_zip,
        'products' => json_encode($cartItems),  
        'total_amount' => $totalAmount,
        'payment_status' => 'Pending', 
    ]);

    //Clear the cart after order
    Cart::instance('cart')->destroy();

    return redirect()->route('order.confirmation', $order->id)
        ->with('success', 'Order placed successfully!');
}

}
