<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Smart Card System</title>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        h1 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 30px;
        }
        .dashboard-links a {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            font-size: 18px;
            text-decoration: none;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .dashboard-links a:hover {
            background-color: #218838;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        p {
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Smart Card Authentication System, <?php echo $_SESSION['username']; ?>!</h1>
        
        <div class="dashboard-links">
            <a href="books.php">View and Download Books</a>
            <p><a href="logout.php"><button class="logout-btn">Logout</button></a></p>
        </div>
    </div>
</body>
</html>
