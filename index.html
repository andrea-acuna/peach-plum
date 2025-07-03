<?php
session_start();

$conn = new mysqli("localhost", "root", "", "pp_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'] ?? null;
$session_id = session_id();

if ($user_id) {
    $stmt_fetch_guest_cart = $conn->prepare("SELECT product_id, quantity FROM cart WHERE session_id = ? AND user_id IS NULL");
    $stmt_fetch_guest_cart->bind_param("s", $session_id);
    $stmt_fetch_guest_cart->execute();
    $guest_cart_result = $stmt_fetch_guest_cart->get_result();

    if ($guest_cart_result->num_rows > 0) {
        while ($guest_item = $guest_cart_result->fetch_assoc()) {
            $product_id = $guest_item['product_id'];
            $quantity = $guest_item['quantity'];

            $stmt_check_user_cart = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
            $stmt_check_user_cart->bind_param("ii", $user_id, $product_id);
            $stmt_check_user_cart->execute();
            $user_cart_item_result = $stmt_check_user_cart->get_result();

            if ($user_cart_item_result->num_rows > 0) {
                $stmt_update_user_cart = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
                $stmt_update_user_cart->bind_param("iii", $quantity, $user_id, $product_id);
                $stmt_update_user_cart->execute();
                $stmt_update_user_cart->close();
            } else {
                $stmt_insert_user_cart = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
                $stmt_insert_user_cart->bind_param("iii", $user_id, $product_id, $quantity);
                $stmt_insert_user_cart->execute();
                $stmt_insert_user_cart->close();
            }

            $stmt_check_user_cart->close();
        }

        $stmt_delete_guest_cart = $conn->prepare("DELETE FROM cart WHERE session_id = ? AND user_id IS NULL");
        $stmt_delete_guest_cart->bind_param("s", $session_id);
        $stmt_delete_guest_cart->execute();
        $stmt_delete_guest_cart->close();
    }

    $stmt_fetch_guest_cart->close();
}

$cart_count = 0;
if ($user_id) {
    $stmt = $conn->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart_count = $result->fetch_assoc()['total'] ?? 0;
    $stmt->close();
}

// Fetch featured products from database (limit to 6 for the homepage)
$featured_products = $conn->query("SELECT * FROM products ORDER BY date_added DESC LIMIT 6");
$products_array = [];
while ($row = $featured_products->fetch_assoc()) {
    $products_array[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peach & Plum | Fashion Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: #F5EDE4;
            color: #2E1F18;
            line-height: 1.6;
        }

        /* Header Styles */
        header {
            padding: 15px 0;
            background: linear-gradient(135deg, #EF8C6C 0%, #5C2D43 100%);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(239, 140, 108, 0.3);
        }

        .logo {
            font-family: "Playfair Display", serif;
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #F5EDE4;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 8px;
            font-size: 1.6rem;
            color: #F5EDE4;
        }

        .logo:hover {
            color: #F5EDE4;
            text-decoration: none;
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .navbar-nav {
            flex-direction: row !important;
            align-items: center;
            gap: 5px;
        }

        .navbar-nav .nav-link {
            color: #F5EDE4 !important;
            font-weight: 500;
            padding: 8px 15px !important;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            border-radius: 25px;
            border: 1px solid transparent;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .navbar-nav .nav-link i {
            margin-right: 6px;
            font-size: 0.85rem;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(245, 237, 228, 0.2);
            border: 1px solid rgba(245, 237, 228, 0.3);
            color: #F5EDE4 !important;
        }

        .navbar-nav .nav-link.active {
            background-color: rgba(245, 237, 228, 0.2);
            border: 1px solid rgba(245, 237, 228, 0.3);
            color: #F5EDE4 !important;
        }

        .special-btn {
            background-color: #F5EDE4 !important;
            color: #5C2D43 !important;
            border: 1px solid #F5EDE4 !important;
            font-weight: 600 !important;
        }

        .special-btn:hover {
            background-color: #F5EDE4 !important;
            border: 1px solid #F5EDE4 !important;
            color: #5C2D43 !important;
            text-decoration: none;
            opacity: 0.9;
        }

        a.special-btn.nav-link {
            color: #5C2D43 !important;
        }

        a.special-btn.nav-link:hover {
            color: #5C2D43 !important;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #EF8C6C;
            color: #F5EDE4;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        .cart-container {
            position: relative;
            display: inline-block;
        }

        .navbar-toggler {
            border: none;
            color: #F5EDE4;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            margin-top: 0;
            background: linear-gradient(
                135deg,
                rgba(239, 140, 108, 0.9) 0%,
                rgba(92, 45, 67, 0.9) 100%
            ),
            url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') center/cover no-repeat;
            background-attachment: fixed;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 70%, rgba(245, 237, 228, 0.2) 0%, transparent 50%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #F5EDE4;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-family: "Playfair Display", serif;
            font-size: 4.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
            opacity: 0;
            animation: slideInUp 1s ease 0.2s forwards;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero .subtitle {
            font-size: 1.2rem;
            margin-bottom: 15px;
            opacity: 0;
            animation: slideInUp 1s ease 0.35s forwards;
            font-weight: 300;
            letter-spacing: 2px;
            color: #F5EDE4;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 40px;
            opacity: 0;
            animation: slideInUp 1s ease 0.5s forwards;
            line-height: 1.8;
        }

        .hero-buttons {
            opacity: 0;
            animation: slideInUp 1s ease 0.7s forwards;
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Featured Section */
        .featured-section {
            padding: 80px 0;
            background: linear-gradient(45deg, #F5EDE4 0%, rgba(245, 237, 228, 0.7) 50%, #F5EDE4 100%);
            position: relative;
        }

        .featured-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #EF8C6C, #5C2D43, #EF8C6C);
        }

        .section-title {
            font-family: "Playfair Display", serif;
            font-size: 2.8rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #5C2D43;
            position: relative;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, #EF8C6C, #5C2D43);
            border-radius: 2px;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #4A2E1E;
            margin-bottom: 60px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            font-style: italic;
        }

        .promo-banner {
            background: linear-gradient(135deg, #EF8C6C, #5C2D43);
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 50px;
            text-align: center;
            color: #F5EDE4;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(92, 45, 67, 0.3);
        }

        .promo-banner::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(245, 237, 228, 0.1) 0%, transparent 70%);
            animation: rotate 30s linear infinite;
        }

        .promo-content {
            position: relative;
            z-index: 2;
        }

        .promo-badge {
            display: inline-block;
            background-color: #F5EDE4;
            color: #5C2D43;
            padding: 10px 25px;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
            box-shadow: 0 4px 15px rgba(245, 237, 228, 0.4);
        }

        .promo-title {
            font-family: "Playfair Display", serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .promo-description {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .product-card {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            text-decoration: none; /* Remove underline from the anchor tag */
            color: inherit; /* Inherit text color from parent */
            display: block; /* Make the anchor tag block-level to wrap the card */
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Add transition for hover effect */
        }

        .product-image {
            height: 300px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
        }

        .product-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(245, 237, 228, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .product-info {
            padding: 30px;
        }

        .product-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #F5EDE4, rgba(245, 237, 228, 0.9));
            color: #5C2D43;
            padding: 8px 15px;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(245, 237, 228, 0.4);
            z-index: 10; /* Ensure badge is above image swipe */
        }

        .product-title {
            font-family: "Playfair Display", serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #5C2D43;
        }

        .product-description {
            color: #4A2E1E;
            font-size: 0.95rem;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .product-price {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #5C2D43;
        }

        .old-price {
            text-decoration: line-through;
            color: #4A2E1E;
            font-size: 1.2rem;
            margin-left: 10px;
            opacity: 0.7;
        }

        .btn {
            padding: 15px 35px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            font-size: 1rem;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn i {
            margin-right: 8px;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4 !important;
            justify-content: center;
            outline: none;
            box-shadow: none;
        }

        .btn-outline {
            background-color: transparent;
            color: #F5EDE4;
            border: 2px solid #F5EDE4;
        }

        .btn-outline:hover {
            background-color: #F5EDE4;
            color: #5C2D43;
        }

        .btn-product {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4 !important;
            width: 100%;
            justify-content: center;
            outline: none;
            box-shadow: none;
        }
        
        /* Disable pointer events on the form to allow parent anchor to be clicked */
        .product-card .add-to-cart-form {
            pointer-events: none;
        }

        /* Re-enable pointer events for the button within the form */
        .product-card .add-to-cart-form button {
            pointer-events: auto;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4;
            text-align: center;
            padding: 50px 0;
            position: relative;
        }

        footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #F5EDE4, rgba(245, 237, 228, 0.7), #F5EDE4);
        }

        footer p {
            margin: 10px 0;
            font-size: 0.95em;
            letter-spacing: 0.5px;
            color: rgba(245, 237, 228, 0.9);
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        /* Scroll to top button */
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, #EF8C6C, #5C2D43);
            color: #F5EDE4;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.3rem;
            cursor: pointer;
            opacity: 0;
            box-shadow: 0 8px 25px rgba(92, 45, 67, 0.3);
            z-index: 99;
            border: none;
            transition: all 0.3s ease;
        }

        .scroll-to-top.visible {
            opacity: 1;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .navbar-nav {
                flex-direction: column !important;
                gap: 10px;
                margin-top: 15px;
            }

            .navbar-nav .nav-link {
                padding: 10px 20px !important;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 3rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .product-grid {
                grid-template-columns: 1fr;
            }

            .promo-banner {
                padding: 40px 25px;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .section-title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 2.2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .logo {
                font-size: 1.5rem;
            }
        }

        @media (min-width: 992px) {
            .navbar-nav .nav-link {
                margin-right: 5px;
            }
        }
    </style>
</head>
<body>
    <header id="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand logo" href="index.php">
                    Peach & Plum
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">
                                <i class="fas fa-users"></i>About Us
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">
                                <i class="fas fa-tshirt"></i>What We Offer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="account.php">
                                <i class="fas fa-user"></i>Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart-container" href="cart.php">
                                <i class="fas fa-shopping-bag"></i>Cart
                                <span class="cart-badge"><?= $cart_count ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn special-btn nav-link px-3" href="login.php" role="button">
                                <i class="fas fa-sign-in-alt"></i>Login
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <section class="hero" id="home">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-content">
                        <h1>Peach & Plum</h1>
                        <p>Discover your perfect style with our curated collection of trendy clothing pieces. From casual chic to elegant formal wear, we bring you the latest in contemporary fashion clothing.</p>
                        <div class="hero-buttons">
                            <a href="products.php" class="btn btn-primary">
                                <i class="fas fa-shopping-bag"></i>Shop Now
                            </a>
                            <a href="about.php" class="btn btn-outline">
                                <i class="fas fa-star"></i>Our Story
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-section">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle">Discover our handpicked clothing pieces and exclusive offers that define contemporary elegance</p>
            
            <div class="promo-banner">
                <div class="promo-content">
                    <span class="promo-badge">FLASH SALE</span>
                    <h3 class="promo-title">Up to 70% Off Summer Clothing</h3>
                    <p class="promo-description">Transform your wardrobe with our stunning summer clothing collection at unbeatable prices. Limited time only!</p>
                    <a href="products.php" class="btn btn-outline">
                        <i class="fas fa-fire"></i>Shop Sale
                    </a>
                </div>
            </div>

            <div class="product-grid">
    <?php if (!empty($products_array)): ?>
        <?php foreach ($products_array as $product): ?>
            <a href="product_detail.php?id=<?= htmlspecialchars($product['id']) ?>" class="product-card">
                <?php 
                if (isset($product['featured']) && $product['featured']): 
                ?>
                    <div class="product-badge">FEATURED</div>
                <?php endif; ?>

                <div class="product-image" style="background-image: url('<?= htmlspecialchars($product['image']) ?>');"></div>
                <div class="product-info">
                    <h3 class="product-title"><?= htmlspecialchars($product['name']) ?></h3>
                    <p class="product-description"><?= htmlspecialchars($product['description']) ?></p>
                    <div class="product-price">
                        <span class="price">₱<?= number_format($product['price'], 2) ?></span>
                    </div>
                    <form method="POST" class="add-to-cart-form">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                        <input type="hidden" name="qty" value="1">
                        <!--
                        <button type="submit" class="btn btn-product">
                            <i class="fas fa-shopping-bag"></i>Add to Cart
                        </button>
                        -->
                    </form>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center">
            <p class="text-muted">No products available at the moment.</p>
        </div>
    <?php endif; ?>
</div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 Peach & Plum Fashion Boutique. All rights reserved.</p>
            <p>Follow us on social media for the latest fashion trends and exclusive offers!</p>
            <div class="social-links mt-3">
                <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </footer>

    <!-- <button class="scroll-to-top" id="scrollToTop">
        <i class="fas fa-chevron-up"></i>
    </button>
    -->
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const scrollToTopBtn = document.getElementById('scrollToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('visible');
            } else {
                scrollToTopBtn.classList.remove('visible');
            }
        });
        
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        document.querySelectorAll('.product-card .btn-product').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); 
                e.stopPropagation(); 

                const cartBadge = document.querySelector('.cart-badge');
                let currentCount = parseInt(cartBadge.textContent);
                cartBadge.textContent = currentCount + 1;
                
                this.innerHTML = '<i class="fas fa-check"></i>Added!';
                this.style.background = 'linear-gradient(135deg, #4CAF50, #45a049)';
                
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-shopping-bag"></i>Add to Cart';
                    this.style.background = 'linear-gradient(135deg, #5C2D43, #EF8C6C)';
                }, 2000);
            });
        });
    </script>
</body>
</html>