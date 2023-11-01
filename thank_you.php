<?php
session_start();

// Clear the cart after the order is confirmed
$_SESSION['cart'] = [];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
    <!-- Add your CSS and other head elements here -->
</head>
<body>
    <h1>Thank You for Your Order!</h1>
    <p>Your order has been successfully placed and is being processed.</p>

    <!-- You can provide additional information here like estimated delivery time, order number, etc. -->

    <a href="index.php">Continue Shopping</a> <!-- Link back to the main shopping page or user dashboard -->

    <!-- You can also add more content such as recommendations, links to track the order, customer service contact info, etc. -->
</body>
</html>