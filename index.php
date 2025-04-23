<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Smart Card System - Login</title>
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
            border: 2px solid #007bff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: green;
            margin-bottom: 20px;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .admin-btn {
            background-color: #dc3545;
        }
        .admin-btn:hover {
            background-color: #c82333;
        }
        a {
            text-decoration: none;
        }
        .footer {
            margin-top: 50px;
            font-size: 14px;
            color: #444;
        }
    </style>
</head>
<body>
    <h1>Smart Card Identification System</h1>
    <div class="form-container">
        <form action="process_login.php" method="post">
            <h2>User Login</h2>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="text" name="card_number" placeholder="Card Number" required><br>
            <input type="submit" value="Login">
        </form>
        <br>
        <a href="register.php"><button>Register</button></a><br>
        <a href="admin_login.php"><button class="admin-btn">Admin Login</button></a>
    </div>

    <div class="footer">
        &copy; 2025 JOSPHAT CHERUIYOT KOSKEI. All rights reserved.
    </div>
</body>
</html>
