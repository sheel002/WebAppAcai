-- Products Table
CREATE TABLE Products (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    ProductName VARCHAR(255) NOT NULL,
    Category VARCHAR(50) NOT NULL,
    Description TEXT,
    BasePrice DECIMAL(10, 2) NOT NULL
);

-- Sizes Table
CREATE TABLE Sizes (
    SizeID INT AUTO_INCREMENT PRIMARY KEY,
    ProductID INT,
    SizeName VARCHAR(50) NOT NULL,
    AdditionalPrice DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

-- AddOns Table
CREATE TABLE AddOns (
    AddOnID INT AUTO_INCREMENT PRIMARY KEY,
    AddOnName VARCHAR(255) NOT NULL,
    AddOnPrice DECIMAL(10, 2) NOT NULL,
    AddOnType VARCHAR(50) NOT NULL
);

-- Order Table
CREATE TABLE Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT NOT NULL,  -- Assuming you have a Users table already
    TotalPrice DECIMAL(10, 2) NOT NULL,
    OrderStatus VARCHAR(50) NOT NULL,
    OrderDate DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- OrderDetails Table
CREATE TABLE OrderDetails (
    OrderDetailID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT,
    ProductID INT,
    SizeID INT,
    Quantity INT NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID),
    FOREIGN KEY (SizeID) REFERENCES Sizes(SizeID)
);

-- OrderAddOns Table
CREATE TABLE OrderAddOns (
    OrderDetailID INT,
    AddOnID INT,
    FOREIGN KEY (OrderDetailID) REFERENCES OrderDetails(OrderDetailID),
    FOREIGN KEY (AddOnID) REFERENCES AddOns(AddOnID)
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