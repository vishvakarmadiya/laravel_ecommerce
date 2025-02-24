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


    <!-- Product List Start --> 
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
                                        <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="form-control text-center" style="width: 70px;">
                                            <button type="submit" class="btn btn-sm btn-success mt-1">Update</button>
                                        </form>
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
            
            @if(!getCart()->isEmpty())
                <div class="text-right">
                    <form action="{{-- route('cart.checkout') --}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
                    </form>
                </div>
            @endif

        </div>
    </div>
</div>




    <!-- Product List End -->


    <!-- main containt end -->

    @include ('font.footer')


    <!-- Back to Top -->
    @include ('font.footerlink')
</body>

</html>