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

    @if(!empty(getCart()) && getCart()->count() > 0)
    <div class="checkout">
        <div class="container">
            <div class="row">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Cart Summary -->
                <div class="col-md-5">
                    <div class="checkout-summary">
                        <h2>Cart Total</h2>
                        <div class="checkout-content">
                            <h3>Products</h3>
                            @php
                                $price = 0;
                                $shipping = 50;
                            @endphp
                            @foreach (getCart() as $cartItem)
                                @php $itemTotal = $cartItem->price * $cartItem->quantity; @endphp
                                <p>{{ $cartItem->name }} (x{{ $cartItem->quantity }}) <span>${{ $itemTotal }}</span></p>
                                @php $price += $itemTotal; @endphp
                            @endforeach
                            <p class="sub-total">Sub Total <span>${{ $price }}</span></p>
                            <p class="ship-cost">Shipping Cost <span>${{ $shipping }}</span></p>
                            <h4>Grand Total <span>${{ $total = $price + $shipping }}</span></h4>
                        </div>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="col-md-7">
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf

                        <div class="checkout-payment">
                            <h2>Payment Methods</h2>
                            <div class="payment-methods">
                                @foreach(['Direct Bank Transfer', 'Cash on Delivery', 'Razorpay'] as $key => $payment)
                                <div class="payment-method">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="payment-{{ $key }}"
                                            name="payment_method" value="{{ $payment }}"
                                            {{ old('payment_method') == $payment ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="payment-{{ $key }}">{{ $payment }}</label>
                                    </div>
                                </div>
                                @endforeach
                                @error('payment_method')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Place Order Button -->
                            <div class="checkout-btn">
                                <button type="submit" id="place-order-btn">Place Order</button>

                                <!-- Razorpay Payment Button -->
                                <a id="rzp-button1" style="display:none;" onclick="payment()">Pay with Razorpay</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@else
    <p>Product not found, redirecting...</p>
    <script> window.location = "{{ route('addcartshow') }}"; </script>
@endif

<!-- Razorpay Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('place-order-btn').addEventListener('click', function(event) {
        let selectedMethod = document.querySelector('input[name="payment_method"]:checked')?.value;

        if (!selectedMethod) {
            alert("Please select a payment method!");
            return;
        }

        if (selectedMethod === "Razorpay") {
            event.preventDefault();
            payment();
        }
    });

    function payment() {
        let amount = "{{ $total * 100 }}"; // Convert to paise

        let options = {
            "key": "rzp_test_eAwoqbEXBt3CVM",
            "amount": amount,
            "currency": "INR",
            "name": "Kittusweety Collection",
            "description": "Order Payment",
            "image": "https://example.com/your_logo",
            "callback_url": "{{ route('razorpay.verify') }}",
            "theme": {
                "color": "#3399cc"
            },
            "handler": function (response) {
                console.log("Payment Successful:", response);
                alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
            },
            "prefill": {
                "name": "{{ auth()->user()->name }}",
                "email": "{{ auth()->user()->email }}",
                "contact": "{{ auth()->user()->mobile }}"
            },
            "notes": {
                "address": "Kittusweety Collection"
            },
            "modal": {
                "ondismiss": function () {
                    alert('Payment cancelled');
                }
            }
        };

        let paymentObject = new Razorpay(options);

        paymentObject.on('payment.failed', function (response) {
            console.log("Payment failed:", response.error);
            alert("Payment Failed: " + response.error.description);
        });

        paymentObject.open();
    }
</script>






        <!-- main containt end -->

        @include ('font.footer')


        <!-- Back to Top -->
        @include ('font.footerlink')
</body>

</html>