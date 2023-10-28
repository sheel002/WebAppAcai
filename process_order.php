<?php
session_start();

include 'db_connection.php'; // replace with your actual database connection file

$data = json_decode(file_get_contents("php://input"));

// Ensure a user is logged in
if (!isset($_SESSION['UserID'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

// Calculate the total price of the order
$totalPrice = 0;
foreach ($data as $item) {
    $stmt = $conn->prepare("SELECT price FROM Products WHERE product_id = ?");
    $stmt->execute([$item->productID]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
        exit;
    }
    
    $totalPrice += $product['price'] * $item->quantity;
}

// Begin a transaction
$conn->beginTransaction();

try {
    // Insert into Orders table
    $stmt = $conn->prepare("INSERT INTO Orders (UserID, Date, TotalPrice) VALUES (?, NOW(), ?)");
    $stmt->execute([$_SESSION['UserID'], $totalPrice]);

    $orderId = $conn->lastInsertId();

    // Insert items from cart into OrderDetails
    foreach ($data as $item) {
        $stmt = $conn->prepare("INSERT INTO OrderDetails (OrderID, ProductID, Quantity) VALUES (?, ?, ?)");
        $stmt->execute([$orderId, $item->productID, $item->quantity]);
    }

    // Commit the transaction
    $conn->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>


