<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Outlets | An Açaí Affair</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="Assets/logo.png" alt="Your Logo">
        </div>
        <div class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="outlets.php">Outlets</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li class="cart-icon">
                <?php 
                if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false): ?>
                    <li><a href="login.php" class="nav-item login">Login</a></li>
                    <li><a href="register.php" class="nav-item register">Register</a></li>
                <?php else: ?>
                    <li><a href="logout.php" class="nav-item logout">Logout</a></li>
                <?php endif; ?>
                <a href="cart.php">
                    <img src="Assets/cart-icon.png" alt="Cart" class="cart-img"> 
                    <!-- Displaying the count of items in the cart -->
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <span class="cart-count"><?= count($_SESSION['cart']) ?></span>
                    <?php endif; ?>
                </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="outlets-section">
        <!-- Outlet 1 -->
        <div class="outlet">
            <img src="Assets/location1.png" alt="Outlet Image 1">
            <h2>Bishan</h2>
            <p>Level 2, #02-31</p>
            <p>Contact: +65 1234 5678</p>
            <p>Opening Hours: 10am - 8pm, Daily</p>
        </div>
    
        <!-- Outlet 2 -->
        <div class="outlet">
            <img src="Assets/location2.png" alt="Outlet Image 2">
            <h2>Jurong Point</h2>
            <p>Level 4, #04-31</p>
            <p>Contact: +65 2345 6789</p>
            <p>Opening Hours: 11am - 9pm, Daily</p>
        </div>
    
        <!-- Outlet 3 -->
        <div class="outlet">
            <img src="Assets/location3.png" alt="Outlet Image 3">
            <h2>Somerset</h2>
            <p>Level 2, #02-05</p>
            <p>Contact: +65 3456 7890</p>
            <p>Opening Hours: 9am - 7pm, Daily</p>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>
