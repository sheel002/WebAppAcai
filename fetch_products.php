<?php
include 'db_connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function fetchProducts($db, $category) {
    $products = [];

    // Prepare and execute a SQL query to fetch products based on the category
    $sql = "SELECT * FROM Products WHERE Category = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $baseURL = "http://localhost:8000/WebAppAcai/"; // Replace with your actual website URL
            $relativePath = $row['ImageURL'];
            $fullImageURL = $baseURL . $relativePath;

            $products[] = [
                'Name' => $row['Name'],
                'Ingredients' => $row['Ingredients'],
                'ImageURL' => $fullImageURL,
            ];
        }
    }

    return $products;
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $products = fetchProducts($db, $category);
    header('Content-Type: application/json');
    echo json_encode(['products' => $products]);
}
?>
