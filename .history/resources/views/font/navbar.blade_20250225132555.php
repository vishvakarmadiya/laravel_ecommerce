<div class="header">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="fontend/#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav m-auto">
                    <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ route('products_listing') }}" class="nav-item nav-link">Products</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu">
                            <a href="fontend/product-list.html" class="dropdown-item">Product</a>
                            <a href="fontend/product-detail.html" class="dropdown-item">Product Detail</a>

                            @auth
                            <a href="{{route( 'addcartshow') }}" class="dropdown-item">Cart</a>
                            <a href="fontend/wishlist.html" class="dropdown-item">Wishlist</a>
                            <a href="{{ route('checkout') }}" class="dropdown-item">Checkout</a>
                            <a href="fontend/my-account.html" class="dropdown-item">My Account</a>
                            @else
                            <a href="{{ route('admin.login') }}" class="dropdown-item">Login & Register</a>
                            @endauth
                        </div>
                    </div>
                    <a href="fontend/contact.html" class="nav-item nav-link">Contact Us</a>
                </div>
            </div>

        </nav>
    </div>
</div>