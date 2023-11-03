
CREATE TABLE users (
    UserID int(11) NOT NULL AUTO_INCREMENT,
    Name varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    Email varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    Password varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    Address text COLLATE utf8mb4_general_ci,
    PRIMARY KEY (UserID)
);

CREATE TABLE contact_form (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    email VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    subject VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    message TEXT COLLATE utf8mb4_general_ci NOT NULL
);

 
CREATE TABLE user_cart (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NULL,
    product_name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
    product_price DECIMAL(10,2) NULL,
    size VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
    quantity INT(11) NULL,
    category VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
    add_ons TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) DEFAULT NULL,
    image VARCHAR(255) DEFAULT NULL,
    ingredients TEXT DEFAULT NULL,
    inventory INT(11) DEFAULT NULL
);



INSERT INTO products (id, name, price, category, image, ingredients)
VALUES 
(1, 'Pineapple Sundance Smoothie', 5.99, 'smoothies', 'Assets/smoothie1.png', 'Pineapple, Banana, Orange Juice, Lime Zest'),
(2, 'Berry Medley Smoothie', 6.49, 'smoothies', 'Assets/smoothie2.png', 'Blueberries, Strawberries, Almond Milk, Chia Seeds'),
(3, 'Golden Glow Smoothie', 6.99, 'smoothies', 'Assets/smoothie3.png', 'Mango, Pineapple, Honey, Coconut Milk'),
(4, 'Minty Melon Smoothie', 5.49, 'smoothies', 'Assets/smoothie4.png', 'Watermelon, Mint Leaves, Lime Juice, Agave Syrup'),
(5, 'Creamy Caramel Crunch Smoothie', 7.49, 'smoothies', 'Assets/smoothie5.png', 'Dates, Cashews, Almond Milk, Caramel Syrup'),
(6, 'Tropical Bliss Bowl', 7.99, 'bowls', 'Assets/bowl1.png', 'Mango, Kiwi, Coconut Flakes, Chia Seeds'),
(7, 'Nutty Forest Bowl', 8.49, 'bowls', 'Assets/bowl2.png', 'Almonds, Dark Chocolate, Granola, Honey'),
(8, 'Citrus Splash Bowl', 7.49, 'bowls', 'Assets/bowl3.png', 'Oranges, Grapefruit, Goji Berries, Mint'),
(9, 'Green Oasis Bowl', 8.99, 'bowls', 'Assets/bowl4.png', 'Spinach, Avocado, Hemp Seeds, Lime Zest'),
(10, 'Ruby Indulgence Bowl', 9.49, 'bowls', 'Assets/bowl5.png', 'Raspberries, Strawberries, Cacao Nibs, Almond Butter');



UPDATE products SET inventory = 10;

