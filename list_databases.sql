
CREATE TABLE Users (
     UserID INT PRIMARY KEY AUTO_INCREMENT,
     Name VARCHAR(255),
     Email VARCHAR(255) UNIQUE,
     Password VARCHAR(255),
     Address TEXT
 );

CREATE TABLE ContactForm (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    subject VARCHAR(255),
    message TEXT
);
 
CREATE TABLE user_cart (
    id INT PRIMARY KEY,
    user_id INT,
    product_name VARCHAR(255),
    product_price DECIMAL(10, 2),
    size VARCHAR(50),
    quantity INT,
    category VARCHAR(255),
    add_ons VARCHAR(255),
    created_at TIMESTAMP
);

CREATE TABLE products (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10, 2),
    category VARCHAR(255),
    image VARCHAR(255),
    ingredients TEXT
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