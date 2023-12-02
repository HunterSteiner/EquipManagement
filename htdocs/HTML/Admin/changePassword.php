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
        window.location.href= "manageEmployee.php";

    });
    let passwordFillLine = document.getElementById("fillPasswordLine");
    let newString = "Please fill in a new password for <strong>"+ sessionStorage.getItem("selectedEmployee") + "</strong>";
    passwordFillLine.innerHTML = newString;
    
    let submitButton = document.getElementById("submitButton");
    submitButton.addEventListener("click", function(){
        let passwordVal = document.getElementById("passwordVal");
        let passwordConf = document.getElementById("passwordConf");
        if(passwordVal.value && passwordConf.value){
          if(passwordVal.value === passwordConf.value){

        let values = {
                      'employeeId': sessionStorage.getItem("selectedEmployee"),
                      'employeePassword': passwordVal.value
                    };
        $.ajax({
            type: 'post',
            url: '../../PHP/changePasswordFile.php',
            data: values,
            success: function(res) {
                console.log(res);
                let errorField = document.getElementById("errorText");
                errorField.innerHTML = "";

              alert("Password Changed.");

              input1 = document.getElementById("passwordVal");
              input1.value = "";

              input2 = document.getElementById("passwordConf");
              input2.value = "";

              }
              
                

        });
      }else{
        let errorField = document.getElementById("errorText");
        errorField.innerHTML = "Passwords do not match";

      }
      }else{
        let errorField = document.getElementById("errorText");
        errorField.innerHTML = "Please fill out all fields";
      }

    });

});
</script>

</head>
<body>
  <div class="menuBar">
        <a href="adminHome.php">Home</a>
        <a class= "active" href="manageEmployee.php">Employees</a>
        <a href="manageInventory.php">Inventory</a>
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
    <h1>Change Password</h1>
    <p id = "fillPasswordLine">Please fill in a new password</p>
    <p id= "errorText" class= "errorText">Error</p>
    <hr>
    

    <label for="passwordVal">New Password:</label>
    <input type="password" placeholder="Enter New Password" name="passwordVal" id="passwordVal" required>

    <label for="passwordConf">Confirm New Password</label>
    <input type="password" placeholder="Enter New Password" name="passwordConf" id="passwordConf" required>

    <hr>

    <button type="button" name="save" class="registerbtn" id = "submitButton">Change</button>
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