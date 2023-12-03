
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
    <title>Admin Home</title>
    <link rel="icon" type="image/x-icon" href="../../Favicon2.ico" />
    <link rel="stylesheet" href="../../CSS/adminHomeV2.css" />
</head>
<body>
    <div class="menuBar">
        <a class ="active" href="adminHome.php">Home</a>
        <a href="manageEmployee.php">Employees</a>
        <a href="manageInventory.php">Inventory</a>
        <a href="manageClass.php">Classes</a>
        <a href="manageStudents.php">Students</a>
        <div class= "subgroup">
        <?php
         echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
        ?>
        <a href="../../PHP/logout.php">|Log Out|</a>
        
        </div>
    </div>
    <div class="mainContent">
        <h1>Admin Home Page</h1>
        <p class = "welcome"> Welcome to the Equipment Web Checkout System!</p>
        <p class="middlePara2"><strong>Employees: </strong>This refers to everyone who has an account saved within the database. On the Employee page, you can see each employee, as well as the ability to select, edit, delete, and change the passwords of each account. You also have the ability to add or remove admin privledges.</p>
        <p class="middlePara2"><strong>Inventory: </strong> This refers to all equipment items that are available to rent to students. On the invenory page, you can view all inventory items that exist in the database. You can also edit the names, manually set the availability and delete them if needed.</p>
        <p class="middlePara2"><strong>Classes: </strong>This refers to the classes authorized to get equipment. On the class page, you can view all classes currently saved in the database. You are also able to select and edit classes and delete, as well as add new ones.</p>
        <p class="middlePara2"><strong>Students: </strong>This refers to the students that belong to the authorized classes. On the students page, you are able to select a class and view all students currently placed inside. This is where you can add/ remove students or edit them in any way.</p>
        <p class="notice"><strong>Notice:</strong>Be careful when deleting an item, as recovering them would require accessing the database directly.</p>
    </div>
</body>
<footer>
    <div class="footergroup">
    <p>CopyRight                          (999)999-9999</p>
    <p>123 street ave, Normal IL</p>
    </div>
</footer>
</html>