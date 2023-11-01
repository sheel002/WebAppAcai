<?php
session_start();
include('db_connection.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Change to 'logged_in' for consistency
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

// Assuming 'user_id' is also stored in session upon successful login.
$userId = $_SESSION['user_id']; 
$conn->autocommit(FALSE);

try {
    $stmt = $conn->prepare("INSERT INTO user_cart (user_id, product_name, product_price, size, quantity, category, add_ons, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

    foreach ($cartItems as $item) {
        $addOnsJson = json_encode($item['addOns'] ?? []);
        $price = floatval($item['price']);
        $quantity = intval($item['quantity']);
        // Ensure that the types in bind_param match the types of the variables
        $stmt->bind_param("isdssis", $userId, $item['name'], $price, $item['size'], $quantity, $item['category'], $addOnsJson);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
    }

    $conn->commit();
    // Clear the cart after successful order
    $_SESSION['cart'] = [];
    echo json_encode(["success" => true, "message" => "Order confirmed successfully"]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["success" => false, "message" => "Error in confirming order: " . $e->getMessage()]);
}

$conn->close();
?>
