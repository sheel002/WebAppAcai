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
    <style>
    body {font-family:Lato,  sans-serif;
        background-color: #F8E4E4;
    }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
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
            <?php 
            if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false): ?>
                <li><a href="login.php" class="nav-item login">Login</a></li>
                <li><a href="register.php" class="nav-item register">Register</a></li>
            <?php else: ?>
                <li><a href="logout.php" class="nav-item logout">Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
	</header>
</body>

<body>
    <div class="banner">
        <div class="banner-photo">
            <img src="banner.png" alt="Homepage Banner">
        </div>
    </div>
</body>
</html>