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
    <a href="employeeHome.php">Home</a>
    <a href="checkout.php">Check-Out</a>
    <a class = "active" href="return.php">Return</a>
    <a href="logs.php">Logs</a>
    <div class= "subgroup">
        <?php
         echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
        ?>
        <a href="../../PHP/logout.php">|Log Out|</a>
        <img src="../../img/Icon2.png" alt="Icon"> <!-- icon needs to be 50px by 50px -->
        </div>
</div>
<form action="../../PHP/returnFile.php" method="POST">
  <div class="container">
    <h1>Return Equipment</h1>
    <p>Please fill in this form to return an equipment item.</p>
    <hr>
    

    <label for="equipmentid">Equipment ID</label>
    <input type="text" placeholder="Enter Equipment ID" name="equipmentid" id="equipmentid" required>

    <label for="studentid">Student ID</label>
    <input type="text" placeholder="Enter Student ID" name="studentid" id="studentid" required>

    <hr>

    <button type="submit" name="save" class="registerbtn">Return</button>
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