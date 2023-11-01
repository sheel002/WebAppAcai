document.addEventListener("DOMContentLoaded", function() {
    populateProducts('smoothies', 'smoothiesSection');
    populateProducts('bowls', 'bowlsSection');
});  

function populateProducts(category, sectionId) {
    const section = document.getElementById(sectionId);

    let products = [];
    if (category === 'smoothies') {
        products = [
            {name: "Berry Blast", image: "Assets/product1.png", description: "A berry-filled delight"},
            {name: "Tropical Twist", image: "Assets/product2.png", description: "A tropical sensation"},
            {name: "Green Goodness", image: "Assets/product3.png", description: "A healthy green blend"},
            {name: "Peanut Protein", image: "Assets/product4.png", description: "Protein-packed peanut flavor"},
            {name: "Mango Magic", image: "Assets/product5.png", description: "Refreshing mango delight"}
        ];
    } else if (category === 'bowls') {
        products = [
            {name: "Classic Acai Bowl", image: "Assets/bowl1.png", description: "The classic favorite"},
            {name: "Peanut Butter Bliss", image: "Assets/bowl2.png", description: "Creamy peanut butter goodness"},
            {name: "Tropical Bowl", image: "Assets/bowl3.png", description: "Tropical fruits and granola"},
            {name: "Berry Bowl", image: "Assets/bowl4.png", description: "Mixed berries and chia seeds"},
            {name: "Green Energy Bowl", image: "Assets/bowl5.png", description: "Green fruits and a sprinkle of coconut"}
        ];
    }

    let productHTML = products.map(product => `
        <div class="product-card">
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>${product.description}</p>
            <button onclick="openPopup('${product.image}', '${product.name}')">Add to Cart</button>
        </div>
    `).join('');

    const productContainer = section.querySelector(".products-display");
    productContainer.innerHTML = productHTML;
}


function openPopup(imageSrc, productName) {
    // Set the image and product name in the popup
    const popupImage = document.querySelector('.popup-image');
    popupImage.src = imageSrc;
    popupImage.alt = productName;

    // Display the popup
    const popup = document.getElementById('popup');
    popup.style.display = 'flex';
}

function closePopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'none';
}

function addToCart(productName) {
    // Use JavaScript to create a URL that adds the chosen product to the cart
    window.location.href = `<?php echo $_SERVER['PHP_SELF']; ?>?buy=${productName}`;
}
