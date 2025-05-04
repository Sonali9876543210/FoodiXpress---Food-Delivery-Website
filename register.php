<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registration successful! Click OK to go to the login page.');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "<p style='color:red'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FoodiXpress</title>
    <link rel="stylesheet" href="../css/style1.css">
</head>
<body>
	<div class="signup-container container">
		<form method="post">
			<h2>Sign Up</h2>
			<label>Username:</label>
			<input type="text" name="username" required><br>

			<label>Password:</label>
			<input type="password" name="password" required><br>

			<button type="submit">Register</button>
		</form>
		<p>Already have an account? <a href="login.php">Login here</a></p>
	</div>
</body>
</html>