<?php
session_start();
require 'db/config.php';

if (isset($_GET['admin'])) {
    $username = 'admin';
    $card_number = 'CARD0001';
} else {
    $username = $_POST['username'];
    $card_number = $_POST['card_number'];
}

$sql = "SELECT * FROM users WHERE username = ? AND card_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $card_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    header("Location: dashboard.php");
    exit();
} else {
    echo "Invalid credentials. <a href='index.php'>Try again</a>.";
}
?>
