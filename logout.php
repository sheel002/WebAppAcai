<?php
session_start();
unset($_SESSION['logged_in']);
// or $_SESSION['logged_in'] = false;
header('Location: index.php');
exit();
?>