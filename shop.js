document.addEventListener("DOMContentLoaded", function() {
    populateProducts('smoothies', 'smoothieSection');
    populateProducts('bowls', 'bowlSection');
});

function populateProducts(category, sectionId) {
    const section = document.getElementById(sectionId);

    let products = [];
    if (category === 'smoothies') {
        products = [
            {name: "Berry Blast", image: "Assets/product1.png", description: "A berry-filled delight"},
            {name: "Tropical Twist", image: "Assets/product1.png", description: "A tropical sensation"}
            // Add more products as needed
        ];
    } else if (category === 'bowls') {
        products = [
            {name: "Classic Acai Bowl", image: "Assets/product1.png", description: "The classic favorite"},
            {name: "Peanut Butter Bliss", image: "Assets/product1.png", description: "Creamy peanut butter goodness"}
            // Add more products as needed
        ];
    }

    let productHTML = products.map(product => `
        <div class="product-card">
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>${product.description}</p>
            <button>Add to Cart</button>
        </div>
    `).join('');

    section.innerHTML = productHTML;
}
