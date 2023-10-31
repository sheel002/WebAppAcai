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
