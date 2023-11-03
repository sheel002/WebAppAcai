<?php

include 'db_connection.php';

header('Content-Type: application/json');


include 'db_connection.php';

$category = $_GET['category'] ?? '';

$stmt = $conn->prepare("SELECT name, price, image, ingredients FROM products WHERE category = ?");
$stmt->execute([$category]);
$result = $stmt->get_result();
// $products = $result->fetch_all(PDO::FETCH_ASSOC);

// Fetch data
$products = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
<<<<<<< HEAD
        $products[] = $row;
    }
}

echo json_encode($products);
=======
        $acai_products[] = $row;
    }
}

echo json_encode($acai_products);
>>>>>>> 1f34b75c239be0b3358ba491b6f7e09861e59ec5

$conn->close();
?>
