
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
                @if (getferture()->isNotEmpty())
                    @foreach (getferture() as $fetucher )
                    
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-1.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-2.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-3.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-4.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-5.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
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
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-2.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-4.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-6.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-8.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="fontend/product-detail.html">
                                    <img src="fontend/img/product-9.png" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="fontend/#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="fontend/#"><i class="fa fa-heart"></i></a>
                                    <a href="fontend/#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="fontend/#">Phasellus Gravida</a></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">$22 <span>$25</span></div>
                            </div>
                        </div>
                    </div>
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
