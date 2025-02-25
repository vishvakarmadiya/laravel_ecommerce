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
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" value="{{ Auth::user()->name }}" placeholder="First Name">
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name"</label>
                                    <input class="form-control" type="text" placeholder="Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" value="{{ Auth::user()->email }}" placeholder="E-mail">
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" placeholder="Mobile No">
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input class="form-control" type="text" placeholder="Address">
                                </div>
                                <div class="col-md-6">
                                    <label>Country</label>
                                    <select class="custom-select">
                                        <option selected>United States</option>
                                        <option>Afghanistan</option>
                                        <option>Albania</option>
                                        <option>Algeria</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>City</label>
                                    <input class="form-control" type="text" placeholder="City">
                                </div>
                                <div class="col-md-6">
                                    <label>State</label>
                                    <input class="form-control" type="text" placeholder="State">
                                </div>
                                <div class="col-md-6">
                                    <label>ZIP Code</label>
                                    <input class="form-control" type="text" placeholder="ZIP Code">
                                </div>
                               
                            </div>
                        </div>
                        
                        <div class="shipping-address">
                            <h2>Shipping Address</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" placeholder="First Name">
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name"</label>
                                    <input class="form-control" type="text" placeholder="Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" placeholder="E-mail">
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" placeholder="Mobile No">
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input class="form-control" type="text" placeholder="Address">
                                </div>
                                <div class="col-md-6">
                                    <label>Country</label>
                                    <select class="custom-select">
                                        <option selected>United States</option>
                                        <option>Afghanistan</option>
                                        <option>Albania</option>
                                        <option>Algeria</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>City</label>
                                    <input class="form-control" type="text" placeholder="City">
                                </div>
                                <div class="col-md-6">
                                    <label>State</label>
                                    <input class="form-control" type="text" placeholder="State">
                                </div>
                                <div class="col-md-6">
                                    <label>ZIP Code</label>
                                    <input class="form-control" type="text" placeholder="ZIP Code">
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
            @foreach(['Paypal', 'Payoneer', 'Check Payment', 'Direct Bank Transfer', 'Cash on Delivery'] as $key => $payment)
                <div class="payment-method">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="payment-{{ $key }}" name="payment_method" value="{{ $payment }}">
                        <label class="custom-control-label" for="payment-{{ $key }}">{{ $payment }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="checkout-btn">
            <button type="submit">Place Order</button>
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