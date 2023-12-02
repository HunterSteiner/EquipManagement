
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
    let backArrow = document.getElementById("backbtn");
    backArrow.addEventListener("click",function(){
        window.location.href= "manageInventory.php";

    });

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/addInventoryIn.php',
            data: $('form').serialize(),
            success: function(res) {
              if(res == "1"){
                alert("New Equipment Item created.");
                let errorField = document.getElementById("errorText");
                errorField.innerHTML = "";

              input1 = document.getElementById("equipID");
              input1.value = "";

              input2 = document.getElementById("equipName");
              input2.value = "";

              }else{
                let errorField = document.getElementById("errorText");
                errorField.innerHTML = "Equipment ID is invalid or already used";
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
        <a href="manageEmployee.php">Employees</a>
        <a class= "active" href="manageInventory.php">Inventory</a>
        <a href="manageClass.php">Classes</a>
        <a href="manageStudents.php">Students</a>
        <div class= "subgroup">
        <?php
         echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
        ?>
        <a href="../../PHP/logout.php">|Log Out|</a>
        <img src="../../img/Icon2.png" alt="Icon"> <!-- icon needs to be 50px by 50px -->
       </div>
</div>
<form>
  <div class="container">
  <button type="button" name="back" class="backbtn" id="backbtn"></button>
    <h1>Add Inventory</h1>
    <p>Please fill in this form to create an inventory item.</p>
    <p class ="errorText" id="errorText"></p>
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