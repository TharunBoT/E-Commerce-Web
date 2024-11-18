@extends('layouts.base')

@section('content')
        <h1 style="margin-left: 50px;">Your Previous Orders</h1>

    <div style="border: solid 3px #8b0000; width:800px; margin-left:60px; border-radius:50px; margin-top:40px;">
    @if($orders->isEmpty())
        <img src="assets/images/svg/box1.png" class="img-fluid blur-up lazyload" alt="" style="width: 100px; margin-right: 20px;">
        <p style="margin-left: 50px;">You have no previous orders.</p>
    @else
        @foreach($orders as $order)
        <div class="order-box-contain" style="display: flex; align-items: center; border: 1px solid #ddd; padding: 15px; margin-bottom: 20px;">
            <img src="assets/images/svg/box1.png" class="img-fluid blur-up lazyload" alt="" style="width: 100px; margin-right: 20px;">
            <div class="order-details" style="flex-grow: 1;">
                <h5 style="margin-bottom: 10px;">Order ID: {{ $order->id }}</h5>
                <p style="margin: 5px 0;"><strong>Shipping Address:</strong> {{ $order->s_address }}, {{ $order->s_city }}, {{ $order->s_state }}, {{ $order->s_zip }}</p>
                <p style="margin: 5px 0;"><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
                <p style="margin: 5px 0;"><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                <p style="margin: 5px 0;"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
            </div>
        </div>        
        @endforeach
    @endif
    </div>
@endsection
