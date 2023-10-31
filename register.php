<?php
session_start();

include 'db_connection.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT Email FROM Users WHERE Email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        $message = "Email already registered!";
    } else {
        // Hash the password and insert the new user into the database
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO Users (Name, Email, Password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $passwordHash]);
        $message = "Registration successful!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<body>
    
    <?php if($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form method="post" action="">
        Name: <input type="text" name="name">
        Email: <input type="email" name="email">
        Password: <input type="password" name="password">
        <input type="submit" value="Register">
    </form>
</body>
</html>
