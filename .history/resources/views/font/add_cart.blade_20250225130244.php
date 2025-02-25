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


    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle text-center">
                                @if(getCart()->isEmpty())
                                <tr>
                                    <td colspan="6">Your cart is empty.</td>
                                </tr>
                                @else
                                @foreach(getCart() as $cartItem)
                                <tr>
                                    <td><a href="#"><img src="{{ asset('images/products/' . $cartItem->image) }}" width="50PX" height="50PX" alt="Image"></a></td>
                                    <td><a href="#">{{ $cartItem->name }}</a></td>
                                    <td>${{ $cartItem->price }}</td>
                                    <td>
                                        @if ($cartItem->status==1)
                                        <span class="badge badge-success">In Cart</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="qty d-flex justify-content-center">
                                            <form action="{{ route('cart_update', $cartItem->id) }}" method="POST" class="d-flex">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="quantity" value="{{ $cartItem->quantity - 1 }}" class="btn btn-sm btn-light btn-minus"><i class="fa fa-minus"></i></button>
                                                <input type="text" name="quantity" value="{{ $cartItem->quantity }}" class="form-control text-center mx-2" style="width: 50px;">
                                                <button type="submit" name="quantity" value="{{ $cartItem->quantity + 1 }}" class="btn btn-sm btn-light btn-plus"><i class="fa fa-plus"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>${{ $cartItem->price * $cartItem->quantity }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if(!getCart()->isEmpty())
            <div class="row">
                <div class="col-md-6">
                    <div class="coupon">
                        <form action="{{-- route('cart.applyCoupon') --}}" method="POST">
                            @csrf
                            <input type="text" name="coupon_code" placeholder="Coupon Code">
                            <button type="submit" class="btn btn-primary">Apply Code</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cart-summary">
                        <div class="cart-content">
                            <h3>Cart Summary</h3>
                            <p>Sub Total <span>${{ getCart()->sum(fn($item) => $item->price * $item->quantity) }}</span></p>
                            <p>Shipping Cost <span>$5</span></p>
                            <h4>Grand Total <span>${{ getCart()->sum(fn($item) => $item->price * $item->quantity) + 5 }}</span></h4>
                        </div>

                        {{-- Payment Method Selection --}}
                        <div class="payment-method">
                            <h4>Select Payment Method</h4>
                            <form action="{{-- route('cart.checkout') --}}" method="POST">
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod" checked>
                                    <label class="form-check-label" for="cod">Cash on Delivery</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="card" id="card">
                                    <label class="form-check-label" for="card">Credit/Debit Card</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="paypal" id="paypal">
                                    <label class="form-check-label" for="paypal">PayPal</label>
                                </div>

                                <div class="cart-btn mt-3">
                                    <button type="submit" class="btn btn-success">Checkout</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
    <!-- Cart End -->




    <!-- Product List End -->


    <!-- main containt end -->

    @include ('font.footer')


    <!-- Back to Top -->
    @include ('font.footerlink')
</body>

</html>