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



                <div class="col-md-7">
                    <div class="billing-address">
                        <h2>Billing Address</h2>
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="billing_first_name"
                                        value="{{ old('billing_first_name', Auth::user()->name) }}" placeholder="First Name">
                                    @error('billing_first_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" name="billing_last_name"
                                        value="{{ old('billing_last_name') }}" placeholder="Last Name">
                                    @error('billing_last_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="email" name="billing_email"
                                        value="{{ old('billing_email', Auth::user()->email) }}" placeholder="E-mail">
                                    @error('billing_email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" name="billing_mobile"
                                        value="{{ old('billing_mobile') }}" placeholder="Mobile No">
                                    @error('billing_mobile')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input class="form-control" type="text" name="billing_address"
                                        value="{{ old('billing_address') }}" placeholder="Address">
                                    @error('billing_address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Country</label>
                                    <select class="custom-select" name="billing_country">
                                        <option value="United States" selected>United States</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                    </select>
                                    @error('billing_country')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>City</label>
                                    <input class="form-control" type="text" name="billing_city"
                                        value="{{ old('billing_city') }}" placeholder="City">
                                    @error('billing_city')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>State</label>
                                    <input class="form-control" type="text" name="billing_state"
                                        value="{{ old('billing_state') }}" placeholder="State">
                                    @error('billing_state')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>ZIP Code</label>
                                    <input class="form-control" type="text" name="billing_zip"
                                        value="{{ old('billing_zip') }}" placeholder="ZIP Code">
                                    @error('billing_zip')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                    </div>

                    <div class="shipping-address">
                        <h2>Shipping Address</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="shipping_first_name"
                                    value="{{ old('shipping_first_name') }}" placeholder="First Name">
                                @error('shipping_first_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="shipping_last_name"
                                    value="{{ old('shipping_last_name') }}" placeholder="Last Name">
                                @error('shipping_last_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input class="form-control" type="email" name="shipping_email"
                                    value="{{ old('shipping_email') }}" placeholder="E-mail">
                                @error('shipping_email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" name="shipping_mobile"
                                    value="{{ old('shipping_mobile') }}" placeholder="Mobile No">
                                @error('shipping_mobile')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label>Address</label>
                                <input class="form-control" type="text" name="shipping_address"
                                    value="{{ old('shipping_address') }}" placeholder="Address">
                                @error('shipping_address')
                                <small class="text-danger">{{ $message }}</small>
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
                            $shipping = 50;
                            @endphp
                            @foreach (getCart() as $cartItem)
                            @php $itemTotal = $cartItem->price * $cartItem->quantity; @endphp
                            <p>{{ $cartItem->name }} (x{{ $cartItem->quantity }}) <span>${{ $itemTotal }}</span></p>
                            @php $price += $itemTotal; @endphp
                            @endforeach
                            <p class="sub-total">Sub Total <span>${{ $price }}</span></p>
                            <p class="ship-cost">Shipping Cost <span>${{ $shipping }}</span></p>
                            <h4>Grand Total <span>${{$total= $price + $shipping }}</span></h4>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="checkout-payment">
                        <h2>Payment Methods</h2>
                        <div class="payment-methods">
                            @foreach(['Direct Bank Transfer', 'Cash on Delivery'] as $key => $payment)
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

                        <div class="checkout-btn">
                            <button type="submit">Place Order</button>
                            <!-- razorpay Start -->
                            <button id="rzp-button1">Pay</button>
                            <button id="rzp-button1">Pay</button>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var razorpayKey = "{{ config('services.razorpay.key') }}";
    var orderId = "{{ 'order_'.rand(10,1000) }}"; // Ensure this is correctly passed from Laravel

    var options = {
        "key": razorpayKey, // Razorpay Key ID from Laravel Config
        "amount": "{{ $total * 100 }}", // Amount in paise (₹500 = 50000)
        "currency": "INR",
        "name": "Kittusweety Collection", // Your Business Name
        "description": "Order Payment",
        "image": "https://example.com/your_logo", // Business Logo
        "order_id": orderId, // Dynamic Order ID from Laravel
        "callback_url": "{{ route('razorpay.verify') }}", // Laravel route to verify payment
        "prefill": {
            "name": "{{ auth()->user()->name ?? 'Guest' }}",
            "email": "{{ auth()->user()->email ?? 'guest@example.com' }}",
            "contact": "{{ auth()->user()->phone ?? '9000090000' }}"
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
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
                    window.location.href = "{{ route('order.success') }}"; // Redirect to order success page
                } else {
                    alert("Payment Verification Failed!");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    };

    var rzp1 = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function(e) {
        rzp1.open();
        e.preventDefault();
    };
</script>

                            <!-- razorpay End  -->
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