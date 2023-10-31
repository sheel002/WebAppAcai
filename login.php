<?php
session_start();
include 'db_connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT UserID, Password FROM Users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userID, $hashedPassword);
    $stmt->fetch();
   

    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        $_SESSION['UserID'] = $userID;
        $_SESSION['logged_in'] = true;  // <-- Add this line
        header("Location: index.php");
        exit;
    } else {
        $message = "Incorrect email or password!";
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <header>
        <div class="logo">
            <img src="Assets/logo.png" alt="Your Logo">
        </div>
        <div class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="outlets.php">Outlets</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="faq.php">FAQ</a></li>
            </ul>
        </div>
    </header>
    <div class="login-container">
        <?php if($message): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>

    <form method="post" action="">
        Email: <input type="email" name="email">
        Password: <input type="password" name="password">
        <input type="submit" value="Login">
    </form>
</body>
</html>