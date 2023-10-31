<?php
    // Establish a connection to your local database (replace with your own credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webappacai";

    // Create connection
    @ $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>