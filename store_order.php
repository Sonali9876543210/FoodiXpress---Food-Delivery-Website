<?php
session_start();
$conn = new mysqli("localhost", "root", "", "foodixpress");

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['food']) || empty($_POST['food'])) {
        die("No items selected. Please add items to your cart. <a href='foods.html'>Go back</a>");
    }

    $food_items = implode(", ", $_POST['food']);
    $total_price = $_POST['total_price'];

    // Insert into the orders table
    $sql = "INSERT INTO orders (food_items, total_price) VALUES ('$food_items', '$total_price')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['order_id'] = $conn->insert_id;
        header("Location: delivery.html");
        exit();
    } else {
        die("Error inserting order: " . $conn->error);
    }
} else {
    die("Invalid request. <a href='foods.html'>Go back</a>");
}
?>
