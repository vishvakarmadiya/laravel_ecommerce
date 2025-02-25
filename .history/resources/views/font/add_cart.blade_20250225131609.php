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

        <!-- Coupon Section -->
        @if(!getCart()->isEmpty())
    <div class="row">
        {{-- Coupon Section --}}
        <div class="col-md-6">
            <div class="coupon">
                <form action="{{ route('cart.applyCoupon') }}" method="POST">
                    @csrf
                    <input type="text" name="coupon_code" class="form-control" placeholder="Enter Coupon Code">
                    <button type="submit" class="btn btn-primary mt-2">Apply Code</button>
                </form>
            </div>
        </div>

        {{-- Cart Summary & Checkout --}}
        <div class="col-md-6">
            <div class="cart-summary">
                <div class="cart-content">
                    <h3>Cart Summary</h3>
                    <p>Sub Total <span>${{ getCart()->sum(fn($item) => $item->price * $item->quantity) }}</span></p>
                    <p>Shipping Cost <span>$5</span></p>
                    <h4>Grand Total <span>${{ getCart()->sum(fn($item) => $item->price * $item->quantity) + 5 }}</span></h4>
                </div>

                {{-- Checkout Button --}}
                <div class="cart-btn mt-3">
                    <button class="btn btn-secondary">Update Cart</button>
                    <form action="{{ route('cart.checkout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Proceed to Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- Empty Cart Message --}}
    <div class="row">
        <div class="col-12 text-center">
            <h4>Your cart is empty!</h4>
            <a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">Continue Shopping</a>
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