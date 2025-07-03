<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pp_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'] ?? null;
$session_id = session_id();

// Handle cart actions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $cart_id = (int)$_POST['cart_id'];
        
        switch ($action) {
            case 'update':
                $quantity = max(1, (int)$_POST['quantity']);
                $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND (user_id = ? OR session_id = ?)");
                $update->bind_param("iiis", $quantity, $cart_id, $user_id, $session_id);
                $update->execute();
                break;
                
            case 'remove':
                $remove = $conn->prepare("DELETE FROM cart WHERE id = ? AND (user_id = ? OR session_id = ?)");
                $remove->bind_param("iis", $cart_id, $user_id, $session_id);
                $remove->execute();
                break;
                
            case 'clear':
                // This case is no longer needed if the button is removed, but keeping for backend logic in case
                $clear = $conn->prepare("DELETE FROM cart WHERE user_id = ? OR session_id = ?");
                $clear->bind_param("is", $user_id, $session_id);
                $clear->execute();
                break;
        }
        
        // Return JSON response for AJAX
        if (isset($_POST['ajax'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Cart updated successfully!']);
            exit;
        }
        
        // Redirect to prevent form resubmission
        header("Location: cart.php");
        exit;
    }
}

// Get cart items with product details
$cart_query = "
    SELECT c.*, p.name, p.price, p.image 
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ? OR c.session_id = ?
    ORDER BY c.id DESC
";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param("is", $user_id, $session_id);
$stmt->execute();
$cart_items = $stmt->get_result();

// Calculate totals
$subtotal = 0;
$total_items = 0;
$cart_array = [];

while ($item = $cart_items->fetch_assoc()) {
    $item_total = $item['price'] * $item['quantity'];
    $subtotal += $item_total;
    $total_items += $item['quantity'];
    $item['item_total'] = $item_total;
    $cart_array[] = $item;
}

$shipping = $subtotal > 1000 ? 0 : 50; // Free shipping over ₱1000
$tax = $subtotal * 0.12; // 12% VAT
$total = $subtotal + $shipping + $tax;

// Get cart count for badge
$count_stmt = $conn->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ? OR session_id = ?");
$count_stmt->bind_param("is", $user_id, $session_id);
$count_stmt->execute();
$cart_count = $count_stmt->get_result()->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Peach & Plum</title>
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
            min-height: calc(100vh - 90px);
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

        /* Cart Styles */
        .cart-section {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .cart-header {
            background: linear-gradient(135deg, #EF8C6C, #5C2D43);
            color: #F5EDE4;
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-title {
            font-family: "Playfair Display", serif;
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
        }

        .cart-count {
            background: rgba(245, 237, 228, 0.2);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .cart-item {
            padding: 25px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-family: "Playfair Display", serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 8px;
        }

        .item-price {
            font-size: 1.1rem;
            font-weight: 600;
            color: #EF8C6C;
            margin-bottom: 10px;
        }

        .item-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #F5EDE4;
            border-radius: 25px;
            padding: 5px;
        }

        .qty-btn {
            background: #EF8C6C;
            color: #F5EDE4;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .qty-btn:hover {
            background: #5C2D43;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
            color: #5C2D43;
        }

        .qty-input:focus {
            outline: none;
        }

        .item-total {
            font-size: 1.2rem;
            font-weight: 700;
            color: #5C2D43;
            margin-right: 20px;
        }

        .remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: #c82333;
        }

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            color: #666;
        }

        .empty-cart i {
            font-size: 4rem;
            color: #EF8C6C;
            margin-bottom: 20px;
        }

        .empty-cart h3 {
            font-family: "Playfair Display", serif;
            font-size: 2rem;
            color: #5C2D43;
            margin-bottom: 15px;
        }

        .empty-cart p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .overall-total-section {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-top: 30px; /* Add margin to separate from items */
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .overall-total-label {
            font-family: "Playfair Display", serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #5C2D43;
        }

        .overall-total-value {
            font-family: "Playfair Display", serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #EF8C6C;
        }

        .cart-summary-buttons {
            display: flex;
            flex-direction: flex-end;
            gap: 15px; 
            width: 100%;
            margin-top: 20px;
        }

        .checkout-btn, .continue-shopping-btn {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4;
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .continue-shopping-btn {
            background: transparent;
            color: #EF8C6C;
            border: 2px solid #EF8C6C;
        }

        .continue-shopping-btn:hover {
            background: #EF8C6C;
            color: #F5EDE4;
            text-decoration: none;
        }

        /* Toast Notification */
        .toast-container {
            position: fixed;
            top: 100px;
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

        /* Animations */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        /* Responsive */
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

            .cart-item {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .item-image {
                width: 80px;
                height: 80px;
            }

            .item-controls {
                justify-content: center;
            }

            /* Removed .cart-actions styles as requested */

            .overall-total-section {
                flex-direction: column;
                gap: 15px;
            }

            .cart-summary-buttons {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 2rem;
            }

            .logo {
                font-size: 1.5rem;
            }

            .cart-item {
                padding: 20px;
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
                            <a class="nav-link cart-container active" href="cart.php">
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
                <h1 class="page-title">Shopping Cart</h1>
                <p class="page-subtitle">Review your items and proceed to checkout</p>
            </div>

            <div class="row">
                <div class="col-lg-12"> <div class="cart-section">
                        <div class="cart-header">
                            <h2 class="cart-title">Your Items</h2>
                            <div class="cart-count"><?= $total_items ?> item<?= $total_items != 1 ? 's' : '' ?></div>
                        </div>

                        <?php if (empty($cart_array)): ?>
                            <div class="empty-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <h3>Your cart is empty</h3>
                                <p>Looks like you haven't added any items to your cart yet.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($cart_array as $item): ?>
                                <div class="cart-item" data-cart-id="<?= $item['id'] ?>">
                                    <div class="item-image" style="background-image: url('<?= htmlspecialchars($item['image']) ?>')"></div>
                                    
                                    <div class="item-details">
                                        <h4 class="item-name"><?= htmlspecialchars($item['name']) ?></h4>
                                        <div class="item-price">₱<?= number_format($item['price'], 2) ?></div>
                                        
                                        <div class="item-controls">
                                            <div class="quantity-controls">
                                                <button class="qty-btn" type="button" onclick="updateQuantity(<?= $item['id'] ?>, -1)">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" class="qty-input" value="<?= $item['quantity'] ?>" 
                                                    min="1" max="99" id="qty-<?= $item['id'] ?>" 
                                                    onchange="updateQuantity(<?= $item['id'] ?>, 0)">
                                                <button class="qty-btn" type="button" onclick="updateQuantity(<?= $item['id'] ?>, 1)">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            
                                            <div class="item-total">₱<?= number_format($item['item_total'], 2) ?></div>
                                            
                                            <button class="remove-btn" type="button" onclick="removeItem(<?= $item['id'] ?>)" 
                                                    title="Remove item">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="overall-total-section">
                                <div class="overall-total-label">Total Amount</div>
                                <div class="overall-total-value">₱<?= number_format($subtotal, 2) ?></div>
                                <div class="cart-summary-buttons">
                                    <a href="products.php" class="continue-shopping-btn">
                                        <i class="fas fa-shopping-bag"></i> Continue Shopping
                                    </a>
                                    <button class="checkout-btn" type="button" onclick="proceedToCheckout()">
                                        <i class="fas fa-credit-card"></i>
                                        Proceed to Checkout
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
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
                Cart updated successfully!
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
        function updateQuantity(cartId, change) {
            const qtyInput = document.getElementById('qty-' + cartId);
            let newQuantity = parseInt(qtyInput.value);
            
            if (change !== 0) {
                newQuantity += change;
            }
            
            if (newQuantity < 1) {
                newQuantity = 1;
            } else if (newQuantity > 99) {
                newQuantity = 99;
            }
            
            qtyInput.value = newQuantity;
            
            // Send AJAX request to update quantity
            const formData = new FormData();
            formData.append('action', 'update');
            formData.append('cart_id', cartId);
            formData.append('quantity', newQuantity);
            formData.append('ajax', '1');
            
            fetch('cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload page to update totals
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error updating quantity. Please try again.');
            });
        }

        function removeItem(cartId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                const formData = new FormData();
                formData.append('action', 'remove');
                formData.append('cart_id', cartId);
                formData.append('ajax', '1');
                
                fetch('cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove item from DOM or reload page
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error removing item. Please try again.');
                });
            }
        }

        // Removed the clearCart function as its button is removed.
        /*
        function clearCart() {
            if (confirm('Are you sure you want to clear your entire cart? This action cannot be undone.')) {
                const formData = new FormData();
                formData.append('action', 'clear');
                formData.append('ajax', '1');
                
                fetch('cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error clearing cart. Please try again.');
                });
            }
        }
        */

        function proceedToCheckout() {
            window.location.href = 'checkout.php';
        }

        function showToast(message) {
            const toastBody = document.querySelector('#cartToast .toast-body');
            toastBody.textContent = message;
            const toast = new bootstrap.Toast(document.getElementById('cartToast'));
            toast.show();
        }

        // Update cart badge on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Any initialization code can go here
        });
    </script>
</body>
</html>