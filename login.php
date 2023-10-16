<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // In a real application, you would validate credentials and perform proper security checks here.
    // Example: Check the credentials against a database of users.

    if ($username === "Jem" && $password === "123456") {
        // Successful login
        echo "Login successful!";
    } else {
        // Failed login
        echo "Login failed. Please try again.";
    }
}
?>
