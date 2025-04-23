<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Smart Card System - Admin Login</title>
    <style>
        body {
            background-color: silver;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
            color: #333;
        }
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            width: 350px;
            margin: auto;
            border: 2px solid #dc3545;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #dc3545;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #dc3545;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #c82333;
        }
        .back-btn {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            text-decoration: none;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
        .error-message {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            display: none;
        }
        .error-message.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Admin Login</h1>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="error-message show">
                <?php 
                    echo htmlspecialchars($_SESSION['error']);
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        <form action="process_admin_login.php" method="post">
            <input type="text" name="username" placeholder="Admin Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
        <br>
        <a href="index.php" class="back-btn">Back to Main</a>
    </div>
</body>
</html> 