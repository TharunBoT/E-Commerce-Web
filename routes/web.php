<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserOrderController;


//main route
Route::get('/', [AppController::class, 'index'])->name('app.index');

//contact us page navigation
Route::get('/contact', [AppController::class, 'contact_us'])->name('contact.index');

//shop routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class, 'productDetails'])->name('shop.product.details');

//cart routes
Route::get('/cart',[CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store',[CartController::class, 'addToCart'])->name('cart.store');
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class,'removeItem'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class,'clearCart'])->name('cart.clear');

//checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::middleware(['web'])->group(function () {
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place-order');
    Route::get('/order/confirmation/{id}', function ($id) {
        $order = \App\Models\Order::find($id);
        return view('pages.thankyou', compact('order'));
    })->name('order.confirmation');
});

//user dashboard routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // Check if the user is an admin
        if (auth()->user()->usertype === 'admin') {
            return redirect('/admin'); //admin panel (Filament)
        }
        return view('user-components.user-account'); //user dashboard
    })->name('dashboard');
    
});
Route::get('/dashboard/reset-pw', [AppController::class, 'pw_change'])->name('dashboard.reset-pw');
Route::get('/profile/orders', [UserOrderController::class, 'previousOrders'])->name('profile.orders');
