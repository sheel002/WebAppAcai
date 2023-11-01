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
    <title>Delivery Details</title>
    <script>
    <script>
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

    </script>
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
    </header>
    
    <div class="checkout-section">
        <h2>Confirm your delivery address details</h2>
        
        <form name="checkoutForm" onsubmit="return validateForm()" action="submit_path" method="post">
		    <label for="country">Full name:</label>
            <input type="text" name="name" placeholder="YOUR NAME *"><br><br>
            <div class="error-tooltip" id="nameError">Please enter your full name.</div> 
        
		    <label for="country">Email:</label>
            <input type="text" name="email" placeholder="YOUR EMAIL *"><br><br>
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
        
            <button onclick="confirmpurchase()">Confirm Purchase</button>
        </form>
    </div>
</body>
</html>
