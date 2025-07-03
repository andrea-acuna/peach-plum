<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pp_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'] ?? null;
$session_id = session_id();

// Get product ID from URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id <= 0) {
    header("Location: products.php");
    exit;
}

// Handle Add to Cart
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_id"])) {
    $product_id_post = (int)$_POST["product_id"];
    $qty = max(1, (int)$_POST["qty"]);
    
    $check = $conn->prepare("SELECT id FROM cart WHERE (user_id = ? OR session_id = ?) AND product_id = ?");
    $check->bind_param("isi", $user_id, $session_id, $product_id_post);
    $check->execute();
    $check->store_result();
    
    if ($check->num_rows > 0) {
        $update = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE (user_id = ? OR session_id = ?) AND product_id = ?");
        $update->bind_param("iisi", $qty, $user_id, $session_id, $product_id_post);
        $update->execute();
    } else {
        $insert = $conn->prepare("INSERT INTO cart (user_id, session_id, product_id, quantity) VALUES (?, ?, ?, ?)");
        $insert->bind_param("isii", $user_id, $session_id, $product_id_post, $qty);
        $insert->execute();
    }
    
    // Return JSON response for AJAX
    if (isset($_POST['ajax'])) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Item added to cart!']);
        exit;
    }
}

// Get cart count
$stmt = $conn->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ? OR session_id = ?");
$stmt->bind_param("is", $user_id, $session_id);
$stmt->execute();
$cart_count = $stmt->get_result()->fetch_assoc()['total'] ?? 0;

// Get product details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    header("Location: products.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> | Peach & Plum</title>
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

        /* Main Content */
        .main-content {
            margin-top: 90px;
            padding: 40px 0;
        }

        /* Back to Products Button at the top */
        .top-back-button {
            margin-bottom: 30px;
            text-align: left;
        }

        .top-back-button .btn {
            background-color: #5C2D43;
            color: #F5EDE4;
            border: 2px solid #5C2D43;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .top-back-button .btn:hover {
            background-color: #EF8C6C;
            border-color: #EF8C6C;
        }

        .product-detail {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 50px;
            display: flex;
            flex-direction: row;
            align-items: stretch;
        }

        .product-image-container {
            width: 50%;
            min-height: 550px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            padding: 20px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .product-img { /* This rule is no longer strictly needed if using background-image */
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .product-info {
            padding: 40px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-title {
            font-family: "Playfair Display", serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #5C2D43;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 2.2rem;
            font-weight: 700;
            color: #EF8C6C;
            margin-bottom: 20px;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
            padding: 15px;
            background: #F5EDE4;
            border-radius: 15px;
        }

        .rating-stars {
            display: flex;
            gap: 3px;
        }

        .star {
            color: #ddd;
            font-size: 1.2rem;
        }

        .star.filled {
            color: #EF8C6C;
        }

        .rating-text {
            font-size: 1rem;
            color: #5C2D43;
            font-weight: 600;
        }

        .product-description {
            background: #F9F9F9;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border-left: 5px solid #EF8C6C;
        }

        .description-title {
            font-family: "Playfair Display", serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 15px;
        }

        .description-text {
            color: #4A2E1E;
            line-height: 1.8;
            font-size: 1rem;
        }

        /* Removed .product-details styles as the section is removed */
        /* .product-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            background: #F5EDE4;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }

        .detail-icon {
            font-size: 1.8rem;
            color: #EF8C6C;
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 5px;
        }

        .detail-value {
            color: #4A2E1E;
            font-size: 0.95rem;
        } */

        /* Updated quantity and cart section to match products page */
        .quantity-cart-section {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: auto; /* Ensures it pushes to the bottom of the info box */
        }

        .quantity-input {
            width: 70px;
            padding: 8px 10px;
            border: 2px solid #EF8C6C;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            background-color: #F5EDE4;
            color: #5C2D43;
        }

        .quantity-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(239, 140, 108, 0.2);
        }

        .btn-add-cart {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 600;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-add-cart:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
        }

        .toast {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4;
            border: none;
            border-radius: 15px;
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

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

            .product-detail {
                flex-direction: column;
            }

            .product-image-container,
            .product-info {
                width: 100%;
            }

            .product-image-container {
                height: 350px;
                min-height: unset;
            }
        }

        @media (max-width: 768px) {
            .product-info {
                padding: 25px;
            }

            .product-title {
                font-size: 2rem;
            }

            .product-price {
                font-size: 1.8rem;
            }

            .product-image-container {
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            .product-title {
                font-size: 1.8rem;
            }

            .product-price {
                font-size: 1.6rem;
            }

            .product-image-container {
                height: 250px;
            }

            .logo {
                font-size: 1.5rem;
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
                            <a class="nav-link" href="index.php">
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

    <main class="main-content">
        <div class="container">
            <div class="top-back-button">
                <a href="products.php" class="btn">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>

            <div class="product-detail">
                <div class="product-image-container" style="background-image: url('<?= htmlspecialchars($product['image']) ?>')"></div>
                
                <div class="product-info">
                    <div>
                        <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
                        <div class="product-price">₱<?= number_format($product['price'], 2) ?></div>
                        
                        <p class="product-date-added">Added: <?= date('M d, Y', strtotime($product['date_added'])) ?></p>

                        <div class="product-rating">
                            <div class="rating-stars">
                                <?php
                                $rating = $product['recommended'] ?? 0;
                                $stars = round($rating / 20); // Convert 0-100 to 0-5 stars
                                for($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star star <?= $i <= $stars ? 'filled' : '' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-text">Rated <?= $rating ?>/100</span>
                        </div>

                        <?php if (!empty($product['description'])): ?>
                        <div class="product-description">
                            <h3 class="description-title">
                                Product Description
                            </h3>
                            <p class="description-text"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                        </div>
                        <?php endif; ?>

                        </div>
                    
                    <div class="quantity-cart-section">
                        <input type="number" class="quantity-input" value="1" min="1" max="99" id="qty-<?= $product['id'] ?>">
                        <button class="btn-add-cart" onclick="addToCart(<?= $product['id'] ?>)">
                            <i class="fas fa-shopping-cart"></i>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="toast-container">
        <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-shopping-cart me-2"></i>
                <strong class="me-auto">Cart Updated</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                Item added to cart successfully!
            </div>
        </div>
    </div>

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
    
    <script>
        function addToCart(productId) {
            const qtyInput = document.getElementById('qty-' + productId);
            const quantity = qtyInput.value;
            const button = event.target;
            
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('qty', quantity);
            formData.append('ajax', '1');
            
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    updateCartBadge();
                    
                    const toast = new bootstrap.Toast(document.getElementById('cartToast'));
                    toast.show();
                    
                    qtyInput.value = 1;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error adding item to cart. Please try again.');
            })
            .finally(() => {

                button.disabled = false;
                button.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
            });
        }

        function updateCartBadge() {
            fetch('get_cart_count.php')
            .then(response => response.json())
            .then(data => {
                document.querySelector('.cart-badge').textContent = data.count;
            })
            .catch(error => {
                console.error('Error updating cart badge:', error);
            });
        }
    </script>
</body>
</html>