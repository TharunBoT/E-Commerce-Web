@extends('layouts.base')

@section('content')
<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Checkout</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Cart Section Start -->
<section class="section-b-space">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <form class="needs-validation" method="POST" action="{{ route('place-order') }}">
                    @csrf
                
                    <div id="shippingAddress" class="row g-4 mt-5">
                        <h3 class="mb-3 theme-color">Shipping address</h3>
                        <div class="col-md-6">
                            <label for="s_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="s_name" name="s_name" placeholder="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="s_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="s_phone" name="s_phone" placeholder="Enter Phone Number" required>
                        </div>
                        <div class="col-md-6">
                            <label for="s_landmark" class="form-label">Landmark</label>
                            <input type="text" class="form-control" id="s_landmark" name="s_landmark" placeholder="Landmark" required>
                        </div>
                
                        <div class="col-md-12">
                            <label for="s_address" class="form-label">Address</label>
                            <textarea class="form-control" id="s_address" name="s_address" placeholder="Enter Address" required></textarea>
                        </div>
                
                        <div class="col-md-3">
                            <label for="s_city" class="form-label">City</label>
                            <input type="text" class="form-control" id="s_city" name="s_city" placeholder="City" required>
                        </div>
                
                        <div class="col-md-3">
                            <label for="s_country" class="form-label">Country</label>
                            <select class="form-select custome-form-select" id="s_country" name="s_country" required>
                                <option value="Sri-Lanka">Sri Lanka</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="s_state" class="form-label">District</label>
                            <select class="form-select custome-form-select" id="s_state" name="s_state" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Matara">Matara</option>
                                <option value="Galle">Galle</option>
                                <option value="Negombo">Negombo</option>
                                <!-- Add more states as needed -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="s_zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="s_zip" name="s_zip" placeholder="123456" required>
                        </div>
                    </div>
                
                    <div class="form-check ps-0 mt-3 custome-form-check">
                        <input class="checkbox_animated check-it" type="checkbox" name="saveAddress" id="saveAddress">
                        <label class="form-check-label checkout-label" for="saveAddress">Save this information for next time</label>
                    </div>
                
                    <hr class="my-lg-5 my-4">
                
                    <h3 class="mb-3">Payment</h3>
                
                    <div class="d-block my-3">
                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" name="payment_method" value="cod" checked id="cod" onclick="toggleCardForm()">
                            <label class="form-check-label" for="cod">Cash On Delivery</label>
                        </div>
                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" name="payment_method" value="debit" id="debit" onclick="toggleCardForm()">
                            <label class="form-check-label" for="debit">Debit card</label>
                        </div>
                    </div>
                
                    <!-- Card Information Form -->
                    <div class="row g-4" id="card-info" style="display: none;">
                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" name="cc_name">
                            <div class="form-text">Full name as displayed on card</div>
                        </div>
                        <div class="col-md-6">
                            <label for="cc-number" class="form-label">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" name="cc_number">
                            <div class="invalid-feedback">Credit card number is required</div>
                        </div>
                        <div class="col-md-3">
                            <label for="expiration" class="form-label">Expiration</label>
                            <input type="text" class="form-control" id="expiration" name="expiration">
                        </div>
                        <div class="col-md-3">
                            <label for="cc-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" name="cc_cvv">
                        </div>
                    </div>
                
                    @auth
                        <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                    @endauth
                
                    <button class="btn btn-solid-default mt-4" type="submit">Place Order</button>
                </form>
                
                <script>
                function toggleCardForm() {
                    var cardForm = document.getElementById('card-info');
                    var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
                    cardForm.style.display = (paymentMethod === 'debit') ? 'block' : 'none';
                }
                </script>
                
            </div>

            <div class="col-lg-4">
                <div class="your-cart-box">
                    <h3 class="mb-3 d-flex text-capitalize">
                        Your cart
                        <span class="badge bg-theme new-badge rounded-pill ms-auto bg-dark">
                            {{ Cart::instance('cart')->count() }}
                        </span>
                    </h3>

                    <ul class="list-group mb-3">
                        @foreach($cartItems as $item)
    <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div class="text-dark">
            <h6 class="my-0">{{ $item->name }}</h6>
            <small>Quantity: {{ $item->qty }}</small>
        </div>
        <span>${{ $item->price * $item->qty }}</span>
    </li>
@endforeach


                        <li class="list-group-item d-flex justify-content-between lh-condensed active">
                            <div class="text-dark">
                                <h6 class="my-0">Tax</h6>
                            </div>
                            <span>${{ Cart::instance('cart')->tax() }}</span>
                        </li>
                        <li class="list-group-item d-flex lh-condensed justify-content-between">
                            <span class="fw-bold">Total (USD)</span>
                            <strong>${{ Cart::instance('cart')->total() }}</strong>
                        </li>
                    </ul>

                    <form class="card border-0">
                        <div class="input-group custome-imput-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-solid-default rounded-0">Redeem</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript to toggle card information form -->
<script>
    function toggleCardForm() {
        var codOption = document.getElementById('cod');
        var cardInfo = document.getElementById('card-info');

        if (codOption.checked) {
            cardInfo.style.display = 'none';
        } else {
            cardInfo.style.display = 'block';
        }
    }
</script>

<!-- Cart Section End -->
@endsection





