<?php
session_start();
include('db_connection.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$inputJSON = file_get_contents('php://input');
$cartItems = json_decode($inputJSON, true);

if (empty($cartItems)) {
    echo json_encode(["success" => false, "message" => "No items in cart"]);
    exit;
}

$userId = $_SESSION['user_id']; 
$conn->autocommit(FALSE);

try {
    $insertStmt = $conn->prepare("INSERT INTO user_cart (user_id, product_name, product_price, size, quantity, category, add_ons, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $updateInventoryStmt = $conn->prepare("UPDATE products SET inventory = inventory - ? WHERE name = ?");

    foreach ($cartItems as $item) {
        $addOnsJson = json_encode($item['addOns'] ?? []);
        $price = floatval($item['price']);
        $quantity = intval($item['quantity']);

        // Insert order details into user_cart
        $insertStmt->bind_param("isdssis", $userId, $item['name'], $price, $item['size'], $quantity, $item['category'], $addOnsJson);
        if (!$insertStmt->execute()) {
            throw new Exception("Execute failed: " . $insertStmt->error);
        }

        // Update inventory in products table
        $updateInventoryStmt->bind_param("is", $quantity, $item['name']);
        if (!$updateInventoryStmt->execute()) {
            throw new Exception("Failed to update inventory: " . $updateInventoryStmt->error);
        }
    }

    $conn->commit();
    $_SESSION['cart'] = [];
    echo json_encode(["success" => true, "message" => "Order confirmed successfully"]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["success" => false, "message" => "Error in confirming order: " . $e->getMessage()]);
} finally {
    // Always close the statement and the connection
    $insertStmt->close();
    $updateInventoryStmt->close();
    $conn->close();
}
?>