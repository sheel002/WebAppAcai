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
    <script>
        function validateForm() {
            // Validation code here
            var name = document.forms["checkoutForm"]["name"].value;
            var email = document.forms["checkoutForm"]["email"].value;
            var phone = document.forms["checkoutForm"]["phone"].value;
            var city = document.forms["checkoutForm"]["city"].value;
            var address = document.forms["checkoutForm"]["address"].value;
            var postalCode = document.forms["checkoutForm"]["postal-code"].value;
            var hasError = false;
            
            if (name == "") {
                document.getElementById("nameError").style.display = 'block';
                hasError = true;
            } else {
                document.getElementById("nameError").style.display = 'none';
            }
            
            if (email == "" || !email.includes('@')) {
                document.getElementById("emailError").style.display = 'block';
                hasError = true;
            } else {
                document.getElementById("emailError").style.display = 'none';
            }
            
            if (phone == "" || !phone.match(/^\d{10}$/)) {
                document.getElementById("phonenumberError").style.display = 'block';
                hasError = true;
            } else {
                document.getElementById("phonenumberError").style.display = 'none';
            }
            
            if (city == "") {
                document.getElementById("cityError").style.display = 'block';
                hasError = true;
            } else {
                document.getElementById("cityError").style.display = 'none';
            }
            
            if (address == "") {
                document.getElementById("addressError").style.display = 'block';
                hasError = true;
            } else {
                document.getElementById("addressError").style.display = 'none';
            }
            
            if (postalCode == "" || !postalCode.match(/^\d+$/)) {
                document.getElementById("postal-codeError").style.display = 'block';
                hasError = true;
            } else {
                document.getElementById("postal-codeError").style.display = 'none';
            }
            
            return !hasError;
        }
    </script>
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


<div class="checkout-section">
        <h2>Confirm your delivery address details</h2>
        
        <form name="checkoutForm" onsubmit="return validateForm()" action="final.php" method="post">
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
            <input type="submit" value="Confirm Order">
        
        </form>
    </div>
</body>
</html>