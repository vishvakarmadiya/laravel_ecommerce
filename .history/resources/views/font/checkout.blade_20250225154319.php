<!DOCTYPE html>
<html lang="en">

<head>
    @include ('font.hedderlink')
</head>

<body>
    <!-- Top Header Start -->
    @include ('font.tophedder')
    <!-- Top Header End -->


    <!-- Header Start -->
    @include ('font.navbar')
    <!-- Header End -->


    <!-- main containt Start  -->

    <!-- Breadcrumb Start -->
    @include ('font.product_diatail_nav')
    <!-- Breadcrumb End -->

  <!-- Checkout Start -->
@if(getCart()->isNotEmpty())
<div class="checkout">
    <div class="container">
        <div class="row">
            <!-- Billing & Shipping Details -->
            <div class="col-md-7">
                <div class="billing-address">
                    <h2>Billing Address</h2>
                    <form action="{{ route('order_store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input class="form-control @error('billing_first_name') is-invalid @enderror" type="text" name="billing_first_name" value="{{ old('billing_first_name', Auth::user()->name) }}" placeholder="First Name">
                                @error('billing_first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input class="form-control @error('billing_last_name') is-invalid @enderror" type="text" name="billing_last_name" value="{{ old('billing_last_name') }}" placeholder="Last Name">
                                @error('billing_last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input class="form-control @error('billing_email') is-invalid @enderror" type="email" name="billing_email" value="{{ old('billing_email', Auth::user()->email) }}" placeholder="E-mail">
                                @error('billing_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Mobile No</label>
                                <input class="form-control @error('billing_mobile') is-invalid @enderror" type="text" name="billing_mobile" value="{{ old('billing_mobile') }}" placeholder="Mobile No">
                                @error('billing_mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label>Address</label>
                                <input class="form-control @error('billing_address') is-invalid @enderror" type="text" name="billing_address" value="{{ old('billing_address') }}" placeholder="Address">
                                @error('billing_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>

                <div class="shipping-address">
                    <h2>Shipping Address</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input class="form-control @error('shipping_first_name') is-invalid @enderror" type="text" name="shipping_first_name" value="{{ old('shipping_first_name') }}" placeholder="First Name">
                            @error('shipping_first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input class="form-control @error('shipping_last_name') is-invalid @enderror" type="text" name="shipping_last_name" value="{{ old('shipping_last_name') }}" placeholder="Last Name">
                            @error('shipping_last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>E-mail</label>
                            <input class="form-control @error('shipping_email') is-invalid @enderror" type="email" name="shipping_email" value="{{ old('shipping_email') }}" placeholder="E-mail">
                            @error('shipping_email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Mobile No</label>
                            <input class="form-control @error('shipping_mobile') is-invalid @enderror" type="text" name="shipping_mobile" value="{{ old('shipping_mobile') }}" placeholder="Mobile No">
                            @error('shipping_mobile')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-md-5">
                <div class="checkout-summary">
                    <h2>Cart Total</h2>
                    <div class="checkout-content">
                        <h3>Products</h3>
                        @php
                            $price = 0;
                            $shipping = 50; // Fixed shipping cost
                        @endphp
                        @foreach (getCart() as $cartItem)
                            @php $itemTotal = $cartItem->price * $cartItem->quantity; @endphp
                            <p>{{ $cartItem->name }} (x{{ $cartItem->quantity }}) <span>${{ $itemTotal }}</span></p>
                            @php $price += $itemTotal; @endphp
                        @endforeach
                        <p class="sub-total">Sub Total <span>${{ $price }}</span></p>
                        <p class="ship-cost">Shipping Cost <span>${{ $shipping }}</span></p>
                        <h4>Grand Total <span>${{ $price + $shipping }}</span></h4>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="checkout-payment">
                    <h2>Payment Methods</h2>
                    <div class="payment-methods">
                        @foreach(['Direct Bank Transfer', 'Cash on Delivery'] as $key => $payment)
                            <div class="payment-method">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input @error('payment_method') is-invalid @enderror" id="payment-{{ $key }}" name="payment_method" value="{{ $payment }}" {{ old('payment_method') == $payment ? 'checked' : ($key == 0 ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="payment-{{ $key }}">{{ $payment }}</label>
                                </div>
                            </div>
                        @endforeach
                        @error('payment_method')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="checkout-btn">
                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endif
<!-- Checkout End -->



    <!-- main containt end -->

    @include ('font.footer')


    <!-- Back to Top -->
    @include ('font.footerlink')
</body>

</html>