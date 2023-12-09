
<?php
//checks if the user has the proper authorization, will automatically redirect them to login page if not
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
<title>Add Class</title>
<link rel="icon" type="image/x-icon" href="../../Favicon2.ico" />
<link rel="stylesheet" href="../../CSS/addEmployee.css" />
<!--This is the ajax section. Line 19 imports the library required for jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  $(function () {
    let backArrow = document.getElementById("backbtn");
    backArrow.addEventListener("click",function(){
        window.location.href= "manageClass.php";

    });

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/addClassFile.php',
            data: $('form').serialize(),
            success: function(res) {
              //This is the section that will run after running the php file. res is the data response from the php file.
              if(res == "1"){
                let errorLine = document.getElementById("errorText");
                errorLine.innerHTML = "";
                alert("New Class created.");

             //the following lines just resets the 2 input boxes after hitting submit
              input1 = document.getElementById("classID");
              input1.value = "";

              input2 = document.getElementById("className");
              input2.value = "";

              }else{
                let errorLine = document.getElementById("errorText");
                errorLine.innerHTML = "Error: Class ID is already in use.";

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
        <a href="manageInventory.php">Inventory</a>
        <a class= "active" href="manageClass.php">Classes</a>
        <a href="manageStudents.php">Students</a>
        <div class= "subgroup">
        <?php
            echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
         ?>
         <a href="../../PHP/logout.php">|Log Out|</a>
        
       </div>
</div>
<form>
  <div class="container">
  <button type="button" name="back" class="backbtn" id="backbtn"></button>
    <h1>Add Class</h1>
    <p>Please fill in this form to add a class.</p>
    <p class ="errorText" id="errorText"></p>
    <hr>
    

    <label for="classID">Class ID</label>
    <input type="text" placeholder="Enter Class ID" name="classID" id="classID" required>

    <label for="className">Class Name</label>
    <input type="text" placeholder="Enter Class Name" name="className" id="className" required>

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