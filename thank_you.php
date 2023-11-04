<?php
session_start();

// Clear the cart after the order is confirmed
$_SESSION['cart'] = [];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Thank You</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
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
<body>
    <h1>Thank You for Your Order!</h1>
    <p>Your order has been successfully placed and is being processed.</p>

    <!-- You can provide additional information here like estimated delivery time, order number, etc. -->

    <a href="index.php">Continue Shopping</a> <!-- Link back to the main shopping page or user dashboard -->

    <!-- You can also add more content such as recommendations, links to track the order, customer service contact info, etc. -->
	<script>
        // Function to send an AJAX request to confirm_order.php to handle the email sending
    function sendConfirmationEmail() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "send_confirmation_email.php", true); // Change the URL to send_confirmation_email.php
        xhr.send();
    }

    // Display the alert and send the email when the page loads
    window.onload = function() {
        alert('Order Confirmed!');
        sendConfirmationEmail();
        // Redirect to another page after the alert (if needed)
        window.location.href = 'index.php'; // Change the URL to your desired page
    }
    </script>
</body>
</html>