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
    document.addEventListener("DOMContentLoaded", function () {
        const addToCartButtons = document.querySelectorAll(".add-to-cart");

        addToCartButtons.forEach(button => {
            button.addEventListener("click", function (event) {
                event.preventDefault();
                
                const productId = this.getAttribute("data-product-id");
                const productName = this.getAttribute("data-product-name");
                const productPrice = this.getAttribute("data-product-price");

                let cart = JSON.parse(localStorage.getItem("cart")) || {};

                if (cart[productId]) {
                    cart[productId].quantity += 1;
                } else {
                    cart[productId] = {
                        product_id: productId,
                        name: productName,
                        price: productPrice,
                        quantity: 1
                    };
                }

                localStorage.setItem("cart", JSON.stringify(cart));
                alert("Product added to cart!");
            });
        });
    });
</script>
    <!-- main containt Start  -->

    <!-- Breadcrumb Start -->
    @include('font.product_diatail_nav')
    <!-- Breadcrumb End -->
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
                        @if(session('success'))
                        <script>
                            alert("{{ session('success') }}");
                        </script>
                        @endif
                        @if(session('error'))
                        <script>
                            alert("{{ session('error') }}");
                        </script>
                        @endif

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




                                        <form action="{{ route('addcart') }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                                            <button class="" class="btn" style=""
                                                data-product-id="{{ $products->id }}"
                                                data-product-name="{{ $products->name }}"
                                                data-product-price="{{ $products->price }}">
                                                <!-- <a href="#" class="add-to-cart"><i class="fa fa-cart-plus"></i></a> -->
                                            </button>
                                        </form>



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