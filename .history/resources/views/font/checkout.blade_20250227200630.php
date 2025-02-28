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

    @if(getCart()->isNotEmpty())
    <div class="checkout">
        <div class="container">
            <div class="row">
                <!-- Billing & Shipping Details -->
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

    <!-- Payment Methods -->
    <div class="checkout-payment">
        <h2>Payment Methods</h2>
        <div class="payment-methods">
            @foreach(['Direct Bank Transfer', 'Cash on Delivery', 'Razorpay'] as $key => $payment)
            <div class="payment-method">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="payment-{{ $key }}" name="payment_method"
                        value="{{ $payment }}" {{ old('payment_method') == $payment ? 'checked' : '' }}>
                    <label class="custom-control-label" for="payment-{{ $key }}">{{ $payment }}</label>
                </div>
            </div>
            @endforeach

            @error('payment_method')
            <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
        </div>

        <div class="checkout-btn">
    <button type="submit" id="place-order-btn">Place Order</button>

    <!-- Razorpay Payment Button -->
    <a id="rzp-button1" style="display:none;" onclick="payment()">Pay with Razorpay</a>

    <!-- Razorpay Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('place-order-btn').addEventListener('click', function(event) {
            event.preventDefault();
            
            let selectedMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
            
            if (!selectedMethod) {
                alert("Please select a payment method!");
                return;
            }

            if (selectedMethod === "Razorpay") {
                document.getElementById('rzp-button1').click();
            } else {
                alert(`You selected ${selectedMethod}. Implement order placement logic here.`);
                // Submit order for other payment methods
            }
        });

        function payment() {
            let razorpayKey = "{{ config('services.razorpay.key') }}";
            let orderId = "{{ $order->id ?? '' }}";
            let amount = "{{ $total * 100 }}"; // Convert to paise

            if (!orderId) {
                alert("Order ID missing. Cannot process payment.");
                return;
            }

            let options = {
                "key": razorpayKey, // Correct key retrieval
                "amount": amount,
                "currency": "INR",
                "name": "Kittusweety Collection",
                "description": "Order Payment",
                "image": "https://example.com/your_logo",
                "order_id": orderId,
                "callback_url": "{{ route('razorpay.verify') }}",
                "prefill": {
                    "name": "{{ auth()->user()->name ?? 'Guest' }}",
                    "email": "{{ auth()->user()->email ?? 'guest@example.com' }}",
                    "contact": "{{ auth()->user()->phone ?? '9517485106' }}"
                },
                "notes": {
                    "address": "Customer Address Here"
                },
                "theme": {
                    "color": "#3399cc"
                },
                "handler": function(response) {
                    fetch("{{ route('razorpay.verify') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Payment Successful!");
                            window.location.href = "{{ route('profile') }}";
                        } else {
                            alert("Payment Verification Failed!");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                }
            };

            let rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>
</div>

    </div>
</div>

                </form>
            </div>
        </div>

        @else
        <p>Product not found, redirecting...</p>
        <script>
            window.location = "{{ route('addcartshow') }}"; // JavaScript redirection
        </script>
        @endif




        <!-- main containt end -->

        @include ('font.footer')


        <!-- Back to Top -->
        @include ('font.footerlink')
</body>

</html>