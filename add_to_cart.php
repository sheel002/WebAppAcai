<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        echo json_encode(['status' => 'error', 'message' => 'Please login first']);
        exit;
    }

    $_POST = json_decode(file_get_contents('php://input'), true);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'size' => $_POST['size'],
        'quantity' => $_POST['quantity'],
        'category' => $_POST['category'],
        'addOns' => $_POST['addOns']
    ];

    echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>