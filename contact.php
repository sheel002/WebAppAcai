<?php

$db = new mysqli('localhost', 'root', '', 'WebAppAcai', null, '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');

$message = '';

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    $stmt = $db->prepare('INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
    if($stmt->execute()) {
        $message = 'Your message was sent successfully!';
    } else {
        $message = 'There was an error sending your message.';
    }
    $stmt->close();
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Contact Us | An Açaí Affair</title>
    <script>
        function validateForm() {
            var name = document.forms["contactForm"]["name"].value;
            var email = document.forms["contactForm"]["email"].value;
            var message = document.forms["contactForm"]["message"].value;
    
            var valid = true;
    
            if (!/^[A-Za-z\s]+$/.test(name)) {
                document.getElementById("nameError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("nameError").style.display = "none";
            }
    
            var atposition=email.indexOf("@");
            var dotposition=email.lastIndexOf(".");
            if (atposition<1 || dotposition<atposition+2 || dotposition+2>=email.length) {
                document.getElementById("emailError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("emailError").style.display = "none";
            }
    
            if (/[^A-Za-z0-9\s]/.test(message)) {
                document.getElementById("messageError").style.display = "block";
                valid = false;
            } else {
                document.getElementById("messageError").style.display = "none";
            }
    
            return valid;
        }
    </script>
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
    
    <div class="contact-section">
        <h2>CONTACT US </h2>
        <p>We'd love to hear from you! Drop us a note via the contact form below, or email us at <a href="mailto:manyamiglani137@gmail.com">acaiproject.com</a></p>
        <?php if($message): ?>
            <div class="feedback">
                <?= $message; ?>
            </div>
        <?php endif; ?>
        <form name="contactForm" onsubmit="return validateForm()" action="contact.php" method="post">
            <input type="text" name="name" placeholder="YOUR NAME *" required><br><br>
            <div class="error-tooltip" id="nameError">Please enter a valid name.</div> 
        
            <input type="text" name="email" placeholder="YOUR EMAIL *" required><br><br>
            <div class="error-tooltip" id="emailError">Please enter a valid email address.</div>
        
            <input type="text" name="subject" placeholder="SUBJECT *" required><br><br>
        
            <textarea name="message" placeholder="ASK US ANYTHING! *" required></textarea><br><br>
            <div class="error-tooltip" id="messageError">Please avoid special characters.</div>
        
            <input type="submit" value="SUBMIT">
        </form>
    </div>
</body>
</html>
