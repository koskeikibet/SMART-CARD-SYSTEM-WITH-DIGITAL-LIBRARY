<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <style>
        body {
            background-color: #d4edda; /* light green background */
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #155724;
        }
        h1 {
            color: #1d643b;
            text-align: center;
        }
        .book-list {
            display: flex;
            flex-wrap: wrap; /* Wrap items if they overflow */
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .book-item {
            background-color: #f8f9fa;
            padding: 15px;
            border: 2px solid #28a745; /* green border */
            border-radius: 8px;
            width: 200px; /* Fixed width for each book */
            text-align: center;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .book-item a {
            color: #0d6efd;
            text-decoration: none;
        }
        .book-item a:hover {
            text-decoration: underline;
        }
        .back-link {
            text-align: center;
            margin-top: 40px;
        }
        .back-link a {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-link a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Here are our services you are free to check them ✅</h1>
    <div class="book-list">
        <div class="book-item">
            <a href="https://dn721608.ca.archive.org/0/items/rich-dad-poor-dad_202106/Rich%20Dad%20Poor%20Dad.pdf" download="Rich_Dad_Poor_Dad.pdf">1. Rich Dad Poor Dad</a>
        </div>
        <div class="book-item">
            <a href="https://camaapearl.files.wordpress.com/2016/02/cashflow1.pdf" download="Cashflow_Quadrant.pdf">2. Cashflow Quadrant</a>
        </div>
        <div class="book-item">
            <a href="https://www.propmgmtforms.com/forms/ebooks/robert-kiyosaki-the-real-book-of-real-estate.pdf" download="The_Real_Book_of_Real_Estate.pdf">3. The Real Book of Real Estate</a>
        </div>
        <div class="book-item">
            <a href="https://archive.org/details/the-businessofthe-21st-century" download="The_Business_of_the_21st_Century.pdf">4. The Business of the 21st Century</a>
        </div>
        <div class="book-item">
            <a href="https://www.bookdio.org/bestsellers/rich-dad%E2%80%99s-success-stories" download="Rich_Dad_Success_Stories.pdf">5. Rich Dad's Success Stories</a>
        </div>
        <div class="book-item">
            <a href="https://vinalayan.files.wordpress.com/2017/10/escape-the-rat-race-2014.pdf" download="Escape_the_Rat_Race.pdf">6. Escape the Rat Race</a>
        </div>
        <div class="book-item">
            <a href="https://rd-downloads-01.s3.amazonaws.com/UnfairAdvantageDownload.pdf" download="Unfair_Advantage.pdf">7. Unfair Advantage</a>
        </div>
        <div class="book-item">
            <a href="https://www.richdad.com/ebooks" download="Conspiracy_of_the_Rich.pdf">8. Conspiracy of the Rich</a>
        </div>
        <div class="book-item">
            <a href="https://www.businesswire.com/news/home/20141006005380/en/Rich-Dad%E2%80%99s-Prophecy-Now-Available-for-Free-eBook-Download" download="Rich_Dads_Prophecy.pdf">9. Rich Dad's Prophecy</a>
        </div>
        <div class="book-item">
            <a href="https://www.businesswire.com/news/home/20141027005324/en/Who-Took-My-Money-Now-Available-for-FREE-eBook-Download" download="Who_Took_My_Money.pdf">10. Who Took My Money?</a>
        </div>
    </div>

    <div class="back-link">
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
