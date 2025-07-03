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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Peach & Plum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

        .main-content {
            margin-top: 90px;
            padding: 60px 0;
        }

        .page-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .page-title {
            font-family: "Playfair Display", serif;
            font-size: 3rem;
            font-weight: 700;
            color: #5C2D43;
            margin-bottom: 15px;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: #4A2E1E;
            max-width: 600px;
            margin: 0 auto;
            font-style: italic;
        }

        .about-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 50px;
            backdrop-filter: blur(10px);
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
        }

        .section-title {
            font-family: "Playfair Display", serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #5C2D43;
            margin: 30px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #EF8C6C;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
            color: #5C2D43;
        }

        .section-title:first-child {
            margin-top: 0;
        }

        .section-content {
            color: #4A2E1E;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 20px;
            text-align: justify;
        }

        .contact-info {
            background: rgba(245, 237, 228, 0.3);
            border-radius: 15px;
            padding: 25px;
            margin: 20px 0;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: #4A2E1E;
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-item i {
            color: #EF8C6C;
            font-size: 1.2rem;
            width: 25px;
            margin-right: 15px;
        }

        .contact-item a {
            color: #4A2E1E;
            text-decoration: none;
        }

        .contact-item a:hover {
            color: #5C2D43;
            text-decoration: underline;
        }

        .contact-form {
            margin-top: 25px;
        }

        .contact-form .form-label {
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 8px;
        }

        .contact-form .form-control {
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #f8f9fa;
        }

        .contact-form .form-control:focus {
            border-color: #EF8C6C;
            box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
            background-color: white;
            outline: none;
        }

        .btn-custom {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: white !important;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .ceo-section {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 0px;
            flex-wrap: wrap;
        }

        .ceo-card {
            text-align: center;
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            width: 250px;
            flex-shrink: 0;
        }

        .ceo-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 4px solid #EF8C6C;
            box-shadow: 0 0 0 8px rgba(239, 140, 108, 0.2);
        }

        .ceo-card h3 {
            font-family: "Playfair Display", serif;
            font-size: 1.3rem;
            color: #5C2D43;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .ceo-card p {
            font-size: 0.9rem;
            color: #4A2E1E;
            margin-bottom: 0;
        }

        footer {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4;
            text-align: center;
            padding: 50px 0;
            position: relative;
            margin-top: 80px;
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

        /* Responsive Design */
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
            .page-title {
                font-size: 2.5rem;
            }

            .about-container {
                padding: 30px 20px;
                margin: 0 15px;
            }

            .btn-custom {
                padding: 12px 30px;
                font-size: 1rem;
                width: 100%;
                max-width: 250px;
                justify-content: center;
            }

            .logo {
                font-size: 1.5rem;
            }

            .section-content {
                text-align: left;
            }

            .ceo-section {
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 2rem;
            }

            .page-subtitle {
                font-size: 0.95rem;
            }

            .navbar-brand.logo {
                font-size: 1.4rem;
            }

            .navbar-nav .nav-link {
                margin-right: 0;
                margin-bottom: 10px;
                text-align: center;
            }

            .about-container {
                margin: 0 5px;
            }

            .ceo-card {
                width: 100%;
                max-width: 280px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 2rem;
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
                <a class="navbar-brand logo" href="#">
                    Peach & Plum
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="about.php">
                                <i class="fas fa-users"></i>About Us
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php"> <i class="fas fa-tshirt"></i>What We Offer
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

    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">About Peach & Plum</h1>
                <p class="page-subtitle">Your trusted source for timeless fashion and exceptional service</p>
            </div>

            <div class="about-container">
                <div class="section-title">
                    <i class="fas fa-users"></i> Meet Our CEOs
                </div>
                <div class="ceo-section">
                    <div class="ceo-card">
                        <img src="andrea.jpeg" alt="CEO 1">
                        <h3>Andrea Acuña</h3>
                        <p>Co-Founder & CEO</p>
                    </div>
                    <div class="ceo-card">
                        <img src="kim.jpg" alt="CEO 2">
                        <h3>Kim Advincula</h3>
                        <p>Co-Founder & Creative Director</p>
                    </div>
                </div>

                <div class="section-title">
                    <i class="fas fa-heart"></i> Who We Are
                </div>
                <div class="section-content">
                    At Peach & Plum, we believe in empowering women through beautiful and comfortable fashion. Since 2023, we've curated high-quality, chic apparel that blends timeless elegance with modern trends. Our mission is simple: to help you look and feel fantastic, every single day.
                </div>

                <div class="section-title">
                    <i class="fas fa-star"></i> Our Mission
                </div>
                <div class="section-content">
                    We are dedicated to providing exceptional fashion experiences that celebrate individuality and confidence. Our carefully selected collection features pieces that transition seamlessly from day to night, work to weekend, ensuring you always have the perfect outfit for any occasion.
                </div>

                <div class="section-title">
                    <i class="fas fa-gem"></i> Why Choose Us
                </div>
                <div class="section-content">
                    Quality is at the heart of everything we do. We partner with trusted suppliers to bring you durable, comfortable, and stylish pieces that stand the test of time. Our team is passionate about fashion and committed to helping you discover your unique style through personalized service and expert advice.
                </div>

                <div class="section-title">
                    <i class="fas fa-phone"></i> Get In Touch
                </div>
                <div class="section-content">
                    Have questions or need help? Our friendly team is here for you!
                </div>
                
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>Email: <a href="mailto:info@peachandplum.com">info@peachandplum.com</a></span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>Phone: <a href="tel:+639123456789">+63 912 345 6789</a></span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Address: 123 Fashion Ave, Metro Manila, Philippines</span>
                    </div>
                </div>

                <div class="section-title">
                    <i class="fas fa-paper-plane"></i> Send Us a Message
                </div>
                
                <form class="contact-form" action="#" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn-custom">
                        <i class="fas fa-paper-plane"></i>Send Message
                    </button>
                </form>
            </div>
        </div>
    </main>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>