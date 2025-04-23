<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "card_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $card_number = trim($_POST['card_number']);

    // Validate input
    if (empty($username) || empty($card_number)) {
        $_SESSION['error'] = "All fields are required";
        header("Location: register.php");
        exit();
    }

    // Check if username already exists
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    if ($check_stmt->get_result()->num_rows > 0) {
        $_SESSION['error'] = "Username already exists";
        header("Location: register.php");
        exit();
    }

    // Check if card number already exists
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE card_number = ?");
    $check_stmt->bind_param("s", $card_number);
    $check_stmt->execute();
    if ($check_stmt->get_result()->num_rows > 0) {
        $_SESSION['error'] = "Card number already exists";
        header("Location: register.php");
        exit();
    }

    // Insert new user
    $sql = "INSERT INTO users (username, card_number) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $card_number);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! You can now login.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error during registration. Please try again.";
        header("Location: register.php");
        exit();
    }
}

$conn->close();
?> 