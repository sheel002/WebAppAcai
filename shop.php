<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// A function to add items to the cart - you can call this when a user adds an item to the cart
function addToCart($productName, $size, $toppings, $price) {
    $_SESSION['cart'][] = [
        'product' => $productName,
        'size' => $size,
        'toppings' => $toppings,
        'price' => $price
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <Script>
            document.addEventListener("DOMContentLoaded", function() {
            populateProducts('smoothies', 'smoothiesSection');
            populateProducts('bowls', 'bowlsSection');
        });  

    function populateProducts(category, sectionId) {
    // Start by fetching the products data from your server
    fetch('get_products.php?category=' + category)
        .then(response => response.json()) 
        .then(products => {
            // Once the data is fetched, use it to populate the products
            const section = document.getElementById(sectionId);
		if (category === 'smoothies') {
    products = [
        { name: "Pineapple Sundance Smoothie", image: "Assets/smoothie1.png", ingredients: "Pineapple, Banana, Orange Juice, Lime Zest.", price: 5.99 },
        { name: "Berry Medley Smoothie", image: "Assets/smoothie2.png", ingredients: "Blueberries, Strawberries, Almond Milk, Chia Seeds.", price: 6.49 },
        { name: "Golden Glow Smoothie", image: "Assets/smoothie3.png", ingredients: "Mango, Pineapple, Honey, Coconut Milk.", price: 5.99 },
        { name: "Minty Melon Smoothie", image: "Assets/smoothie4.png", ingredients: "Watermelon, Mint Leaves, Lime Juice, Agave Syrup.", price: 6.99 },
        { name: "Creamy Caramel Crunch Smoothie", image: "Assets/smoothie5.png", ingredients: "Dates, Cashews, Almond Milk, Caramel Syrup.", price: 7.49 }
    ];
}

    }

            let productHTML = products.map(product => `
                <div class="product-card">
                    <img src="${product.image}" alt="${product.name}">
                    <h3>${product.name}</h3>
                    <p>${product.ingredients}</p>
                    <p class="price">${product.price}</p>
                    <button onclick="openPopup('${product.image}', '${product.name}', '${product.price.replace("$","")}')">Add to Cart</button>
                </div>
            `).join('');

            const productContainer = section.querySelector(".products-display");
            productContainer.innerHTML = productHTML;
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            // Handle the error (show a message to the user, etc.)
        });
}

        function openPopup(imageSrc, productName, basePrice) {
        // Set the image and product name in the popup
        const popupImage = document.querySelector('.popup-image');
        popupImage.src = imageSrc;
        popupImage.alt = productName;

        // Reset selections
        document.getElementById("sizeSelect").value = "small";
        const toppings = document.querySelectorAll('.checkbox-list input');
        toppings.forEach((topping) => topping.checked = false);

        // Calculate and display the base price
        updatePrice(basePrice);

        // Display the popup
        const popup = document.getElementById('popup');
        popup.style.display = 'flex';

        // Store the base price in the size select for later reference
        const sizeSelect = document.getElementById("sizeSelect");
        sizeSelect.setAttribute('data-base-price', basePrice);
}

    function updatePrice(basePrice) {
        let totalPrice = parseFloat(basePrice);

        // Retrieve the additional price based on size from a predefined object/array
        const sizePrices = {"small": 0, "medium": 2}; // Example sizes with extra costs
        const size = document.getElementById("sizeSelect").value;
        totalPrice += sizePrices[size] || 0;

        // Add the price of checked toppings
        const toppings = document.querySelectorAll('.checkbox-list input:checked');
        toppings.forEach((topping) => {
            totalPrice += parseFloat(topping.getAttribute('data-price'));
        });

        document.querySelector('.popup-price').textContent = `$${totalPrice.toFixed(2)}`;
    }

    function closePopup() {
            const popup = document.getElementById('popup');
            popup.style.display = 'none';
        }

    // Event listeners for size and toppings changes to update the price
    document.getElementById("sizeSelect").addEventListener("change", function() {
    const basePrice = this.getAttribute('data-base-price');
    updatePrice(basePrice);
    });

    document.querySelectorAll('.checkbox-list input').forEach((input) => {
        input.addEventListener("change", function() {
            const basePrice = document.getElementById("sizeSelect").getAttribute('data-base-price');
            updatePrice(basePrice);
        });
    });
           


    </script>
    <style>
    body {
            font-family: Arial, sans-serif;
        }
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .popup-content {
            background-color: #fff;
            width: 70%;
            max-width: 600px;
            display: flex;
            padding: 20px;
            border-radius: 10px;
        }
        .popup-close {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 24px;
            cursor: pointer;
        }
        .popup-left, .popup-right {
            flex: 1;
            padding: 10px;
        }
        .popup-left {
            border-right: 1px solid #ccc;
        }
        h2 {
            margin-top: 0;
            font-size: 20px;
            margin-bottom: 15px;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        .add-to-cart-button {
            margin-top: 20px;
        }
        button {
        padding: 12px 20px; /* Increased padding */
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s; /* Added transform transition */
        border-radius: 5px; /* Rounded corners for the button */
        }

        button:hover {
            background-color: #555;
            transform: translateY(-2px); /* Button will move up slightly on hover */
        }
            /* Style the shops section */

        .shop-section h2 {
        font-size: 28px;          /* Increase font size */
        font-weight: bold;        /* Make the text bold */
        color: #2d2d2d;           /* A dark color for contrast */
        margin-bottom: 20px;      /* Add spacing below the heading */
        text-transform: uppercase; /* Convert text to uppercase */
        padding-bottom: 10px;     /* Padding at the bottom for our border */
        border-bottom: 2px solid #a2a0a0;  /* A border at the bottom */
        }

        .product-item {
            flex: 1; 
            padding: 0 15px; /* This gives some spacing between the outlets */
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center; /* This will center the content horizontally */
        }

        .product-item img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px; /* Add some space between the image and the content below */
        }


        .product-item h2 {
            font-size: 20px;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .product-item p {
            font-size: 16px;
            margin-bottom: 10px;
        }



        /* Shop Page Styles */
        .shop-content {
            padding: 20px;
            text-align: center;
        }

        .product-categories button {
            background-color: #F8E4E4;
            border: 1px solid #a2a0a0;
            padding: 10px 20px;
            margin: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .product-categories button:hover {
            background-color: #d2c0c0;
        }

        .products-display {
            display: grid;
            gap: 20px; /* Adjust the gap between cards as needed */
            justify-items: center; /* Center the items horizontally in each cell */
            padding: 20px; /* Add padding to the container */
            box-sizing: border-box; /* Include padding in the container width */
        }

        /* end of Shop Page Styles */
        /*  product card style */
        .product-card {
        display: grid;
        gap: 20px;
        justify-items: center;
        padding: 30px; /* Increased padding */
        box-sizing: border-box;
        background-color: #ffffff; /* White background */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        transition: transform 0.3s; /* Added transition for smooth effect */
    }


        .product-card:hover {
        transform: scale(1.03); /* Reduced the scale for subtleness */
         }


        .product-card img {
        width: 160px; /* Increased image size */
        height: 160px;
        object-fit: cover;
        border-bottom: 1px solid #a2a0a0;
        margin-bottom: 15px; /* Increased spacing */
        border-radius: 10px; /* Rounded corners for the image */
        }

        .product-card h2 {
        margin: 0;
        padding: 0;
        font-size: 22px; /* Increased font size */
        }

        .product-card p {
        margin: 10px 0; /* Adjusted margin */
        font-size: 17px; /* Increased font size */
    }
        /*  end of product card style */
        
    /* Pop up styl */
        .popup-overlay {
        display: none; /* Initially hide the overlay */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        z-index: 1000; /* Ensure it's above other content */
        overflow: hidden;
        align-items: center;
        justify-content: center;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            max-width: 80%;
            overflow: auto;
            position: relative;
        }

        .popup-close {
            cursor: pointer;
        }
        .popup-right {
            padding: 20px;
        }
        h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .optional {
            font-size: 14px;
            color: gray;
            margin-left: 10px;
        }
        .checkbox-list label {
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
        }
        .checkbox-list input {
            margin-right: 10px;
        }
        .price {
            color: red;
            font-weight: bold;
            margin-left: 10px;
        }
        .add-to-cart-button {
            margin-top: 20px;
        }
    /* End of Pop up styl */
	
    </style>
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
                <?php 
                if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false): ?>
                    <li><a href="login.php" class="nav-item login">Login</a></li>
                    <li><a href="register.php" class="nav-item register">Register</a></li>
                <?php else: ?>
                    <li><a href="logout.php" class="nav-item logout">Logout</a></li>
                <?php endif; ?>
            </ul>
			<div class="main_cart">
            <a href="cart.php"><img class="small-image" src="Assets/cart-icon.png" alt="Cart">
           <span class="cart-count">0</span></a>
    </div>
        </div>
    </header>

    <div class="shop-content">
        <section id="smoothiesSection">
            <h2>Smoothies</h2>
            <div class="products-display">
			
            </div>
        </section>

        <section id="bowlsSection">
            <h2>Bowls</h2>
            <div class="products-display">

            </div>
        </section>
        
        <!-- You can add more categories/sections here -->

    </div>

    <div class="popup-overlay" id="popup">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <div class="popup-left">
                <img class="popup-image" src="" alt="Image" style="max-width: 100%;">
            </div>
            <div class="popup-right">
                <h2>Size</h2>
                <select id="sizeSelect">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                </select>
    
                <h2>Choice of Additional Toppings <span class="optional">Optional</span></h2>
                <div class="checkbox-list">
                    <label><input type="checkbox" data-price="1.10" value="pomegranate-seeds"> Pomegranate seeds <span class="price">+$1.10</span></label>
                    <label><input type="checkbox" data-price="1.10" value="golden-flax-seeds"> Golden flax seeds <span class="price">+$1.10</span></label>
                    <label><input type="checkbox" data-price="1.10" value="passion-fruit"> Passion fruit <span class="price">+$1.10</span></label>
                    <label><input type="checkbox" data-price="1.10" value="blackberries"> Blackberries <span class="price">+$1.10</span></label>

                <h2>Quantity</h2>
                <input type="number" id="quantitySelect" value="1" min="1" style="width: 50px; margin-bottom: 20px;">

                <h2 class="popup-price"></h2>
                <div class="add-to-cart-button">
                    <button onclick="addToCart()" class="checkout-button">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
    
    

</body>
</html>
