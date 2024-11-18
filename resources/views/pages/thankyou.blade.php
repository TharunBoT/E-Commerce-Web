@extends('layouts.base')
@section('content')
<section class="pt-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="success-icon">
                    <div class="main-container">
                        <div class="check-container">
                            <div class="check-background">
                                <svg viewbox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div class="check-shadow"></div>
                        </div>
                    </div>

                    <div class="success-contain">
                        <h4>Order Success</h4>
                        <h5 class="font-light">Payment Is Successfully Processsed And Your Order Is On The Way</h5>
                        <h6 class="font-light">Transaction ID:267676GHERT105467</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order Success Section End -->

<!-- Order Details Section Start -->
<section class="section-b-space cart-section order-details-table">
    <div class="container">
        <div class="title title1 title-effect mb-1 title-left">
            <h2 class="mb-3">Order Details</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="col-sm-12 table-responsive">
                    <table class="table cart-table table-borderless">
                        <tbody>
                            @foreach(json_decode($order->products) as $item)
                            <tr class="table-order">
                                <td>
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('assets/images/fashion/product/front/' . $item->id . '.jpg') }}" class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </td>
                                <td>
                                    <p>Product Name</p>
                                    <h5>{{ $item->name }}</h5>
                                </td>
                                <td>
                                    <p>Quantity</p>
                                    <h5>{{ $item->qty }}</h5>
                                </td>
                                <td>
                                    <p>Price</p>
                                    <h5>${{ number_format($item->price, 2) }}</h5>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-order">
                                <td colspan="3">
                                    <h5 class="font-light">Subtotal :</h5>
                                </td>
                                <td>
                                    <h4>${{ number_format($order->total_amount - 12.00 - 10.00, 2) }}</h4>
                                </td>
                            </tr>

                            <tr class="table-order">
                                <td colspan="3">
                                    <h5 class="font-light">Shipping :</h5>
                                </td>
                                <td>
                                    <h4>$12.00</h4>
                                </td>
                            </tr>

                            <tr class="table-order">
                                <td colspan="3">
                                    <h5 class="font-light">Tax(GST) :</h5>
                                </td>
                                <td>
                                    <h4>$10.00</h4>
                                </td>
                            </tr>

                            <tr class="table-order">
                                <td colspan="3">
                                    <h4 class="theme-color fw-bold">Total Price :</h4>
                                </td>
                                <td>
                                    <h4 class="theme-color fw-bold">${{ number_format($order->total_amount, 2) }}</h4>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="order-success">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <h4>Summary</h4>
                            <ul class="order-details">
                                <li>Order ID: {{ $order->id }}</li>
                                <li>Order Date: {{ $order->created_at->format('F j, Y') }}</li>
                                <li>Order Total: ${{ number_format($order->total_amount, 2) }}</li>
                            </ul>
                        </div>

                        <div class="col-sm-6">
                            <h4>Shipping Address</h4>
                            <ul class="order-details">
                                <li>{{ $order->s_name }}</li>
                                <li>{{ $order->s_address }}</li>
                                <li>{{ $order->s_city }}, {{ $order->s_state }} {{ $order->s_zip }}</li>
                                <li>Contact No: {{ $order->s_phone }}</li>
                            </ul>
                        </div>

                        <div class="col-12">
                            <div class="payment-mode">
                                <h4>Payment Method</h4>
                                <p>{{ $order->payment_status == 'Pending' ? 'Pay on Delivery (Cash/Card). Cash on delivery (COD) available. Card/Net banking acceptance subject to device availability.' : 'Paid' }}</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="delivery-sec">
                                <h3>Expected Date of Delivery: <span>{{ $order->created_at->addDays(7)->format('F j, Y') }}</span></h3>
                                <a href="#">Track Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order Details Section End -->

@endsection