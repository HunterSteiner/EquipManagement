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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  $(function () {

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/manageStudentsFile.php',
            data: $('form').serialize(),
            success: function(res) {

              var start = document.getElementById("loadLocation");
                
              var array = JSON.parse(res);

              for(i=0; i<array.length; i++){
                line = document.createElement("p");
                text = document.createTextNode(array[i]);
                line.appendChild(text);
                start.appendChild(line);

              }
              
                
            }

        });
    });

});
</script>

</head>
<body>
  <div class="menuBar">
        <a href="adminHome.php">Home</a>
        <a href="addEmployee.php">Add Employee</a>
        <a href="addInventory.php">Add Inventory</a>
        <a class= "active" href="addClass.php">Add Class</a>
        <div class= "subgroup">
        <?php
            echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
         ?>
         <a href="../../PHP/logout.php">|Log Out|</a>
        <img src="../../img/Icon2.png" alt="Icon"> <!-- icon needs to be 50px by 50px -->
       </div>
</div>
<div class="extended-form">
<form>
  <div class="container">
    <h1>Manage Students</h1>
    <p>Please fill in class ID to display students</p>
    <hr>
    <label for="classID">Display Class</label>
    <input type="text" placeholder="Enter Class ID" name="classID" id="classID" required>
    <button type="submit" name="save" class="registerbtn">Display</button>
  </div>
</form>
 <h4 id="loadLocation">Student List:</h4>
 
 
</div>

</body>
<footer>
    <div class="footergroup">
    <p>CopyRight                          (999)999-9999</p>
    <p>123 street ave, Normal IL</p>
    </div>
</footer>
</html>