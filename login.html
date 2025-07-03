<?php
session_start();

$alertMessage = "";

$conn = new mysqli("localhost", "root", "", "pp_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputUsername = trim($_POST['username']);
    $inputPassword = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($inputPassword, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            header("Location: account.php");
            exit;
        }
    }

    $alertMessage = "<div class='alert alert-danger mt-3' role='alert'>Invalid username or password.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peach & Plum | Log In</title>
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

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 50px;
            backdrop-filter: blur(10px);
            max-width: 600px;
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

        .alert {
            margin-bottom: 25px;
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            font-weight: 500;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
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
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #f8f9fa;
            width: 100%;
        }

        .form-control:focus {
            border-color: #EF8C6C;
            box-shadow: 0 0 0 0.2rem rgba(239, 140, 108, 0.25);
            background-color: white;
            outline: none;
        }

        .password-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            z-index: 5;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: #EF8C6C;
        }

        .btn-login {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: white !important;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            width: 100%;
            margin-top: 20px;
        }

        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            color: #EF8C6C;
            text-decoration: underline;
        }

        .form-links {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .form-links a {
            color: #EF8C6C;
            text-decoration: none;
            font-weight: 600;
        }

        .form-links a:hover {
            text-decoration: underline;
        }

        .required {
            color: #e74c3c;
        }

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
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2.5rem;
            }

            .login-container {
                padding: 30px 20px;
                margin: 0 15px;
            }

            .btn-login {
                padding: 12px 30px;
                font-size: 1rem;
            }

            .form-control {
                padding: 12px 15px;
            }

            .logo {
                font-size: 1.5rem;
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

            .login-container {
                margin: 0 5px;
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
                                <span class="cart-badge">0</span>
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
                <h1 class="page-title">Welcome Back</h1>
                <p class="page-subtitle">Log in to your account</p>
            </div>

            <div class="login-container">

                <form action="" method="POST" id="loginForm">

                    <?php if (!empty($alertMessage)) echo $alertMessage; ?>

                    <div class="form-group">
                        <label for="username" class="form-label">Username <span class="required">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password <span class="required">*</span></label>
                        <div class="password-input-wrapper">
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                            <span class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login" id="loginButton">Log In</button>

                    <div class="form-links">
                        <p>Don't have an account? <a href="register.php">Register</a></p>
                    </div>
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

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = document.getElementById(id + "-eye");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>