<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pp_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'] ?? null;
$session_id = session_id();

if ($user_id && !isset($_SESSION['cart_merged'])) {
    $guest_cart = $conn->prepare("SELECT product_id, quantity FROM cart WHERE user_id IS NULL AND session_id = ?");
    $guest_cart->bind_param("s", $session_id);
    $guest_cart->execute();
    $result = $guest_cart->get_result();

    while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];

        $check = $conn->prepare("SELECT id FROM cart WHERE user_id = ? AND product_id = ?");
        $check->bind_param("ii", $user_id, $product_id);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $update = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
            $update->bind_param("iii", $quantity, $user_id, $product_id);
            $update->execute();
        } else {
            $insert = $conn->prepare("INSERT INTO cart (user_id, session_id, product_id, quantity) VALUES (?, ?, ?, ?)");
            $insert->bind_param("isii", $user_id, $session_id, $product_id, $quantity);
            $insert->execute();
        }
    }

    $clear = $conn->prepare("DELETE FROM cart WHERE user_id IS NULL AND session_id = ?");
    $clear->bind_param("s", $session_id);
    $clear->execute();

    $_SESSION['cart_merged'] = true;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_id"])) {
    $product_id = (int)$_POST["product_id"];
    $qty = max(1, (int)$_POST["qty"]);

    $check = $conn->prepare("SELECT id FROM cart WHERE (user_id = ? OR (user_id IS NULL AND session_id = ?)) AND product_id = ?");
    $check->bind_param("isi", $user_id, $session_id, $product_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $update = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE (user_id = ? OR (user_id IS NULL AND session_id = ?)) AND product_id = ?");
        $update->bind_param("iisi", $qty, $user_id, $session_id, $product_id);
        $update->execute();
    } else {
        $insert = $conn->prepare("INSERT INTO cart (user_id, session_id, product_id, quantity) VALUES (?, ?, ?, ?)");
        $insert->bind_param("isii", $user_id, $session_id, $product_id, $qty);
        $insert->execute();
    }

    if (isset($_POST['ajax'])) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Item added to cart!']);
        exit;
    }
}

$cart_stmt = $conn->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ? OR (user_id IS NULL AND session_id = ?)");
$cart_stmt->bind_param("is", $user_id, $session_id);
$cart_stmt->execute();
$cart_count = $cart_stmt->get_result()->fetch_assoc()['total'] ?? 0;

$order = "ORDER BY date_added DESC";
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'price-low':
            $order = "ORDER BY price ASC";
            break;
        case 'price-high':
            $order = "ORDER BY price DESC";
            break;
        case 'recommended':
            $order = "ORDER BY recommended DESC";
            break;
        case 'name':
            $order = "ORDER BY name ASC";
            break;
        default:
            $order = "ORDER BY date_added DESC";
            break;
    }
}

$products = $conn->query("SELECT * FROM products $order");
$products_array = [];
while ($row = $products->fetch_assoc()) {
    $products_array[] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What We Offer | Peach & Plum</title>
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

        /* Sort Controls */
        .sort-section {
            background: linear-gradient(135deg, #EF8C6C, #5C2D43);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 40px;
            color: #F5EDE4;
        }

        .sort-controls {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .sort-label {
            font-weight: 600;
            font-size: 1.1rem;
            white-space: nowrap;
        }

        .sort-select {
            background-color: #F5EDE4;
            color: #5C2D43;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            min-width: 200px;
        }

        .sort-select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(245, 237, 228, 0.3);
        }

        .products-count {
            margin-left: auto;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .product-card {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
            text-decoration: none;
            color: inherit;
        }

        .product-image {
            height: 280px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
        }

        .product-info {
            padding: 25px;
        }

        .product-title {
            font-family: "Playfair Display", serif;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #5C2D43;
        }

        .product-price {
            font-size: 1.6rem;
            font-weight: 700;
            color: #5C2D43;
            margin-bottom: 15px;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .rating-stars {
            display: flex;
            gap: 2px;
        }

        .star {
            color: #ddd;
            font-size: 0.9rem;
        }

        .star.filled {
            color: #EF8C6C;
        }

        .rating-text {
            font-size: 0.85rem;
            color: #666;
            font-weight: 500;
        }

        .quantity-cart-section {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .quantity-input {
            width: 70px;
            padding: 8px 10px;
            border: 2px solid #EF8C6C;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            background-color: #F5EDE4;
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

        /* Footer */
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

            .sort-controls {
                justify-content: center;
                text-align: center;
            }

            .products-count {
                margin-left: 0;
                margin-top: 10px;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2.5rem;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
            }

            .sort-section {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 2rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
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
                            <a class="nav-link active" href="products.php">
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

    <main class="main-content" id="productsListingPage">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">What We Offer</h1>
                <p class="page-subtitle">Discover our curated collection of women's fashion pieces designed to make you feel confident and beautiful</p>
            </div>

            <div class="sort-section">
                <div class="sort-controls">
                    <span class="sort-label">
                        <i class="fas fa-sort"></i>
                        Sort by:
                    </span>
                    <select class="sort-select" id="sortSelect" onchange="sortProducts()">
                        <option value="newest" <?= (!isset($_GET['sort']) || $_GET['sort'] == 'newest') ? 'selected' : '' ?>>Newest Arrivals</option>
                        <option value="price-low" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price-low') ? 'selected' : '' ?>>Price: Low to High</option>
                        <option value="price-high" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price-high') ? 'selected' : '' ?>>Price: High to Low</option>
                        <option value="recommended" <?= (isset($_GET['sort']) && $_GET['sort'] == 'recommended') ? 'selected' : '' ?>>Most Recommended</option>
                        <option value="name" <?= (isset($_GET['sort']) && $_GET['sort'] == 'name') ? 'selected' : '' ?>>Name: A to Z</option>
                    </select>
                    <div class="products-count">
                        <?= count($products_array) ?> products found
                    </div>
                </div>
            </div>

            <div class="products-grid" id="productsGrid">
                <?php foreach($products_array as $product): ?>
                <a href="product_detail.php?id=<?= $product['id'] ?>" class="product-card">
                    <div class="product-image" style="background-image: url('<?= htmlspecialchars($product['image']) ?>')">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?= htmlspecialchars($product['name']) ?></h3>
                        <div class="product-price">₱<?= number_format($product['price'], 2) ?></div>

                        <div class="product-rating">
                            <div class="rating-stars">
                                <?php
                                $rating = $product['recommended'] ?? 0;
                                $stars = round($rating / 20); // Convert 0-100 to 0-5 stars
                                for($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star star <?= $i <= $stars ? 'filled' : '' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-text"><?= $rating ?>/100</span>
                        </div>

                        <p class="product-date-added">Added: <?= date('M d, Y', strtotime($product['date_added'])) ?></p>

                        <div class="quantity-cart-section">
                            <input type="number" class="quantity-input" value="1" min="1" max="99" id="qty-<?= $product['id'] ?>" onclick="event.preventDefault(); event.stopPropagation();">
                            <button class="btn-add-cart" onclick="event.preventDefault(); event.stopPropagation(); addToCart(<?= $product['id'] ?>)">
                                <i class="fas fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
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
        function sortProducts() {
            const sortValue = document.getElementById('sortSelect').value;
            window.location.href = '?sort=' + sortValue;
        }

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