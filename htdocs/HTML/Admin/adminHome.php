
<?php

session_start();
if ((!isset ($_SESSION["username"])) || (!isset ($_SESSION["administrator"]))){
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
        <a class ="active" href="adminHome.php">Home</a>
        <a href="addEmployee.php">Add Employee</a>
        <a href="addInventory.php">Add Inventory</a>
        <a href="addClass.php">Add Class</a>
        <div class= "subgroup">
        <?php
         echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
        ?>
        <a href="../../PHP/logout.php">|Log Out|</a>
        <img src="../../img/Icon2.png" alt="Icon"> <!-- icon needs to be 50px by 50px -->
        </div>
    </div>
    <div class="mainContent">
        <h1>Admin Home Page</h1>
        <p style="font-size: 20px;"><strong>Add Employee:</strong> Admins can easily onboard new employees with this page. Enter their school email address and assign a temporary password. The system automatically sends an email for email verification and password change, ensuring secure access.</p>
        <p style="font-size: 20px;"><strong>Add Inventory: </strong> inventory management. Add new items effortlessly by providing the equipment's name and its unique ID. This page streamlines the process of expanding your inventory database.</p>
        <p style="font-size: 20px;"><strong>Add Class: </strong>Managing student access is a breeze. Use this page to add classes of students authorized to check out equipment. By inputting class details, you control who has access, ensuring equipment lending is organized and controlled.</p>
    </div>
</body>
<footer>
    <div class="footergroup">
    <p>CopyRight                          (999)999-9999</p>
    <p>123 street ave, Normal IL</p>
    </div>
</footer>
</html>