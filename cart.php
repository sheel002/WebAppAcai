<<<<<<< HEAD
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

    function validateForm() {
            var name = document.forms["checkoutForm"]["name"].value;
            var email = document.forms["checkoutForm"]["email"].value;
            var phone = document.forms["checkoutForm"]["phone"].value;
            var city = document.forms["checkoutForm"]["city"].value;
            var address = document.forms["checkoutForm"]["address"].value;
            var postalCode = document.forms["checkoutForm"]["postal-code"].value;
            var country = document.forms["checkoutForm"]["country"].value;

            var valid = true;

            // Validate name - no numbers or special characters
            if (!/^[A-Za-z\s]+$/.test(name)) {
                document.getElementById("nameError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("nameError").style.display = "none";
            }

            // Validate email
            var atposition = email.indexOf("@");
            var dotposition = email.lastIndexOf(".");
            if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= email.length) {
                document.getElementById("emailError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("emailError").style.display = "none";
            }

            // Validate phone number - You can add more specific phone number validation if needed
            if (phone && !/^\d{10}$/.test(phone)) {
                document.getElementById("phonenumberError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("phonenumberError").style.display = "none";
            }

            // Validate city
            if (!/^[A-Za-z\s]+$/.test(city)) {
                document.getElementById("cityError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("cityError").style.display = "none";
            }

            // Validate address
            if (/[^A-Za-z0-9\s]/.test(address)) {
                document.getElementById("addressError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("addressError").style.display = "none";
            }

            // Validate postal code - You can add more specific postal code validation if needed
            if (postalCode && !/^[0-9]{5}$/.test(postalCode)) {
                document.getElementById("postalCodeError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("postalCodeError").style.display = "none";
            }

            // Validate country (optional)
            if (country === "") {
                document.getElementById("countryError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("countryError").style.display = "none";
            }

            return valid;
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

    <div class="checkout-section">
        <h2>Confirm your delivery address details</h2>
        
        <form name="checkoutForm" onsubmit="return validateForm()" action="submit_path" method="post">
		    <label for="country">Full name:</label>
            <input type="text" name="name" placeholder="YOUR NAME *">
            <div class="error-tooltip" id="nameError">Please enter your full name.</div> 
        
		    <label for="country">Email:</label>
            <input type="text" name="email" placeholder="YOUR EMAIL *">
            <div class="error-tooltip" id="emailError">Please enter a valid email address.</div>
        
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="YOUR MOBILE NUMBER *" required>
			<div class="error-tooltip" id="phonenumberError">Please enter a valid mobile number.</div>
			
			<label for="country">Country:</label>
            <select id="country" name="country">
            <option value="australia">Australia</option>
            <option value="canada">Canada</option>
            <option value="france">France</option>
            <option value="singapore">Singapore</option>
            <option value="uk">United Kingdom </option>
            </select>
			
			<label for="address">City:</label><input type="text" id="city" name="city" placeholder="ENTER YOUR CITY *" required>
			<div class="error-tooltip" id="cityError">Please enter a valid city.</div>
			
			<label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="ENTER YOUR ADDRESS *" required>
			<div class="error-tooltip" id="addressError">Please enter a valid address.</div>
			
			<label for="postal-code">Postal Code:</label>
            <input type="text" id="postal-code" name="postal-code" placeholder="ENTER YOUR POSTAL CODE *" required>
        
        </form>
    </div>



        <button onclick="confirmOrder()">Confirm Order</button>
        <?php else: ?>
            
        <?php endif; ?>
    </div>
</body>
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
>>>>>>> cbe514ca4c70748e9fa83582cd607b31e1af9ab6
</html>