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
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle text-center">
                            <tr>
                                <td><a href="#"><img src="img/product-1.png" alt="Product" width="50px"></a></td>
                                <td><a href="#">Product Name</a></td>
                                <td>$22</td>
                                <td>
                                    <div class="qty d-flex justify-content-center">
                                        <button class="btn btn-sm btn-light btn-minus"><i class="fa fa-minus"></i></button>
                                        <input type="text" value="1" class="form-control text-center mx-2" style="width: 50px;">
                                        <button class="btn btn-sm btn-light btn-plus"><i class="fa fa-plus"></i></button>
                                    </div>
                                </td>
                                <td>$22</td>
                                <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            <tr>
                                <td><a href="#"><img src="img/product-2.png" alt="Product" width="50px"></a></td>
                                <td><a href="#">Product Name</a></td>
                                <td>$22</td>
                                <td>
                                    <div class="qty d-flex justify-content-center">
                                        <button class="btn btn-sm btn-light btn-minus"><i class="fa fa-minus"></i></button>
                                        <input type="text" value="1" class="form-control text-center mx-2" style="width: 50px;">
                                        <button class="btn btn-sm btn-light btn-plus"><i class="fa fa-plus"></i></button>
                                    </div>
                                </td>
                                <td>$22</td>
                                <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Coupon Section -->
        <div class="row">
            <div class="col-md-6">
                <div class="coupon">
                    <input type="text" class="form-control" placeholder="Enter Coupon Code">
                    <button class="btn btn-primary mt-2">Apply Code</button>
                </div>
            </div>

            <!-- Cart Summary & Checkout -->
            <div class="col-md-6">
                <div class="cart-summary">
                    <div class="cart-content">
                        <h3>Cart Summary</h3>
                        <p>Sub Total <span>$44</span></p>
                        <p>Shipping Cost <span>$5</span></p>
                        <h4>Grand Total <span>$49</span></h4>
                    </div>

                    <!-- Checkout Button -->
                    <div class="cart-btn mt-3">
                        <button class="btn btn-secondary">Update Cart</button>
                        <button class="btn btn-success">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
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