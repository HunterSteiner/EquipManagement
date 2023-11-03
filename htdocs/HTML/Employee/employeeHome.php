<?php

session_start();
if (!isset ($_SESSION["username"])){
    header ("Location: ../../index.html");
    die;
} 

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../../CSS/Styles.css" />
</head>
<body>
    <div class="menuBar">
        <a class = "active" href="employeeHome.php">Home</a>
        <a href="checkout.php">Check-Out</a>
        <a href="return.php">Return</a>
        <a href="logs.php">Logs</a>
        <div class= "subgroup">
        <?php
         echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
        ?>
        <a href="../../PHP/logout.php">|Log Out|</a>
        <img src="../../img/Icon2.png" alt="Icon"> <!-- icon needs to be 50px by 50px -->
        </div>
    </div>
    <div class="mainContent">
        <h1>Employee Home Page</h1>
        <p style="font-size: 20px;"><strong>Checkout Page:</strong> This page is where you can efficiently check out equipment to students. Enter the student's name, email, and date, along with the equipment ID they are borrowing. It's a streamlined process to ensure smooth equipment lending</p>
        <p style="font-size: 20px;"><strong>Return Page:</strong> Returning equipment has never been easier. Enter the equipment IDs to verify you have the right items, then specify their condition upon return. This page simplifies the equipment return process, ensuring accuracy.</p>
        <p style="font-size: 20px;"><strong>Log Page: </strong> Want to keep track of equipment lending? The Logs Page provides a comprehensive overview. It displays previous checkouts, who borrowed them, what items were borrowed, the date of borrowing, and the condition they were received in. It's a complete record-keeping solution</p>
    </div>
</body>
<footer>
    <div class="footergroup">
    <p>CopyRight                          (999)999-9999</p>
    <p>123 street ave, Normal IL</p>
    </div>
</footer>
</html>