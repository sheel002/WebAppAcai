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
