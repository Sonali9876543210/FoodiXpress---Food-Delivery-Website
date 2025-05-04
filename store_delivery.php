<?php
session_start();
$conn = new mysqli("localhost", "root", "", "foodixpress");

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure order ID exists
if (!isset($_SESSION['order_id']) || empty($_SESSION['order_id'])) {
    die("Order ID missing. Please start a new order. <a href='foods.html'>Go back</a>");
}

$order_id = $_SESSION['order_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$delivery_method = $_POST['delivery-method'];

// Insert into delivery table
$sql = "INSERT INTO delivery (order_id, name, phone, address, delivery_type) 
        VALUES ('$order_id', '$name', '$phone', '$address', '$delivery_method')";

if ($conn->query($sql) === TRUE) {
    header("Location: payment.html");
    exit();
} else {
    die("Error inserting delivery details: " . $conn->error);
}
?>
