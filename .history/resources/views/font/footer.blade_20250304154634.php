<!-- Footer Start -->
<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="footer-title">Kittusweety Collection</div>
                    <p>
                        Your one-stop destination for stylish and high-quality fashion. Explore our exclusive collections designed to bring elegance and charm to your wardrobe.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="footer-title">Useful Pages</div>
                    <ul>
                        <li><a href="{{ url('frontend/product.html') }}">Products</a></li>
                        <li><a href="{{ url('frontend/product-detail.html') }}">Product Details</a></li>
                        <li><a href="{{ url('frontend/cart.html') }}">Cart</a></li>
                        <li><a href="{{ url('frontend/checkout.html') }}">Checkout</a></li>
                        <li><a href="{{ url('frontend/login.html') }}">Login & Register</a></li>
                        <li><a href="{{ url('frontend/my-account.html') }}">My Account</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="footer-title">Quick Links</div>
                    <ul>
                        <li><a href="{{ url('frontend/about-us.html') }}">About Us</a></li>
                        <li><a href="{{ url('frontend/contact.html') }}">Contact Us</a></li>
                        <li><a href="{{ url('frontend/faq.html') }}">FAQ</a></li>
                        <li><a href="{{ url('frontend/wishlist.html') }}">Wishlist</a></li>
                        <li><a href="{{ url('frontend/privacy-policy.html') }}">Privacy Policy</a></li>
                        <li><a href="{{ url('frontend/terms.html') }}">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="footer-title">Get in Touch</div>
                    <div class="contact-info">
                        <p><i class="fa fa-map-marker"></i> Noida, Sector 63, Uttar Pradesh, India</p>
                        <p><i class="fa fa-envelope"></i> support@kittusweetycollection.com</p>
                        <p><i class="fa fa-phone"></i> +91-9876543210</p>
                        <div class="social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row payment">
            <div class="col-md-6">
                <div class="payment-method">
                    <p>We Accept:</p>
                    <img src="{{ asset('frontend/img/payment-method.png') }}" alt="Payment Methods" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="payment-security">
                    <p>Secured By:</p>
                    <img src="{{ asset('frontend/img/godaddy.svg') }}" alt="Security" />
                    <img src="{{ asset('frontend/img/norton.svg') }}" alt="Security" />
                    <img src="{{ asset('frontend/img/ssl.svg') }}" alt="Security" />
            
