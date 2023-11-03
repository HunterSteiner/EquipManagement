
<?php

session_start();
if ((!isset ($_SESSION["username"])) || (!isset ($_SESSION["administrator"]))){
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
    <a class = "active" href="addEmployee.php">Add Employee</a>
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

<form action="../../PHP/addEmployeeIn.php" method="POST">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    

    <label for="firstname">First Name</label>
    <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" required>

    <label for="lastname">Last Name</label>
    <input type="text" placeholder="Enter Last Name" name="lastname" id="lastname" required>

    <label for="username"><b>Email</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>

    <label for="user_type">Privledges:</label>
                <select name="user_type" id=" user_type">
                    <option value="Employee">Employee</option>
                    <option value="Administrator">Administrator</option>
                </select>
    <hr>
    

    <button type="submit" name="save" class="registerbtn">Register</button>
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