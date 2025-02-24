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

    <script>
        function addToCart(product) {
            console.log("Adding product:", product); // Debugging

            if (!product || !product.id) {
                console.error("Product data missing!");
                return;
            }

            // Your existing logic...
        }
    </script>
    <!-- main containt Start  -->

    <!-- Breadcrumb Start -->
    @include('font.product_diatail_nav')
    <!-- Breadcrumb End -->
    <script>
    let isAuthenticated = @json(Auth::check()); // Check if user is logged in

    function addToCart(product) {
        if (!product || !product.id) {
            console.error("Product is not defined or missing required data");
            return;
        }

        if (!isAuthenticated) {
            let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
            cart.push({ id: product.id, quantity: 1 });
            sessionStorage.setItem("cart", JSON.stringify(cart));
            alert("Product added to cart (Guest)");
        } else {
            fetch("{{ url('/cart/add') }}/" + product.id, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ quantity: 1 })
            })
            .then(response => response.json())
            .then(data => alert(data.message))
            .catch(error => {
                console.error("Error:", error);
                alert("Error: " + error.message);
            });
        }
    }
</script>




    <!-- Product List Start -->
    <div class="product-view">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="product-search">
                                        <input type="text" placeholder="Search">
                                        <button><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-short">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Product sort by</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('products_listing', 'low') }}" class="dropdown-item">Price (Low to High)</a>
                                                <a href="{{ route('products_listing', 'high') }}" class="dropdown-item">Price (High to Low)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Start Product Loop -->
                        @if (!empty($product) && $product->isNotEmpty())
                        @foreach ($product as $products)
                        <div class="col-lg-4">
                            <div class="product-item">
                                <div class="product-image">
                                    <a href="{{ route('product_ditails',$products->name) }}">
                                        <img src="{{ asset('images/products/' . $products->image) }}" height="300px" alt="Product Image">
                                    </a>
                                    <div class="product-action">

                                        <a href="javascript:void(0);" onclick="addToCart({ id: {{ $products->id }} })">
                                            <i class="fa fa-cart-plus"></i>
                                        </a>

                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="{{ route('product_ditails',$products->name) }}"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="title"><a href="#">{{ $products->name }}</a></div>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="price">${{ $products->price }} <span>${{ $products->mrp }}</span></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <!-- End Product Loop -->

                        <!-- Laravel Pagination -->
                        <div class="col-lg-12">
                            {{ $product->links() }}
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-3">
                    <div class="sidebar-widget category">
                        <h2 class="title">Category</h2>
                        <ul>
                            @if ($category->isNotEmpty())
                            @foreach ($category as $categories)
                            <li><a href="{{ route('products_listing', $categories->name) }}">{{ $categories->name }}</a><span></span></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="sidebar-widget image">
                        <h2 class="title">Featured Product</h2>
                        <a href="">
                            <img src="{{ asset('fontend/img/category-1.jpg') }}" alt="Image">
                        </a>
                    </div>

                    <div class="sidebar-widget brands">
                        <h2 class="title">Our Sub Category</h2>
                        <ul>
                            @if ($brand->isNotEmpty())
                            @foreach ($brand as $brands)
                            <li><a href="#">{{ $brands->name }}</a><span></span></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
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