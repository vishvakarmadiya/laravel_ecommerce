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
    <!-- Product Detail Start -->
    <div class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row align-items-center product-detail-top">
                        <div class="col-md-5">

                            <div class="product-slider-single">
                                <img src="{{ asset("images/products/$product->image") }}" alt="Product Image">

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title">
                                    <h2>{{ $product->name }}</h2>
                                </div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">${{ $product->price }} <span>${{ $product->mrp }}</span></div>
                                <div class="details">
                                    <p>
                                        {{ $product->description }}
                                    </p>
                                </div>

                                <div class="quantity">
                                    <h4>Quantity:</h4>
                                    <div class="qty">
                                        <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                        <input type="text" value="1">
                                        <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="action">
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="#"><i class="fa fa-heart"></i></a>
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row product-detail-bottom">
                        <div class="col-lg-12">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#specification">Specification</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#reviews">Reviews (1)</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="description" class="container tab-pane active"><br>
                                    <h4>Product description</h4>
                                    <p>
                                        {{ $product->description }}
                                    </p>
                                </div>
                                <div id="specification" class="container tab-pane fade"><br>
                                    <h4>Product specification</h4>
                                    <ul>
                                        <li>Lorem ipsum dolor sit amet</li>
                                        <li>Lorem ipsum dolor sit amet</li>
                                        <li>Lorem ipsum dolor sit amet</li>
                                        <li>Lorem ipsum dolor sit amet</li>
                                        <li>Lorem ipsum dolor sit amet</li>
                                    </ul>
                                </div>
                                <div id="reviews" class="container tab-pane fade"><br>
                                    <div class="reviews-submitted">
                                        <div class="reviewer">Phasellus Gravida - <span>01 Jan 2020</span></div>
                                        <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <p>
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
                                        </p>
                                    </div>
                                    <div class="reviews-submit">
                                        <h4>Give your Review:</h4>
                                        <div class="ratting">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="row form">
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" placeholder="Email">
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea placeholder="Review"></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <button>Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="section-header">
                            <h3>Related Products</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                            </p>
                        </div>
                    </div>

                    <div class="row align-items-center product-slider product-slider-3">







                        @if ($relatedProducts)

                        @foreach ($relatedProducts as $rp )
                        <div class="col-lg-3">
                            <div class="product-item">
                                <div class="product-image">
                                    <a href="{{ route('product_ditails',$rp->name) }}">
                                        <img src="{{ asset("images/products/$rp->image")}}" alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="title"><a href="#">{{ $rp->name }}</a></div>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="price" style="font-size: 18px;">${{ $rp->price }} <span>${{ $rp->mrp }} </span></div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        @endif

                    </div>
                </div>

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
    <!-- Product Detail End -->

    <!-- Product List End -->


    <!-- main containt end -->

    @include ('font.footer')


    <!-- Back to Top -->
    @include ('font.footerlink')
</body>

</html>