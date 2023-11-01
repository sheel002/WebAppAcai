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
    <!-- Add more HTML for Checkout or Continue Shopping -->
</body>
</html>