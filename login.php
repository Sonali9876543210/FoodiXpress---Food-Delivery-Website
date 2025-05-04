<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verify password (for now, plain text; recommend hashing with password_hash())
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            header("Location: index.php");
            exit();
        }
    }else {
    echo "<script>alert('User not found! Sign up here.'); window.location.href = 'register.php';</script>";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FoodiXpress</title>
    <link rel="stylesheet" href="../css/style1.css">
</head>
<body>
	<div class="login-container container">
        <h2>Login</h2>
        <form method="post" id="loginForm">
            <label>Username:</label>
			<input type="text" name="username" required><br>
			
			<label>Password:</label>
			<input type="password" name="password" required><br>

			<button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php" target="_blank">Sign Up</a></p>
    </div>
</body>
</html>
