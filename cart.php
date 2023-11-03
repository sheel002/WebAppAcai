<<<<<<< HEAD
<!-- cart.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cart Summary</title>
</head>
<body>
    <h1>Cart Summary</h1>
    <div id="cart-items"></div>
    <button onclick="clearCart()">Clear Cart</button>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const cartItemsContainer = document.getElementById("cart-items");
    const clearCartButton = document.querySelector("button");

    // Function to retrieve cart data from URL query parameter
    function getCartDataFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const cartData = urlParams.get("cartData");

        if (cartData) {
            return JSON.parse(decodeURIComponent(cartData));
        }

        return [];
    }

    // Function to display cart items
    function displayCartItems() {
        cartItemsContainer.innerHTML = "";

        const cart = getCartDataFromURL();

        if (cart.length === 0) {
            cartItemsContainer.textContent = "Your cart is empty.";
        } else {
            cart.forEach((item, index) => {
                const cartItem = document.createElement("div");
                cartItem.innerHTML = `
                    <p>${item.name} - ${item.size}</p>
                    <button onclick="removeItemFromCart(${index})">Remove</button>
                `;
                cartItemsContainer.appendChild(cartItem);
            });
        }
    }

    displayCartItems();

    clearCartButton.addEventListener("click", function() {
        // Implement the clearCart function if you haven't already
        // You can clear the cart data and then update the display
        // Example: cart = []; displayCartItems();
    });
});

</script>
</html>
=======
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
    <style>
        body {
            font-family:Lato,  sans-serif;
            background-color: #F8E4E4;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Your Logo">
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
		<div class="main_cart">
            <a href="cart.php"><img class="small-image" src="Assets/cart-icon.png" alt="Cart">
           <span class="cart-count">0</span></a>
    </header>
    <body>
	<div class="cart-section">
	<div class="centered-content">
    <h1>Cart Summary</h1>
    <div id="cart-items"></div>
	<div class="button-container">
    <button onclick="clearCart()">Clear Cart</button>
	<a href="checkout.php">
    <button>Proceed to Checkout</button>
    </a>
	</div>
	</div>
	</div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const cartItemsContainer = document.getElementById("cart-items");
    const clearCartButton = document.querySelector("button");

    // Function to retrieve cart data from URL query parameter
    function getCartDataFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const cartData = urlParams.get("cartData");

        if (cartData) {
            return JSON.parse(decodeURIComponent(cartData));
        }

        return [];
    }

    // Function to display cart items
    function displayCartItems() {
        cartItemsContainer.innerHTML = "";

        const cart = getCartDataFromURL();

        if (cart.length === 0) {
            cartItemsContainer.textContent = "Your cart is empty.";
        } else {
            cart.forEach((item, index) => {
                const cartItem = document.createElement("div");
                cartItem.innerHTML = `
                    <p>${item.name} - ${item.size}</p>
                    <button onclick="removeItemFromCart(${index})">Remove</button>
                `;
                cartItemsContainer.appendChild(cartItem);
            });
        }
    }

    displayCartItems();

    clearCartButton.addEventListener("click", function() {
        // Implement the clearCart function if you haven't already
        // You can clear the cart data and then update the display
        // Example: cart = []; displayCartItems();
    });
});

</script>
</html>
>>>>>>> cbe514ca4c70748e9fa83582cd607b31e1af9ab6
