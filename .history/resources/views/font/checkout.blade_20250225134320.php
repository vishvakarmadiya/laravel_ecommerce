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
                            <input class="form-control" type="text" placeholder="First Name" name="billing_first_name">
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Last Name" name="billing_last_name">
                        </div>
                        <div class="col-md-6">
                            <label>E-mail</label>
                            <input class="form-control" type="email" placeholder="E-mail" name="billing_email">
                        </div>
                        <div class="col-md-6">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="Mobile No" name="billing_phone">
                        </div>
                        <div class="col-md-12">
                            <label>Address</label>
                            <input class="form-control" type="text" placeholder="Address" name="billing_address">
                        </div>
                    </div>
                </div>
                <div class="shipping-address">
                    <h2>Shipping Address</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="checkbox" id="same_as_billing"> <label for="same_as_billing">Same as Billing</label>
                        </div>
                        <div id="shipping_fields">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="First Name" name="shipping_first_name">
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Last Name" name="shipping_last_name">
                            </div>
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
                        <!-- {{  $price=0}} -->
                        @foreach (getCart() as $cartItem)
                        <p>{{ $cartItem->name }} <span>${{$price
                        = $cartItem->price }}</span></p>
                        {{ $sub=$price+$cartItem->price }}
                        @endforeach
                        <p class="sub-total">Sub Total<span>${{$price}}</span></p>
                        <p class="ship-cost">Shipping Cost<span>${{-- getShippingCost() --}}</span></p>
                        <h4>Grand Total<span>${{-- getCartTotal() --}}</span></h4>
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