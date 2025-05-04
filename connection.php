<?php
$host = "localhost";
$user = "root";  // Change if you have a different MySQL user
$password = "";
$database = "foodixpress";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
