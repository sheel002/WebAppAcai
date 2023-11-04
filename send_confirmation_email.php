<?php
session_start();
include('db_connection.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Clear the cart after the order is confirmed
$_SESSION['cart'] = [];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/Exception.php';
require 'path/to/PHPMailer/PHPMailer.php';
require 'path/to/PHPMailer/SMTP.php';


// Check the connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Query to retrieve data from the CheckoutForm table
$checkoutQuery = "SELECT * FROM CheckoutForm WHERE user_id = $userID"; // Replace 'user_id' with your actual column name

$checkoutResult = $conn->query($checkoutQuery);
}

// Define $cartItems (modify this query to match your database schema)
$cartQuery = "SELECT product_name, size, quantity FROM user_cart WHERE user_id = $userID";
$cartResult = $conn->query($cartQuery);

$cartItems = [];

if ($cartResult->num_rows > 0) {
    while ($row = $cartResult->fetch_assoc()) {
        $cartItems[] = $row;
    }
}

if ($checkoutResult->num_rows > 0) {
    $checkoutRow = $checkoutResult->fetch_assoc();
	
// Close the database connection
$conn->close();


function sendConfirmationEmail($to, $subject, $message) {
    $mail = new PHPMailer(true);

// Collect the customer's email address from the session
      $customerEmail = $_SESSION['email'];

    // Retrieve the values from the checkout form
      $customerName = $_POST['name'];
	  $customerEmail = $_POST['email'];
      $customerPhone = $_POST['phone'];
      $customerCountry = $_POST['country'];
      $customerCity = $_POST['city'];
      $customerAddress = $_POST['address'];
      $customerPostalCode = $_POST['postal_code'];
	  
	// Send order confirmation email
    $to = $_SESSION['email']; // Get the customer's email from the session
    $subject = 'Order Confirmation';
    $message = 'Thank you for your order. Here are the details:\n';

    foreach ($cartItems as $item) {
        $message .= "\nProduct: " . $item['name'];
        $message .= "\nSize: " . $item['size'];
        $message .= "\nQuantity: " . $item['quantity'];
        // Add more details as needed
    }
	
	// Update the $message with the data from the CheckoutForm table
    $message .= "\n\nCheckout Form Details:";
    $message .= "\nFull Name: " . $checkoutRow['name'];
	$message .= "\nEmail: " . $checkoutRow['email'];
    $message .= "\nPhone Number: " . $checkoutRow['phone'];
    $message .= "\nCountry: " . $checkoutRow['country'];
    $message .= "\nCity: " . $checkoutRow['city'];
    $message .= "\nAddress: " . $checkoutRow['address'];
    $message .= "\nPostal Code: " . $checkoutRow['postal_code'];
   

    // Initialize PHPMailer and send the email
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'acaiblissproject@gmail.com'; // Replace with your SMTP username
    $mail->Password = 'Icon123456$'; // Replace with your SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('acaiblissproject@gmail.com', 'Acai Bliss');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    $mail->send();
    echo 'Email sent successfully.';
} catch (Exception $e) {
	error_log("Exception caught: " . $e->getMessage());
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>
