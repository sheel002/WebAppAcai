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
    <style>
    body {font-family:Lato,  sans-serif;
        background-color: #F8E4E4;
    }
    .faq-entry {
            display: block;
            align-items: center;
            cursor: pointer;
			margin-bottom: 10px;
			margin-left: 30px;
        }

    .faq-question {
        font-weight: bold;
        margin-left: 30px;
    }

    .faq-arrow {
        margin-left: auto;
        font-size: 0.75em;
        display: inline-block;
        vertical-align: middle; /* Aligns the arrow vertically with the text */
        
    }

    .faq-answer {
        display: none;
        margin-top: 5px;
        margin-left: 30px;
    }
    
    .faq-hr {
        border-color: #D6BDC0; /* Change the color to your desired color */
        margin-left: 30px;
        margin-right: 50px;
        }


    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<html>
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
</body>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <div class="faq-entry">
        <div class="faq-question">
            What is acai? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
        </div>
        <div class="faq-answer">
            Answer to Question 1 goes here.
        </div>
		<hr class="faq-hr"> <!-- Horizontal line under the answer -->
    </div>

    <div class="faq-entry">
        <div class="faq-question">
            What is the difference among all the Original bowls? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
        </div>
        <div class="faq-answer">
            Answer to Question 2 goes here.
        </div>
		<hr class="faq-hr"> <!-- Horizontal line under the answer -->
    </div>
	
	<div class="faq-entry">
        <div class="faq-question">
            What are the bestsellers? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
        </div>
        <div class="faq-answer">
            Answer to Question 3 goes here.
        </div>
		<hr class="faq-hr"> <!-- Horizontal line under the answer -->
    </div>
	
	<div class="faq-entry">
        <div class="faq-question">
            What drizzle would you recommend? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
        </div>
        <div class="faq-answer">
            Answer to Question 4 goes here.
        </div>
		<hr class="faq-hr"> <!-- Horizontal line under the answer -->
    </div>
	
	<div class="faq-entry">
        <div class="faq-question">
            Are your products vegan/dairy-free/guten-free? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
        </div>
        <div class="faq-answer">
            Answer to Question 5 goes here.
        </div>
		<hr class="faq-hr"> <!-- Horizontal line under the answer -->
    </div>
	
	<div class="faq-entry">
        <div class="faq-question">
            Can I leave my acai overnight and eat it tomorrow? <span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
        </div>
        <div class="faq-answer">
            Answer to Question 6 goes here.
        </div>
		<hr class="faq-hr"> <!-- Horizontal line under the answer -->
    </div>
    <!-- Add more FAQ entries as needed -->

    <script>
        // JavaScript to toggle the display of answers
        const faqEntries = document.querySelectorAll('.faq-entry');
        faqEntries.forEach((entry) => {
            const question = entry.querySelector('.faq-question');
            const answer = entry.querySelector('.faq-answer');
            question.addEventListener('click', () => {
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
</body>
</html>
