<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <!-- Add CSS and other head elements -->
</head>
<script>
    function confirmOrder() {
        fetch('confirm_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(<?= json_encode($_SESSION['cart'] ?? []) ?>),
        })
        .then(response => response.json())
        .then(data => {
        console.log(data);
        if (data.success === true) { // Updated this line
            alert('Order Confirmed! Redirecting...');
            window.location.href = 'thank_you.php'; // Redirect to thank you page
        } else {
            // If the response is not success, log the error message
            console.error('Failed to confirm order: ' + data.message);
        }
    })
    }

</script>
<body>
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
    <div class="confirm-order-box">
        <h1>Your Shopping Cart</h1>
        <?php
        
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $total = 0;
            echo "<table>";
            echo "<thead>";
            echo "<tr><th>Product Name</th><th>Size</th><th>Quantity</th><th>Price</th><th>Add-Ons</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($_SESSION['cart'] as $item) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['name']) . "</td>";
                echo "<td>" . htmlspecialchars($item['size']) . "</td>";
                echo "<td>" . htmlspecialchars($item['quantity']) . "</td>";
                echo "<td>$" . htmlspecialchars($item['price']) . "</td>";

                echo "<td>";
                if (!empty($item['addOns'])) {
                    foreach ($item['addOns'] as $addOn) {
                        echo htmlspecialchars($addOn) . "<br>";
                    }
                }
                echo "</td>";
                echo "</tr>";
                $total += $item['price'] * $item['quantity'];
            }
            echo "</tbody>";
            echo "</table>";

            // Display the total
            echo "<p><strong>Total: $" . htmlspecialchars(number_format($total, 2)) . "</strong></p>";
        } else {
            echo "<p>Your cart is empty!</p>";
        }
        ?>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>


        <button onclick="confirmOrder()">Proceed to Checkout</button>
        <?php else: ?>
            
        <?php endif; ?>
    </div>
</body>
</html>