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


    <!-- Main Slider Start -->
    <div class="home-slider">
        <div class="main-slider">
            @if (getSlider()->isNotEmpty())
            @foreach (getSlider() as $slider )
            <div class="main-slider-item"><img src="{{ asset("images/sliders/$slider->image") }}" alt="Slider Image" /></div>
            @endforeach
            @endif
        </div>
    </div>
    <!-- Main Slider End -->


    <!-- Feature Start-->
    <div class="feature">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-shield"></i>
                        <h2>Trusted Shopping</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-shopping-bag"></i>
                        <h2>Quality Product</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-truck"></i>
                        <h2>Worldwide Delivery</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-phone"></i>
                        <h2>Telephone Support</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End-->


    <!-- Category Start-->
    <div class="category">
        <div class="container-fluid">
            <div class="row">
                @if (getCtegorys()->isNotEmpty())
                @foreach (getCtegorys() as $cat )


                <div class="col-md-3">
                    <div class="category-img">
                        <img src="{{ asset("images/category/$cat->image") }}" />
                        <a class="category-name" href="{{ route('products_listing', $cat->name) }}">
                            <h2>{{ $cat->name }}</h2>
                        </a>
                    </div>
                </div>

                @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- Category End-->


    <!-- Featured Product Start -->
    <div class="featured-product">
        <div class="container">
            <div class="section-header">
                <h3>Featured Product</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                @if (getFeature()->isNotEmpty())
                @foreach (getFeature() as $feature)
                <div class="col-lg-3">
                    <div class="product-item">
                        <div class="product-image">
                            <a href="{{ route('product_ditails',$feature->name) }}">
                                <img src="{{ asset("images/products/$feature->image") }}" alt="Product Image">
                            </a>
                            <div class="product-action">
                                <a href="#"><i class="fa fa-cart-plus"></i></a>
                                <a href="#"><i class="fa fa-heart"></i></a>
                                <a href="{{ route('product_ditails',$feature->name) }}"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="title"><a href="">{{ $feature->name }}</a></div>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="price" style="font-size: 20px;">${{ $feature->price }} <span>${{ $feature->mrp }}</span></div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- Featured Product End -->


    <!-- Newsletter Start -->
    <div class="newsletter">
        <div class="container">
            <div class="section-header">
                <h3>Subscribe Our Newsletter</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p>
            </div>
            <div class="form">
                <input type="email" value="Your email here">
                <button>Submit</button>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->


    <!-- Recent Product Start -->
    <div class="recent-product">
        <div class="container">
            <div class="section-header">
                <h3>Recent Product</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p>
            </div>
            <div class="row align-items-center product-slider product-slider-4">

                @if (getLatestProducts()->isNotEmpty())
                @foreach (getLatestProducts() as $product)
                <div class="col-lg-3">
                    <div class="product-item">
                        <div class="product-image">
                            <a href="{{ route('product_ditails',$product->name) }}">
                                <img src="{{ asset("images/products/$product->image") }}" alt="Product Image">
                            </a>
                            <div class="product-action">
                                <a href="#"><i class="fa fa-cart-plus"></i></a>
                                <a href="#"><i class="fa fa-heart"></i></a>
                                <a href="{{ route('product_ditails',$product->name) }}"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="title"><a href="">{{ $product->name }}</a></div>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="price" style="font-size: 20px;">
                                ${{ $product->price }} <span>${{ $product->mrp }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </div>
    <!-- Recent Product End -->


    <!-- Brand Start -->
    <div class="brand">
        <div class="container">
            <div class="section-header">
                <h3>Our Brands</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p>
            </div>
            <div class="brand-slider">
                <div class="brand-item"><img src="fontend/img/brand-1.png" alt=""></div>
                <div class="brand-item"><img src="fontend/img/brand-2.png" alt=""></div>
                <div class="brand-item"><img src="fontend/img/brand-3.png" alt=""></div>
                <div class="brand-item"><img src="fontend/img/brand-4.png" alt=""></div>
                <div class="brand-item"><img src="fontend/img/brand-5.png" alt=""></div>
                <div class="brand-item"><img src="fontend/img/brand-6.png" alt=""></div>
            </div>
        </div>
    </div>
    <!-- Brand End -->


    @include ('font.footer');


    <!-- Back to Top -->
    @include ('font.footerlink')
</body>

</html>