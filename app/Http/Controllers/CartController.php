<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;

class CartController extends Controller
{
    //display cart items
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('pages.cart', compact('cartItems'));
    }

    //add products to the cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        //check if product exists in the database and is active
        $product = Product::find($request->id);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $price = $product->sale_price ? $product->sale_price : $product->regular_price;

        Cart::instance('cart')->add($product->id, $product->name, $request->quantity, $price)
            ->associate('App\Models\Product');

        return redirect()->back()->with('message', 'Success! Item has been added successfully!');
    }

    public function updateCart(Request $request)
    {
    Cart::instance('cart')->update($request->rowId,$request->quantity);
    return redirect()->route('cart.index');
    }

    public function removeItem(Request $request){
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }

    public function clearCart(){
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }
}
