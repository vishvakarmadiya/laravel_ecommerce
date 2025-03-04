<style>
    /* Footer Styling */
.footer {
    background: #222;
    color: #fff;
    padding: 40px 0;
    font-family: Arial, sans-serif;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: auto;
}

.footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.footer-section {
    width: 23%;
    margin-bottom: 20px;
}

.footer-section h3 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #ffcc00;
}

.footer-section p {
    font-size: 14px;
    line-height: 1.6;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin: 8px 0;
}

.footer-section ul li a {
    color: #ccc;
    text-decoration: none;
    transition: 0.3s ease-in-out;
}

.footer-section ul li a:hover {
    color: #ffcc00;
    padding-left: 5px;
}

.social-links a {
    color: #ffcc00;
    margin-right: 10px;
    font-size: 18px;
    transition: 0.3s;
}

.social-links a:hover {
    color: #fff;
    transform: scale(1.2);
}

.featured-products .product {
    display: flex;
    align-items: center;
    margin: 8px 0;
}

.featured-products img {
    width: 50px;
    border-radius: 5px;
    margin-right: 10px;
}

.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    border-top: 1px solid #444;
    margin-top: 20px;
}

.payment-methods p, .security p {
    font-size: 14px;
    margin-right: 10px;
}

.payment-methods img, .security img {
    width: 60px;
    margin-left: 10px;
}

.footer-bottom-text {
    text-align: center;
    margin-top: 10px;
    font-size: 14px;
    color: #bbb;
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }
    .footer-section {
        width: 100%;
    }
    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }
    .payment-methods, .security {
        justify-content: center;
    }
}

</style>
<!-- Footer Start -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- About Section -->
            <div class="footer-section about">
                <h2>Kittusweety Collection</h2>
                <p>Your one-stop destination for stylish and high-quality fashion. Explore our exclusive collections designed to bring elegance and charm to your wardrobe.</p>
                <div class="social-links">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Wishlist</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                </ul>
            </div>

            <!-- Featured Products -->
            <div class="footer-section featured-products">
                <h3>Featured Products</h3>
                <div class="product">
                    <img src="https://via.placeholder.com/50" alt="Product 1">
                    <a href="#">Stylish Handbag</a>
                </div>
                <div class="product">
                    <img src="https://via.placeholder.com/50" alt="Product 2">
                    <a href="#">Elegant Dress</a>
                </div>
                <div class="product">
                    <img src="https://via.placeholder.com/50" alt="Product 3">
                    <a href="#">Trendy Sneakers</a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="footer-section contact">
                <h3>Contact Us</h3>
                <p><i class="fa fa-map-marker"></i> Noida, Sector 63, Uttar Pradesh, India</p>
                <p><i class="fa fa-envelope"></i> support@kittusweetycollection.com</p>
                <p><i class="fa fa-phone"></i> +91-9876543210</p>
            </div>
        </div>

        <!-- Payment & Security -->
        <div class="footer-bottom">
            <div class="payment-methods">
                <p>We Accept:</p>
                <img src="https://via.placeholder.com/100" alt="Payment Methods">
            </div>
            <div class="security">
                <p>Secured By:</p>
                <img src="https://via.placeholder.com/50" alt="SSL">
                <img src="https://via.placeholder.com/50" alt="Norton">
                <img src="https://via.placeholder.com/50" alt="GoDaddy">
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom-text">
            <p>&copy; 2025 Kittusweety Collection. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<!-- Footer End -->
