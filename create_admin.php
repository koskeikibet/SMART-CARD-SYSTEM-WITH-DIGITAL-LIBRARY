<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "card_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin credentials
$admin_username = "admin";
$admin_password = "admin123";

// Hash the password
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// First, delete existing admin user if exists
$delete_sql = "DELETE FROM admins WHERE username = ?";
$delete_stmt = $conn->prepare($delete_sql);
$delete_stmt->bind_param("s", $admin_username);
$delete_stmt->execute();

// Insert new admin user
$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $admin_username, $hashed_password);

if ($stmt->execute()) {
    echo "Admin user created successfully!<br>";
    echo "Username: admin<br>";
    echo "Password: admin123<br>";
    echo "<a href='admin_login.php'>Go to Admin Login</a>";
} else {
    echo "Error creating admin user: " . $conn->error;
}

$conn->close();
?> 