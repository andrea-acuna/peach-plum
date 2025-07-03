<?php
session_start();

// DB connection
$conn = new mysqli("localhost", "root", "", "pp_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'] ?? null;
$session_id = session_id();

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

// Redirect if cart is empty
if ($cart_items->num_rows === 0) {
    header("Location: cart.php");
    exit;
}

// Compute totals
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

$shipping = $subtotal > 1000 ? 0 : 50; // Free shipping if subtotal > 1000
$tax = $subtotal * 0.12;
$total = $subtotal + $shipping + $tax;

// Handle form submission
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['place_order'])) {
    // Sanitize inputs
    $customer_name = trim($_POST['customer_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $postal_code = trim($_POST['postal_code']);
    $payment_method = $_POST['payment_method'] ?? '';
    $special_instructions = trim($_POST['special_instructions'] ?? '');

    // Basic validation
    if (!$customer_name) $errors[] = "Customer name is required";
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (!$phone) $errors[] = "Phone number is required";
    if (!$address) $errors[] = "Address is required";
    if (!$city) $errors[] = "City is required";
    if (!$postal_code) $errors[] = "Postal code is required";
    if (!$payment_method) $errors[] = "Payment method is required";

    if (empty($errors)) {
        // Generate unique order number
        $order_number = 'PP' . date('Ymd') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Insert order
        $insert_order = $conn->prepare("
            INSERT INTO orders (
                order_number, user_id, session_id, customer_name, email, phone,
                address, city, postal_code, payment_method, special_instructions,
                subtotal, shipping_fee, tax, total, status, created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())
        ");

        $insert_order->bind_param(
            "sisssssssssdddd",
            $order_number, $user_id, $session_id,
            $customer_name, $email, $phone,
            $address, $city, $postal_code,
            $payment_method, $special_instructions,
            $subtotal, $shipping, $tax, $total
        );

        if ($insert_order->execute()) {
            $order_id = $conn->insert_id;

            // Insert order items
            $insert_item = $conn->prepare("
                INSERT INTO order_items (order_id, product_id, quantity, price, total)
                VALUES (?, ?, ?, ?, ?)
            ");

            foreach ($cart_array as $item) {
                $insert_item->bind_param(
                    "iiidd",
                    $order_id,
                    $item['product_id'],
                    $item['quantity'],
                    $item['price'],
                    $item['item_total']
                );
                $insert_item->execute();
            }

            $insert_item->close();

            // Clear cart
            $clear_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ? OR session_id = ?");
            $clear_cart->bind_param("is", $user_id, $session_id);
            $clear_cart->execute();
            $clear_cart->close();

            // Set session success message and redirect
            $_SESSION['order_success'] = [
                'order_number' => $order_number,
                'total' => $total,
                'email' => $email
            ];

            header("Location: order-confirmation.php");
            exit;
        } else {
            $errors[] = "Failed to place order. Please try again later.";
        }

        $insert_order->close();
    }
}

// Get cart count for UI badge
$count_stmt = $conn->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ? OR session_id = ?");
$count_stmt->bind_param("is", $user_id, $session_id);
$count_stmt->execute();
$cart_count_result = $count_stmt->get_result();
$cart_count = $cart_count_result->fetch_assoc()['total'] ?? 0;

$count_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Peach & Plum</title>
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

        /* Checkout Progress */
        .checkout-progress {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 30px;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #EF8C6C;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .step-label {
            font-size: 0.9rem;
            color: #5C2D43;
            font-weight: 500;
        }

        .progress-line {
            position: absolute;
            top: 25px;
            left: 0;
            right: 0;
            height: 2px;
            background: #ddd;
            z-index: 1;
        }

        .progress-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 50%;
            background: #EF8C6C;
        }

        /* Form Sections */
        .checkout-section {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .section-header {
            background: linear-gradient(135deg, #EF8C6C, #5C2D43);
            color: #F5EDE4;
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title {
            font-family: "Playfair Display", serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .section-content {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 2px solid #f0f0f0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-control:focus {
            border-color: #EF8C6C;
            box-shadow: 0 0 0 0.2rem rgba(239, 140, 108, 0.25);
            background: white;
        }

        .form-select {
            border: 2px solid #f0f0f0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-select:focus {
            border-color: #EF8C6C;
            box-shadow: 0 0 0 0.2rem rgba(239, 140, 108, 0.25);
            background: white;
        }

        .payment-options {
            display: flex;
            flex-direction: column; /* Stack items vertically */
            gap: 10px;              /* Space between each option */
            margin-top: 15px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 15px;
            border: 2px solid #f0f0f0;
            border-radius: 10px;
            padding: 15px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .payment-option:hover {
            border-color: #EF8C6C;
            background: white;
        }

        .payment-option.selected {
            border-color: #EF8C6C;
            background: linear-gradient(135deg, rgba(239, 140, 108, 0.1), rgba(92, 45, 67, 0.1));
        }

        .payment-option input[type="radio"] {
            display: inline-block;
            accent-color: #EF8C6C;
            margin-right: 10px;
        }

        .payment-icon {
            font-size: 1.5rem;
            color: #EF8C6C;
        }

        .payment-details {
            display: flex;
            flex-direction: column;
        }

        .payment-name {
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 3px;
        }

        /* Order Summary */
        .order-summary {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 30px;
            top: 120px;
        }

        .summary-title {
            font-family: "Playfair Display", serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 20px;
            text-align: center;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .item-image-small {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
        }

        .item-info {
            flex: 1;
        }

        .item-name-small {
            font-weight: 600;
            color: #5C2D43;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .item-details-small {
            font-size: 0.8rem;
            color: #666;
        }

        .item-price-small {
            font-weight: 600;
            color: #EF8C6C;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .summary-row:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 1.2rem;
            color: #5C2D43;
            margin-top: 10px;
            padding-top: 20px;
            border-top: 2px solid #EF8C6C;
        }

        .summary-label {
            color: #666;
        }

        .summary-value {
            font-weight: 600;
            color: #5C2D43;
        }

        /* Place Order Button */
        .place-order-btn {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4;
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* Error Messages */
        .error-messages {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 20px;
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

            .order-summary {
                position: static;
                margin-top: 30px;
            }

            .payment-options {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2.5rem;
            }

            .progress-steps {
                flex-direction: column;
                gap: 20px;
            }

            .progress-line {
                display: none;
            }

            .section-content {
                padding: 20px;
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
            <div class="page-header">
                <h1 class="page-title">Checkout</h1>
                <p class="page-subtitle">Complete your order details</p>
            </div>

            <!-- Progress Steps -->
            <div class="checkout-progress">
                <div class="progress-steps">
                    <div class="progress-step">
                        <div class="step-circle">1</div>
                        <div class="step-label">Cart</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-circle">2</div>
                        <div class="step-label">Checkout</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-circle" style="background: #ddd; color: #666;">3</div>
                        <div class="step-label">Confirmation</div>
                    </div>
                    <div class="progress-line"></div>
                </div>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="error-messages">
                    <strong>Please correct the following errors:</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="checkout.php">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Customer Information -->
                        <div class="checkout-section">
                            <div class="section-header">
                                <i class="fas fa-user"></i>
                                <h3 class="section-title">Customer Information</h3>
                            </div>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="customer_name">Full Name *</label>
                                            <input type="text" class="form-control" id="customer_name" name="customer_name" 
                                                   value="<?= htmlspecialchars($_POST['customer_name'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email Address *</label>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="phone">Phone Number *</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" 
                                                   value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="checkout-section">
                            <div class="section-header">
                                <i class="fas fa-truck"></i>
                                <h3 class="section-title">Shipping Address</h3>
                            </div>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="address">Street Address *</label>
                                            <input type="text" class="form-control" id="address" name="address" 
                                                   value="<?= htmlspecialchars($_POST['address'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-label" for="city">City *</label>
                                            <input type="text" class="form-control" id="city" name="city" 
                                                   value="<?= htmlspecialchars($_POST['city'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="postal_code">Postal Code *</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code" 
                                                   value="<?= htmlspecialchars($_POST['postal_code'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="checkout-section">
                            <div class="section-header">
                                <i class="fas fa-credit-card"></i>
                                <h3 class="section-title">Payment Method</h3>
                            </div>
                            <div class="section-content">
                                <div class="payment-options">
                                    <label class="payment-option <?= ($_POST['payment_method'] ?? '') == 'credit card' ? 'selected' : '' ?>" for="credit-card">
                                        <input type="radio" id="credit-card" name="payment_method" value="credit card" 
                                               <?= ($_POST['payment_method'] ?? '') == 'credit-card' ? 'checked' : '' ?>>
                                        <div class="payment-icon">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <div class="payment-name">Credit Card</div>
                                    </label>

                                    <label class="payment-option <?= ($_POST['payment_method'] ?? '') == 'cod' ? 'selected' : '' ?>" for="cod">
                                        <input type="radio" id="cod" name="payment_method" value="cod" 
                                               <?= ($_POST['payment_method'] ?? '') == 'cod' ? 'checked' : '' ?>>
                                        <div class="payment-icon">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div class="payment-name">Cash on Delivery</div>
                                    </label>

                                    <label class="payment-option <?= ($_POST['payment_method'] ?? '') == 'gcash' ? 'selected' : '' ?>" for="gcash">
                                        <input type="radio" id="gcash" name="payment_method" value="gcash" 
                                               <?= ($_POST['payment_method'] ?? '') == 'gcash' ? 'checked' : '' ?>>
                                        <div class="payment-icon">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <div class="payment-name">GCash</div>
                                    </label>

                                    <label class="payment-option <?= ($_POST['payment_method'] ?? '') == 'bank' ? 'selected' : '' ?>" for="bank">
                                        <input type="radio" id="bank" name="payment_method" value="bank" 
                                               <?= ($_POST['payment_method'] ?? '') == 'bank' ? 'checked' : '' ?>>
                                        <div class="payment-icon">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div class="payment-name">Bank Transfer</div>
                                    </label>

                                    <label class="payment-option <?= ($_POST['payment_method'] ?? '') == 'paypal' ? 'selected' : '' ?>" for="paypal">
                                        <input type="radio" id="bank" name="payment_method" value="paypal" 
                                               <?= ($_POST['payment_method'] ?? '') == 'paypal' ? 'checked' : '' ?>>
                                        <div class="payment-icon">
                                            <i class="fa-brands fa-paypal"></i>
                                        </div>
                                        <div class="payment-name">PayPal</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Special Instructions -->
                        <div class="checkout-section">
                            <div class="section-header">
                                <i class="fas fa-sticky-note"></i>
                                <h3 class="section-title">Special Instructions</h3>
                            </div>
                            <div class="section-content">
                                <div class="form-group">
                                    <label class="form-label" for="special_instructions">Order Notes (Optional)</label>
                                    <textarea class="form-control" id="special_instructions" name="special_instructions" 
                                              rows="4" placeholder="Any special requests or delivery instructions..."><?= htmlspecialchars($_POST['special_instructions'] ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Order Summary -->
                        <div class="order-summary">
                            <h3 class="summary-title">Order Summary</h3>
                            
                            <div class="order-items">
                                <?php foreach ($cart_array as $item): ?>
                                    <div class="order-item">
                                        <div class="item-image-small" style="background-image: url('<?= htmlspecialchars($item['image']) ?>')"></div>
                                        <div class="item-info">
                                            <div class="item-name-small"><?= htmlspecialchars($item['name']) ?></div>
                                            <div class="item-details-small">Qty: <?= $item['quantity'] ?> × ₱<?= number_format($item['price'], 2) ?></div>
                                        </div>
                                        <div class="item-price-small">₱<?= number_format($item['item_total'], 2) ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="summary-totals">
                                <div class="summary-row">
                                    <span class="summary-label">Subtotal (<?= $total_items ?> items)</span>
                                    <span class="summary-value">₱<?= number_format($subtotal, 2) ?></span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Shipping Fee</span>
                                    <span class="summary-value">
                                        <?php if ($shipping == 0): ?>
                                            <span style="color: #28a745;">FREE</span>
                                        <?php else: ?>
                                            ₱<?= number_format($shipping, 2) ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Tax (VAT 12%)</span>
                                    <span class="summary-value">₱<?= number_format($tax, 2) ?></span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Total</span>
                                    <span class="summary-value">₱<?= number_format($total, 2) ?></span>
                                </div>
                            </div>

                            <button type="submit" name="place_order" class="place-order-btn">
                                <i class="fas fa-lock"></i>
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Peach & Plum. All rights reserved.</p>
            <p>Bringing you premium fashion with a touch of elegance.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Payment method selection
        document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                // Remove selected class from all options
                document.querySelectorAll('.payment-option').forEach(function(option) {
                    option.classList.remove('selected');
                });
                
                // Add selected class to the parent label of the checked radio
                if (this.checked) {
                    this.closest('.payment-option').classList.add('selected');
                }
            });
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredFields = ['customer_name', 'email', 'phone', 'address', 'city', 'postal_code'];
            let hasErrors = false;
            
            requiredFields.forEach(function(fieldName) {
                const field = document.querySelector(`[name="${fieldName}"]`);
                if (!field.value.trim()) {
                    field.style.borderColor = '#dc3545';
                    hasErrors = true;
                } else {
                    field.style.borderColor = '#f0f0f0';
                }
            });
            
            // Check if payment method is selected
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                alert('Please select a payment method.');
                hasErrors = true;
            }
            
            if (hasErrors) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });

        // Auto-format phone number
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 4) {
                    value = value.replace(/(\d{4})/, '$1');
                } else if (value.length <= 7) {
                    value = value.replace(/(\d{4})(\d{3})/, '$1-$2');
                } else {
                    value = value.replace(/(\d{4})(\d{3})(\d{4})/, '$1-$2-$3');
                }
            }
            e.target.value = value;
        });

        // Smooth scroll to errors
        <?php if (!empty($errors)): ?>
            window.scrollTo({
                top: document.querySelector('.error-messages').offsetTop - 100,
                behavior: 'smooth'
            });
        <?php endif; ?>
    </script>
</body>
</html>