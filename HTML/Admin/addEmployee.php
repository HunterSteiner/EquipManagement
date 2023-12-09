
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
<title>Add Employee</title>
<link rel="icon" type="image/x-icon" href="../../Favicon2.ico" />
<link rel="stylesheet" href="../../CSS/addEmployee.css" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  $(function () {
    let backArrow = document.getElementById("backbtn");
    backArrow.addEventListener("click",function(){
        window.location.href= "manageEmployee.php";
    });

    
    let registerBtn = document.getElementById("registerBtn");
    
    registerBtn.addEventListener("click", function(){
      
     
      let input1 = document.getElementById("fullname");
      console.log(input1.value);
      let input3 = document.getElementById("username");
      console.log(input3.value);
      let input4 = document.getElementById("psw");
      console.log(input4.value);
      let input5 = document.getElementById("pswrepeat");
      console.log(input5.value);
      let input6 = document.getElementById("user_type");
      console.log(input6.value);
      if(input1.value && input3.value && input4.value && input5.value){
        if(input4.value === input5.value){

      console.log("this is running?");
      let values = {
        'fullname': input1.value,
        'username': input3.value,
        'user_type': input6.value,
        'psw': input4.value
      }

        $.ajax({
            type: 'post',
            url: '../../PHP/addEmployeeIn.php',
            data: values,
            success: function(res) {
              console.log(res);
              if(res == "1"){
                let errorLine = document.getElementById("errorText");
                errorLine.innerHTML = "";
                alert("Employee created.");
                input1 = document.getElementById("fullname");
                input1.value = "";

                input3 = document.getElementById("username");
                input3.value = "";

                input4 = document.getElementById("psw");
                input4.value = "";

                input5 = document.getElementById("pswrepeat");
                input5.value = "";

                

              }else{
                let errorLine = document.getElementById("errorText");
                errorLine.innerHTML = "Email is already used.";

              }
              
              
                
            },
            

        });
        }else{
          let errorLine = document.getElementById("errorText");
           errorLine.innerHTML = "Passwords do not match.";

        } 
      }else{
        let errorLine = document.getElementById("errorText");
        errorLine.innerHTML = "Please Fill in all fields.";

      }
      });
    

});
</script>


</head>
<body>
  <div class="menuBar">
    <a href="adminHome.php">Home</a>
    <a class = "active" href="manageEmployee.php">Employees</a>
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

<form id="thisform">
  <div class="container">
  <button type="button" name="back" class="backbtn" id="backbtn"></button>
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <p class ="errorText" id="errorText"></p>
    <hr>
    

    <label for="firstname">Name</label>
    <input type="text" placeholder="Enter First Name" name="firstname" id="fullname" required>

    <label for="username"><b>Email</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="pswrepeat" required>

    <label for="user_type">Privileges:</label>
                <select name="user_type" id="user_type">
                    <option value="Employee">Employee</option>
                    <option value="Administrator">Administrator</option>
                </select>
    <hr>
    

    <button type="button" id="registerBtn" name="save" class="registerbtn">Register</button>
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
