<?php
session_start();
include('db_connection.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Validate and sanitize user input
$customerName = htmlspecialchars($_POST['name']);
$customerEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$customerPhone = htmlspecialchars($_POST['phone']);
$customerCountry = htmlspecialchars($_POST['country']);
$customerCity = htmlspecialchars($_POST['city']);
$customerAddress = htmlspecialchars($_POST['address']);
$customerPostalCode = htmlspecialchars($_POST['postal_code']);

// You should add more validation and error handling here as needed.

// Insert data into the CheckoutForm table
$sql = "INSERT INTO CheckoutForm (name, email, phone, country, city, address, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("ssssss", $name, $email, $phone, $country, $city, $address, $postalCode);

if ($stmt->execute()) {
    // Data saved successfully
    echo "Data saved successfully!";
} else {
    // Error occurred
    echo "Error: " . $stmt->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
