
<?php

session_start();
if (!isset ($_SESSION["username"])){
    header ("Location: ../../index.html");
    die;
} 

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../CSS/addEmployee.css" />

</head>
<body>
  <div class="menuBar">
        <a href="adminHome.php">Home</a>
        <a href="addEmployee.php">Add Employee</a>
        <a class= "active" href="addInventory.php">Add Inventory</a>
        <a href="addClass.php">Add Class</a>
        <a href="manageStudents.php">Manage Students</a>
        <div class= "subgroup">
        <?php
         echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
        ?>
        <a href="../../PHP/logout.php">|Log Out|</a>
        <img src="../../img/Icon2.png" alt="Icon"> <!-- icon needs to be 50px by 50px -->
       </div>
</div>
<form action="../../PHP/addInventoryIn.php" method="POST">
  <div class="container">
    <h1>Add Inventory</h1>
    <p>Please fill in this form to create an inventory item.</p>
    <hr>
    

    <label for="equipID">Equipment ID</label>
    <input type="text" placeholder="Enter Equipment ID" name="equipID" id="equipID" required>

    <label for="equipName">Equipment Name</label>
    <input type="text" placeholder="Enter Equipment Name" name="equipName" id="equipName" required>

    <hr>

    <button type="submit" name="save" class="registerbtn">Add</button>
  </div>
  
  
</form>

</body>
<footer>
    <div class="footergroup">
    <p>CopyRight                          (999)999-9999</p>
    <p>123 street ave, Normal IL</p>
    </div>
</footer>
</html>