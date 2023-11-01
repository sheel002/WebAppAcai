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
        if (data.status === 'success') {
            alert('Order Confirmed! Redirecting...');
            window.location.href = 'thank_you.php'; // Redirect or update UI
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
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
            </ul>
        </div>
    </header>
    <div class="confirm-order-box">
        <h1>Your Shopping Cart</h1>
        <?php
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            echo "<ul>";
            foreach ($_SESSION['cart'] as $item) {
                echo "<li>";
                echo htmlspecialchars($item['name']) . " - " . htmlspecialchars($item['size']) . " - Qty: " . htmlspecialchars($item['quantity']) . " - Price: $" . htmlspecialchars($item['price']);
                if (!empty($item['addOns'])) {
                    echo "<ul>";
                    foreach ($item['addOns'] as $addOn) {
                        echo "<li>" . htmlspecialchars($addOn) . "</li>";
                    }
                    echo "</ul>";
                }
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Your cart is empty!</p>";
        }
        ?>
        <button onclick="confirmOrder()">Confirm Order</button>
    </div>
</body>
</html>