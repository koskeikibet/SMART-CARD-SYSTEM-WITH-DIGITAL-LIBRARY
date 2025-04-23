<?php
require 'db/config.php';

$username = $_POST['username'];
$card_number = $_POST['card_number'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, card_number, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $card_number, $password);

if ($stmt->execute()) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Registration Successful</title>
        <style>
            body {
                background-color: #f8f9fa;
                font-family: Arial, sans-serif;
                text-align: center;
                padding: 50px;
                color: #333;
                overflow: hidden;
            }
            h1 {
                font-size: 30px;
                color: #28a745;
            }
            .balloon {
                position: fixed;
                width: 60px;
                height: 80px;
                background-color: #ff6347;
                border-radius: 50%;
                animation: balloon-burst 2s ease-in-out infinite;
                pointer-events: none;
            }
            .balloon:nth-child(1) { animation-delay: 0.5s; }
            .balloon:nth-child(2) { animation-delay: 1s; }
            .balloon:nth-child(3) { animation-delay: 1.5s; }
            @keyframes balloon-burst {
                0% { transform: translateY(0) scale(1); opacity: 1; }
                50% { transform: translateY(-200px) scale(1.5); opacity: 0.8; }
                100% { transform: translateY(0) scale(1); opacity: 0; }
            }
            .message {
                font-size: 20px;
                margin-top: 20px;
                color: #28a745;
            }
            .message a {
                color: #007bff;
                text-decoration: none;
                font-weight: bold;
            }
            .message a:hover {
                text-decoration: underline;
            }

            /* Clapping hands effect */
            .clapping-hands {
                font-size: 50px;
                animation: clapping 0.3s ease-in-out infinite;
                display: inline-block;
                margin-top: 50px;
            }
            .clapping-hands:nth-child(odd) {
                animation-duration: 0.2s; /* Faster claps for speed of light effect */
            }
            @keyframes clapping {
                0% { transform: scale(1); }
                50% { transform: scale(1.2); }
                100% { transform: scale(1); }
            }

            .clap-container {
                position: absolute;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                justify-content: center;
                gap: 20px;
            }
        </style>
    </head>
    <body>
        <h1>Registration Successful!</h1>
        <div class='message'>
            <p>Welcome, <strong>$username</strong>, you've successfully registered. <a href='index.php'>Login here</a>.</p>
        </div>

        <!-- Balloon Animations -->
        <div class='balloon' style='top: 50px; left: 20%;'></div>
        <div class='balloon' style='top: 50px; left: 40%;'></div>
        <div class='balloon' style='top: 50px; left: 60%;'></div>
        <div class='balloon' style='top: 50px; left: 80%;'></div>

        <!-- Clapping Hands Animation -->
        <div class='clap-container'>
            <div class='clapping-hands'>👏</div>
            <div class='clapping-hands'>👏</div>
            <div class='clapping-hands'>👏</div>
        </div>
    </body>
    </html>
    ";
} else {
    echo "Error: " . $conn->error;
}
?>
