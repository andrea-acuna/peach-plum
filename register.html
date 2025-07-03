<?php
session_start();

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "pp_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$full_name = '';
$gender = '';
$date_of_birth = '';
$phone_number = '';
$email = '';
$street = '';
$city = '';
$province_state = '';
$zip_code = '';
$country = '';
$username = '';
$password = '';
$confirm_password = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $full_name = trim($_POST['full_name'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $date_of_birth = trim($_POST['date_of_birth'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $street = trim($_POST['street'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $province_state = trim($_POST['province_state'] ?? '');
    $zip_code = trim($_POST['zip_code'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Validations
    if (empty($full_name)) $errors[] = "Full name is required.";
    elseif (!preg_match("/^[A-Za-z\s]{2,50}$/", $full_name)) $errors[] = "Full name must contain only letters and spaces.";

    if (empty($gender) || !in_array($gender, ['male', 'female', 'other', 'prefer_not_to_say'])) $errors[] = "Please select a valid gender.";

    if (empty($date_of_birth)) $errors[] = "Date of birth is required.";
    else {
        $birth_date = new DateTime($date_of_birth);
        $age = (new DateTime())->diff($birth_date)->y;
        if ($age < 18) $errors[] = "You must be at least 18 years old to register.";
    }

    if (empty($phone_number) || !preg_match("/^09\d{9}$/", $phone_number)) $errors[] = "Phone number must be 11 digits and start with 09.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please enter a valid email address.";
    if (empty($street)) $errors[] = "Street address is required.";
    if (empty($city)) $errors[] = "City is required.";
    if (empty($province_state)) $errors[] = "Province/State is required.";
    if (empty($zip_code) || !preg_match("/^\d{4}$/", $zip_code)) $errors[] = "Zip code must be exactly 4 digits.";
    if (empty($country) || !preg_match("/^[A-Za-z\s]+$/", $country)) $errors[] = "Country must contain only letters and spaces.";
    if (empty($username) || !preg_match("/^[A-Za-z0-9_]{5,20}$/", $username)) $errors[] = "Username must be 5–20 characters with letters, numbers, or underscores.";
    if (empty($password) || !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/", $password)) {
        $errors[] = "Password must be 8+ characters, with uppercase, lowercase, digit, and special character.";
    }
    if (empty($confirm_password) || $password !== $confirm_password) $errors[] = "Passwords do not match.";

    // If no validation errors, proceed with DB insertion
    if (empty($errors)) {
        // Check for existing email or username
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $check_stmt->bind_param("ss", $email, $username);
        $check_stmt->execute();
        $check_stmt->store_result();
        if ($check_stmt->num_rows > 0) {
            $errors[] = "Email or username already exists.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into database
            $insert_stmt = $conn->prepare("
                INSERT INTO users (full_name, gender, date_of_birth, phone_number, email,
                                   street, city, province_state, zip_code, country,
                                   username, password)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $insert_stmt->bind_param(
                "ssssssssssss",
                $full_name, $gender, $date_of_birth, $phone_number, $email,
                $street, $city, $province_state, $zip_code, $country,
                $username, $hashed_password
            );

            if ($insert_stmt->execute()) {
                echo "<script>
                        alert('Registration successful! Proceeding to login...');
                        window.location.href = 'login.php';
                      </script>";
                exit;
            } else {
                $errors[] = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peach & Plum | Register</title>
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

        /* Main Content - Same structure as products page */
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

        .register-container {
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

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #5C2D43;
            margin-bottom: 8px;
            display: block;
        }

        .form-control, .form-select {
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #f8f9fa;
        }

        .form-control:focus, .form-select:focus {
            border-color: #EF8C6C;
            box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
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
            color: #c8a97e;
        }

        .btn-register {
            background: linear-gradient(135deg, #5C2D43, #EF8C6C);
            color: white !important;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .btn-secondary {
            background-color: #e0e0e0;
            color: #5C2D43 !important;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .btn-secondary:hover {
            background-color: #d5d5d5;
            color: #1a1a1a !important;
        }

        .login-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .login-link a {
            color: #EF8C6C;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            flex-wrap: wrap; 
        }

        .form-row .form-group {
            flex: 1 1 48%;
            min-width: 250px;
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

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #dc3545;
        }

        .invalid-feedback.show {
            display: block;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
            background-color: #fff5f5;
        }

        .form-control.is-valid,
        .form-select.is-valid {
            border-color: #28a745;
            background-color: #f8fff8;
        }

        input.is-valid,
        input.is-invalid,
        select.is-valid,
        select.is-invalid,
        textarea.is-valid,
        textarea.is-invalid {
            background-image: none !important;
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

            .register-container {
                padding: 30px 20px;
                margin: 0 15px;
            }

            .btn-register {
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

            .register-container {
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

    <!-- Header with Navigation -->
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
                <h1 class="page-title">Register</h1>
                <p class="page-subtitle">Create an account to get started</p>
            </div>

            <div class="register-container">
                <form action="" method="POST" id="registrationForm">

                    <!-- Personal Information -->
                    <div class="section-title mb-4">
                        <i class="fas fa-user"></i> Personal Information
                    </div>

                    <div class="form-group">
                        <label for="full_name" class="form-label">Full Name <span class="required">*</span></label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name" required>
                        <div id="full_name_error" class="invalid-feedback"></div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="gender" class="form-label">Gender <span class="required">*</span></label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="prefer_not_to_say">Prefer not to say</option>
                            </select>
                            <div id="gender_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth" class="form-label">Date of Birth <span class="required">*</span></label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                            <div id="date_of_birth_error" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone_number" class="form-label">Phone Number <span class="required">*</span></label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
                            <div id="phone_number_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                            <div id="email_error" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <!-- Address Details -->
                    <div class="section-title mb-4">
                        <i class="fas fa-home"></i> Address Details
                    </div>

                    <div class="form-group mb-3">
                        <label for="street" class="form-label">Street Address <span class="required">*</span></label>
                        <input type="text" class="form-control" id="street" name="street" placeholder="Enter your street address" required>
                        <div id="street_error" class="invalid-feedback"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city" class="form-label">City <span class="required">*</span></label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
                            <div id="city_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="province_state" class="form-label">Province/State <span class="required">*</span></label>
                            <input type="text" class="form-control" id="province_state" name="province_state" placeholder="Enter your province/state" required>
                            <div id="province_state_error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="zip_code" class="form-label">Zip Code <span class="required">*</span></label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter your zip code" required>
                            <div id="zip_code_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="country" class="form-label">Country <span class="required">*</span></label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter your country" required>
                            <div id="country_error" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <!-- Account Details -->
                    <div class="section-title mb-4">
                        <i class="fas fa-key"></i> Account Details
                    </div>

                    <div class="form-group">
                        <label for="username" class="form-label">Username <span class="required">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                        <div id="username_error" class="invalid-feedback"></div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="form-label">Password <span class="required">*</span></label>
                            <div class="password-input-wrapper">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                <span class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="password-eye"></i>
                                </span>
                            </div>
                            <div id="password_error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="form-label">Confirm Password <span class="required">*</span></label>
                            <div class="password-input-wrapper">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                                <span class="password-toggle" onclick="togglePassword('confirm_password')">
                                    <i class="fas fa-eye" id="confirm_password-eye"></i>
                                </span>
                            </div>
                            <div id="confirm_password_error" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between gap-3 mt-3">
                        <button type="submit" class="btn btn-register flex-fill">Register</button>
                        <button type="reset" class="btn btn-secondary flex-fill">Reset</button>
                    </div>

                    <div class="login-link">
                        <p>Already have an account? <a href="login.php">Log In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
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

    <!-- Scripts -->
    <script>
        // Validation functions
        function validateFullName(name) {
            const regex = /^[A-Za-z\s]{2,50}$/;
            return regex.test(name);
        }

        function validatePhoneNumber(phone) {
            const regex = /^09\d{9}$/;
            return regex.test(phone);
        }

        function validateEmail(email) {
            const regex = /^[A-Za-z0-9.-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
            return regex.test(email);
        }

        function validateStreet(street) {
            const regex = /^[A-Za-z0-9\s\.,#-]{5,100}$/;
            return regex.test(street);
        }

        function validateCity(city) {
            const regex = /^[A-Za-z\s]{2,50}$/;
            return regex.test(city);
        }

        function validateProvinceState(province) {
            const regex = /^[A-Za-z\s]{2,50}$/;
            return regex.test(province);
        }

        function validateZipCode(zip) {
            const regex = /^\d{4}$/;
            return regex.test(zip);
        }

        function validateCountry(country) {
            const regex = /^[A-Za-z\s]+$/;
            return regex.test(country);
        }

        function validateUsername(username) {
            const regex = /^[A-Za-z0-9_]{5,20}$/;
            return regex.test(username);
        }

        function validatePassword(password) {
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            return regex.test(password);
        }

        function validateAge(dateOfBirth) {
            const today = new Date();
            const birthDate = new Date(dateOfBirth);
            const age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                return age - 1 >= 18;
            }
            return age >= 18;
        }

        function showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.getElementById(fieldId + '_error');
            
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            errorDiv.textContent = message;
            errorDiv.classList.add('show');
        }

        function showSuccess(fieldId) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.getElementById(fieldId + '_error');
            
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
            errorDiv.classList.remove('show');
        }

        function clearValidation(fieldId) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.getElementById(fieldId + '_error');
            
            field.classList.remove('is-valid', 'is-invalid');
            errorDiv.classList.remove('show');
        }

        // Real-time validation
        document.getElementById('full_name').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value === '') {
                showError('full_name', 'Full name is required.');
            } else if (!validateFullName(value)) {
                showError('full_name', 'Full name must contain only letters and spaces, between 2 to 50 characters.');
            } else {
                showSuccess('full_name');
            }
        });

        document.getElementById('gender').addEventListener('change', function () {
            const value = this.value;
            if (value === '') {
                showError('gender', 'Please select a gender.');
            } else {
                showSuccess('gender');
            }
        });

        document.getElementById('date_of_birth').addEventListener('blur', function() {
            const value = this.value;
            if (value === '') {
                showError('date_of_birth', 'Date of birth is required.');
            } else if (!validateAge(value)) {
                showError('date_of_birth', 'You must be at least 18 years old to register.');
            } else {
                showSuccess('date_of_birth');
            }
        });

        document.getElementById('phone_number').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value === '') {
                showError('phone_number', 'Phone number is required.');
            } else if (!validatePhoneNumber(value)) {
                showError('phone_number', 'Phone number must be 11 digits and start with 09.');
            } else {
                showSuccess('phone_number');
            }
        });

        document.getElementById('email').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value === '') {
                showError('email', 'Email address is required.');
            } else if (!validateEmail(value)) {
                showError('email', 'Please enter a valid email address.');
            } else {
                showSuccess('email');
            }
        });

        document.getElementById('street').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value === '') {
                showError('street', 'Street address is required.');
            } else if (!validateStreet(value)) {
                showError('street', 'Street address must be between 5 to 100 characters and contain only letters, numbers, spaces, and common address symbols.');
            } else {
                showSuccess('street');
            }
        });

        document.getElementById('city').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value === '') {
                showError('city', 'City is required.');
            } else if (!validateCity(value)) {
                showError('city', 'City must contain only letters and spaces, between 2 to 50 characters.');
            } else {
                showSuccess('city');
            }
        });

        document.getElementById('province_state').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value === '') {
                showError('province_state', 'Province/State is required.');
            } else if (!validateProvinceState(value)) {
                showError('province_state', 'Province/State must contain only letters and spaces, between 2 to 50 characters.');
            } else {
                showSuccess('province_state');
            }
        });

        document.getElementById('zip_code').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value === '') {
                showError('zip_code', 'Zip code is required.');
            } else if (!validateZipCode(value)) {
                showError('zip_code', 'Zip code must be exactly 4 digits.');
            } else {
                showSuccess('zip_code');
            }
        });

        document.getElementById('country').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value === '') {
                showError('country', 'Country is required.');
            } else if (!validateCountry(value)) {
                showError('country', 'Country must contain only letters and spaces.');
            } else {
                showSuccess('country');
            }
        });

        document.getElementById('username').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value === '') {
                showError('username', 'Username is required.');
            } else if (!validateUsername(value)) {
                showError('username', 'Username must contain only letters, numbers, and underscores, between 5 to 20 characters.');
            } else {
                showSuccess('username');
            }
        });

        document.getElementById('password').addEventListener('blur', function() {
            const value = this.value;
            if (value === '') {
                showError('password', 'Password is required.');
            } else if (!validatePassword(value)) {
                showError('password', 'Password must be at least 8 characters with at least 1 uppercase, 1 lowercase, 1 digit, and 1 special character.');
            } else {
                showSuccess('password');
            }
            
            // Also validate confirm password if it has a value
            const confirmPassword = document.getElementById('confirm_password').value;
            if (confirmPassword !== '') {
                document.getElementById('confirm_password').dispatchEvent(new Event('blur'));
            }
        });

        document.getElementById('confirm_password').addEventListener('blur', function() {
            const value = this.value;
            const password = document.getElementById('password').value;
            
            if (value === '') {
                showError('confirm_password', 'Please confirm your password.');
            } else if (value !== password) {
                showError('confirm_password', 'Passwords do not match.');
            } else {
                showSuccess('confirm_password');
            }
        });

        // Form submission validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate all fields
            const fields = [
                'full_name', 'gender', 'date_of_birth', 'phone_number', 'email',
                'street', 'city', 'province_state', 'zip_code', 'country',
                'username', 'password', 'confirm_password'
            ];
            
            fields.forEach(field => {
                const element = document.getElementById(field);
                element.dispatchEvent(new Event('blur'));
                
                if (element.classList.contains('is-invalid')) {
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please correct all errors before submitting the form.');
                
                // Scroll to first error
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Reset form validation on reset
        document.querySelector('button[type="reset"]').addEventListener('click', function() {
            setTimeout(() => {
                const fields = [
                    'full_name', 'gender', 'date_of_birth', 'phone_number', 'email',
                    'street', 'city', 'province_state', 'zip_code', 'country',
                    'username', 'password', 'confirm_password'
                ];
                
                fields.forEach(field => {
                    clearValidation(field);
                });
            }, 10);
        });

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