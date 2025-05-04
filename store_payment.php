<?php
session_start();
$conn = new mysqli("localhost", "root", "", "foodixpress");

// Ensure order ID exists
if (!isset($_SESSION['order_id']) || empty($_SESSION['order_id'])) {
    die("Order ID missing. Please start a new order. <a href='foods.html'>Go back</a>");
}

$order_id = $_SESSION['order_id'];
$payment_method = $_POST['payment'];

$conn->query("INSERT INTO payment (order_id, payment_method) VALUES ('$order_id', '$payment_method')");
$conn->query("UPDATE orders SET order_status='Completed' WHERE id='$order_id'");

session_destroy();

header("Location: thankyou.html");
exit();
?>
