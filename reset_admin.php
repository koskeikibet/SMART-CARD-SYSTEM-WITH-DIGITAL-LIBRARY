<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "card_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// First, clear the admins table
$conn->query("TRUNCATE TABLE admins");

// Set new admin credentials
$username = "admin";
$password = "admin1234";

// Hash the password properly
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new admin
$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    echo "<div style='text-align: center; margin-top: 50px; font-family: Arial, sans-serif;'>";
    echo "<h2 style='color: #28a745;'>Admin Account Reset Successfully!</h2>";
    echo "<p>New admin credentials:</p>";
    echo "<p><strong>Username:</strong> admin</p>";
    echo "<p><strong>Password:</strong> admin1234</p>";
    echo "<p><a href='admin_login.php' style='display: inline-block; background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Login</a></p>";
    echo "</div>";
} else {
    echo "Error creating admin account: " . $conn->error;
}

$conn->close();
?> 