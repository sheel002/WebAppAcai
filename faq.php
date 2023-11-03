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

    h2 {
            color: #5D5C61;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

    .faq-entry {
    background-color: #FFFFFF;
    border: 1px solid #ddd;
    padding: 3px 25px; /* Increased padding */
    border-radius: 5px; /* Slightly larger radius */
    margin-bottom: 5px; /* Increased spacing */
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: all 0.3s ease; /* Smooth transition for all properties */
}

    .faq-entry:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* More pronounced hover effect */
        transform: translateY(-2px); /* Slight lift effect on hover */
    }

    .faq-question {
        font-weight: 600; /* Increased weight for readability */
        font-size: 18px; /* Slightly larger text */
        margin-bottom: 5px; /* Adjusted spacing */
        display: flex; /* Added for inline arrow positioning */
        align-items: center; /* Align arrow and text */
        justify-content: space-between; /* Space out text and arrow */
    }

    .faq-arrow {
        transition: transform 0.3s ease; /* Transition for smooth rotation */
        transform: rotate(0); /* Default state */
    }

    .faq-entry.open .faq-arrow {
        transform: rotate(90deg); /* Rotate arrow when open */
    }

    .faq-answer {
        display: none;
        margin-top: 15px; /* More space above answer */
        color: #666;
        line-height: 1.6; /* Increased line height for readability */
    }

    .faq-hr {
        border-color: #D6BDC0;
        margin-top: 5px; /* More space above horizontal line */
    }

    .inquiry-contact {
    text-align: center; /* Center aligns all content inside the div */
}

.inquiry-contact p {
    font-weight: bold; /* Makes the text inside <p> bold */
    /* If you want the entire content of the div to be bold, including the link,
       you can apply 'font-weight: bold;' to '.inquiry-contact' instead. */
}

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<html>
<body>
    <header>
        </div>
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
<br><br>
<h2>Frequently Asked Questions </h2><br><br>
        
        <div class="faq-entry">
            <div class="faq-question">
                What is acai? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
            </div>
            <div class="faq-answer">
                Acai is known as a small, dark purple berry that is known to carry a unique flavour as well as being rich in antioxidants and nutrients. 
            </div>
            <hr class="faq-hr"> <!-- Horizontal line under the answer -->
        </div>
    
        <div class="faq-entry">
            <div class="faq-question">
                What is the difference among all the Acai bowls? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
            </div>
            <div class="faq-answer">
                Our acai bowls varies in terms of the base used, they can range from incorporating fruits like mangoes and avocadoes, to vegetables like spinach. <br>They come together with different toppings that works well with the base used.
            </div>
            <hr class="faq-hr"> <!-- Horizontal line under the answer -->
        </div>
        
        <div class="faq-entry">
            <div class="faq-question">
                What are the bestsellers? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
            </div>
            <div class="faq-answer">
                Our bestsellers would be the Ruby Indulgence bowl and the Golden Glow smoothie. 
            </div>
            <hr class="faq-hr"> <!-- Horizontal line under the answer -->
        </div>
        
        <div class="faq-entry">
            <div class="faq-question">
                What topping would you recommend? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
            </div>
            <div class="faq-answer">
                We would recommend the pomogranate seeds as not only do they taste great with most items in our menu, they also help in reducing anti-inflammatory effects.
            </div>
            <hr class="faq-hr"> <!-- Horizontal line under the answer -->
        </div>
        
        <div class="faq-entry">
            <div class="faq-question">
                Are your products vegan/dairy-free/guten-free? <span class="faq-arrow"><span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
            </div>
            <div class="faq-answer">
               Yes, our products are certified to cater to vegan, dairy-free and gluten-free dietary requirements. 
            </div>
            <hr class="faq-hr"> <!-- Horizontal line under the answer -->
        </div>
        
        <div class="faq-entry">
            <div class="faq-question">
                Can I leave my acai overnight and eat it tomorrow? <span class="faq-arrow"><img class="small-image" src="Assets/faq-arrow.png" alt="Custom Arrow"></span>
            </div>
            <div class="faq-answer">
                Yes, as long as your acai is stored in a cool, refridgerated area the product can be eaten in 2 to 3 days.
            </div>
            <hr class="faq-hr"> <!-- Horizontal line under the answer -->
        </div>
        <div class="inquiry-contact"><br><br>
        <p>Can't find your inquiry here? Contact us <a href="contact.php">here</a>!</p>
        </div>
        

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