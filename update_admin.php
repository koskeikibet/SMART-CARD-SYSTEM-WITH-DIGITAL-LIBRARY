<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "card_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_username = trim($_POST['new_username']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Get current admin data
    $stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['admin_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    // Verify current password
    if (password_verify($current_password, $admin['password'])) {
        if ($new_password !== $confirm_password) {
            $error_message = "New passwords do not match!";
        } else {
            $updates = array();
            $types = "";
            $values = array();

            // Check if username needs to be updated
            if (!empty($new_username) && $new_username !== $admin['username']) {
                // Check if new username already exists
                $check_stmt = $conn->prepare("SELECT id FROM admins WHERE username = ? AND id != ?");
                $check_stmt->bind_param("si", $new_username, $_SESSION['admin_id']);
                $check_stmt->execute();
                if ($check_stmt->get_result()->num_rows > 0) {
                    $error_message = "Username already exists!";
                } else {
                    $updates[] = "username = ?";
                    $types .= "s";
                    $values[] = $new_username;
                }
            }

            // Check if password needs to be updated
            if (!empty($new_password)) {
                $updates[] = "password = ?";
                $types .= "s";
                $values[] = password_hash($new_password, PASSWORD_DEFAULT);
            }

            // If there are updates and no errors
            if (!empty($updates) && empty($error_message)) {
                $sql = "UPDATE admins SET " . implode(", ", $updates) . " WHERE id = ?";
                $types .= "i";
                $values[] = $_SESSION['admin_id'];

                $update_stmt = $conn->prepare($sql);
                $update_stmt->bind_param($types, ...$values);
                
                if ($update_stmt->execute()) {
                    $success_message = "Admin credentials updated successfully!";
                    if (!empty($new_username)) {
                        $_SESSION['admin_username'] = $new_username;
                    }
                } else {
                    $error_message = "Error updating credentials!";
                }
            }
        }
    } else {
        $error_message = "Current password is incorrect!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Admin Credentials - Smart Card System</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #dc3545;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background-color: #dc3545;
            color: white;
        }
        .btn-primary:hover {
            background-color: #c82333;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .alert {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Admin Credentials</h1>
        
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            
            <div class="form-group">
                <label for="new_username">New Username (leave blank to keep current):</label>
                <input type="text" id="new_username" name="new_username">
            </div>
            
            <div class="form-group">
                <label for="new_password">New Password (leave blank to keep current):</label>
                <input type="password" id="new_password" name="new_password">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>
            
            <div class="buttons">
                <button type="submit" class="btn btn-primary">Update Credentials</button>
                <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?> 