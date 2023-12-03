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
    <title>Employee Home</title>
    <link rel="icon" type="image/x-icon" href="../../Favicon2.ico" />
    <link rel="stylesheet" href="../../CSS/employeeHomeV2.css" />
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
        </div>
    </div>
    <div class="mainContent">
        <h1>Employee Home Page</h1>
        <p class = "welcome"> Welcome to the Equipment Web Checkout System!</p>
        <div class="paraGroup">
        
        <div class="firstParaSec">
        <p class="firstPara"><strong>Checkout Page:</strong> This page is where you can facilitate equipment checkouts by officially recording when a student takes an equipment item from inventory.</p>
        <p class="secondPara"><strong>Info:</strong></p>
        <ul>
            <li>You can either manually fill out the fields or select both an equipment item and student from the displayed lists.</li>
            <li>The employee id field and student id field both accept up to a 9 digit value, which must be a pre-existing ID number.</li>
            <li>You can access students by class using the drop down, which contains all active classes. Next to the drop down is the button to display the students.</li>
            <li>You can scroll through multiple pages of available equipment, if available. The page will display 18 at a time.</li>
            <li>After checking out an equipment item, it will automatically be removed from the list displayed, to avoid attempting to double checkout.</li>
        </ul>
        </div>

        
        
        <div class="secondParaSec">
        <p class="firstPara"><strong>Return Page:</strong> This page is where you can facilitate equipment returns by officialy recording when a student returns an item to inventory.</p>
        <p class="secondPara"><strong>Info:</strong></p>
        <ul>
            <li>You can either manually fill out the fields or select proper outstanding equipment line.</li>
            <li>The employee id field and student id field both accept up to a 9 digit value, which must be a pre-existing ID number.</li>
            <li>You can scroll through multiple pages of outstanding equipment, if available. The page will display 18 at a time.</li>
            <li>After checking out an equipment item, it will automatically be removed from the list displayed, to avoid attempting to double return.</li>
        </ul>
        </div>
        <div class="thirdParaSec">
        <p class = "firstPara"><strong>Log Page: </strong> This is where all records can be retreived. All new records created are automatically displayed. </p>
        <p class="secondPara"><strong>Info:</strong></p>
        <ul>
            <li>By default, the page displays the last 25 transactions recorded.</li>
            <li>You can scroll through multiple pages of logs, if available.</li>
            <li>You can also retrieve all records based on equipment ID by filling in the equipment ID field and hitting 'search'.</li>
            <li>If you wish to access the recent logs again, either hit reset or refresh the page.</li>
        </ul>
        </div>
        </div>
    </div>
</body>
<footer>
    <div class="footergroup">
    <p>CopyRight                          (999)999-9999</p>
    <p>123 street ave, Normal IL</p>
    </div>
</footer>
</html>