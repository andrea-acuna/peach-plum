<?php
session_start();

if (!isset($_SESSION['order_success'])) {
    header("Location: index.php");
    exit;
}

$order_data = $_SESSION['order_success'];
$order_number = $order_data['order_number'];
$total = $order_data['total'];
$email = $order_data['email'];

unset($_SESSION['order_success']);

$conn = new mysqli("localhost", "root", "", "pp_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$order_query = "
    SELECT o.*,
           DATE_FORMAT(o.created_at, '%M %d, %Y at %h:%i %p') as formatted_date
    FROM orders o
    WHERE o.order_number = ?
";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("s", $order_number);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();

if (!$order) {
    header("Location: index.php");
    exit;
}

$items_query = "
    SELECT oi.*, p.name, p.image
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
    ORDER BY oi.id
";
$items_stmt = $conn->prepare($items_query);
$items_stmt->bind_param("i", $order['id']);
$items_stmt->execute();
$order_items = $items_stmt->get_result();

$items_array = [];
$total_items = 0;
while ($item = $order_items->fetch_assoc()) {
    $items_array[] = $item;
    $total_items += $item['quantity'];
}

$stmt->close();
$items_stmt->close();

$user_id = $_SESSION['user_id'] ?? null;
$session_id = session_id();

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
    <title>Order Confirmed | Peach & Plum</title>
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
        }

        .logo:hover {
            color: #F5EDE4;
            text-decoration: none;
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

        .main-content {
            margin-top: 90px;
            padding: 40px 0;
            min-height: calc(100vh - 90px);
        }

        .success-banner {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            text-align: center;
            padding: 40px 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }

        .success-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
        }

        .success-title {
            font-family: "Playfair Display", serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .order-number {
            font-size: 1.3rem;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 15px;
            display: inline-block;
            margin-top: 15px;
            letter-spacing: 1px;
        }

        .order-card {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 30px;
        }

        .card-title {
            font-family: "Playfair Display", serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .order-summary {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .summary-item:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 1.2rem;
            color: #5C2D43;
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid #EF8C6C;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 5px;
        }

        .item-meta {
            color: #666;
            font-size: 0.9rem;
        }

        .item-price {
            font-weight: 700;
            color: #EF8C6C;
            font-size: 1.1rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            border-left: 4px solid #EF8C6C;
        }

        .info-title {
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-content {
            color: #666;
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4;
            border: none;
            border-radius: 25px;
            padding: 12px 25px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            flex: 1;
            justify-content: center;
            min-width: 200px;
        }

        .btn-outline-custom {
            background: transparent;
            color: #5C2D43;
            border: 2px solid #5C2D43;
            border-radius: 25px;
            padding: 12px 25px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            flex: 1;
            justify-content: center;
            min-width: 200px;
        }

        .btn-outline-custom:hover {
            background: #5C2D43;
            color: #F5EDE4;
            text-decoration: none;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: #F5EDE4;
            text-align: center;
            padding: 30px 0;
            margin-top: 50px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .success-title {
                font-size: 1.8rem;
            }

            .success-icon {
                font-size: 3rem;
            }

            .order-number {
                font-size: 1.1rem;
            }

            .order-card {
                padding: 20px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-primary-custom,
            .btn-outline-custom {
                min-width: auto;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .order-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .item-image {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>
<body class="order-confirmed">
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
            <div class="success-banner">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h1 class="success-title">Order Confirmed!</h1>
                <p>Thank you for your purchase. Your order has been successfully placed.</p>
                <div class="order-number">Order #<?= htmlspecialchars($order_number) ?></div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="order-card">
                        <h3 class="card-title">
                            <i class="fas fa-box-open"></i>
                            Your Order (<?= $total_items ?> items)
                        </h3>

                        <?php foreach ($items_array as $item): ?>
                            <div class="order-item">
                                <div class="item-image" style="background-image: url('<?= htmlspecialchars($item['image']) ?>')"></div>
                                <div class="item-details">
                                    <div class="item-name"><?= htmlspecialchars($item['name']) ?></div>
                                    <div class="item-meta">Qty: <?= $item['quantity'] ?> × ₱<?= number_format($item['price'], 2) ?></div>
                                </div>
                                <div class="item-price">₱<?= number_format($item['total'], 2) ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="order-card">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle"></i>
                            Order Details
                        </h3>

                        <div class="info-grid">
                            <div class="info-box">
                                <div class="info-title">
                                    <i class="fas fa-shipping-fast"></i>
                                    Shipping Address
                                </div>
                                <div class="info-content">
                                    <strong><?= htmlspecialchars($order['customer_name']) ?></strong><br>
                                    <?= htmlspecialchars($order['address']) ?><br>
                                    <?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['postal_code']) ?><br>
                                    <i class="fas fa-phone"></i> <?= htmlspecialchars($order['phone']) ?>
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-title">
                                    <i class="fas fa-credit-card"></i>
                                    Payment & Delivery
                                </div>
                                <div class="info-content">
                                    <strong>Payment:</strong>
                                    <?php
                                    $payment_methods = [
                                        'cod' => 'Cash on Delivery',
                                        'gcash' => 'GCash',
                                        'bank' => 'Bank Transfer'
                                    ];
                                    echo $payment_methods[$order['payment_method']] ?? htmlspecialchars($order['payment_method']);
                                    ?><br>
                                    <strong>Order Date:</strong> <?= htmlspecialchars($order['formatted_date']) ?><br>
                                    <strong>Status:</strong> <span style="color: #ffc107;">Processing</span>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($order['special_instructions'])): ?>
                            <div class="info-box" style="margin-top: 20px;">
                                <div class="info-title">
                                    <i class="fas fa-sticky-note"></i>
                                    Special Instructions
                                </div>
                                <div class="info-content">
                                    <?= nl2br(htmlspecialchars($order['special_instructions'])) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="order-card">
                        <h3 class="card-title">
                            <i class="fas fa-receipt"></i>
                            Order Summary
                        </h3>

                        <div class="order-summary">
                            <div class="summary-item">
                                <span>Subtotal</span>
                                <span>₱<?= number_format($order['subtotal'], 2) ?></span>
                            </div>
                            <div class="summary-item">
                                <span>Shipping</span>
                                <span>
                                    <?php if ($order['shipping_fee'] == 0): ?>
                                        <span style="color: #28a745;">FREE</span>
                                    <?php else: ?>
                                        ₱<?= number_format($order['shipping_fee'], 2) ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="summary-item">
                                <span>Tax</span>
                                <span>₱<?= number_format($order['tax'], 2) ?></span>
                            </div>
                            <div class="summary-item">
                                <span>Total</span>
                                <span>₱<?= number_format($order['total'], 2) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Peach & Plum. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>