<?php
    $justjava= $_POST['just_java_num_1'];
    $cafe1= $_POST['cafe_num_1'];
    $cafe2=$_POST['cafe_num_2'];
    $icedcap1= $_POST['iced_cap_num_1'];
    $icedcap2= $_POST['iced_cap_num_2'];

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