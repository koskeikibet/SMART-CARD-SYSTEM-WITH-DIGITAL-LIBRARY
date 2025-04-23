<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "card_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_username'] = $row['username'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password";
            header("Location: admin_login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid username";
        header("Location: admin_login.php");
        exit();
    }
}

$conn->close();
?> 