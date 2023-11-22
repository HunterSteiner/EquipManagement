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
<link rel="stylesheet" href="../../CSS/addEmployee.css" />
<!--This is the ajax section. Line 19 imports the library required for jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  $(function () {
    let backArrow = document.getElementById("backbtn");
    backArrow.addEventListener("click",function(){
        <?php setcookie("backtoStudents","set", time() + (86400 * 15), "/"); ?>
        window.location.href= "manageStudents.php";
        sessionStorage.setItem("saveSpot", "set");

    });

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/addStudentIn.php',
            data: $('form').serialize(),
            success: function(res) {
              //This is the section that will run after running the php file. res is the data response from the php file.

              alert("New student created.");

             //the following lines just resets the 2 input boxes after hitting submit
              input1 = document.getElementById("studentID");
              input1.value = "";

              input2 = document.getElementById("studentName");
              input2.value = "";

              input3 = document.getElementById("studentEmail");
              input3.value = "";

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
        <a href="manageClass.php">Classes</a>
        <a class= "active" href="manageStudents.php">Students</a>
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
    <h1>Add Student</h1>
    <p>Please fill in this form to add a student to <?php echo $_SESSION["selectedClass"];?>.</p>
    <hr>
    

    <label for="studentID">Student ID</label>
    <input type="text" placeholder="Enter Student ID" name="studentID" id="studentID" required>

    <label for="studentName">Student Name</label>
    <input type="text" placeholder="Enter Student Name" name="studentName" id="studentName" required>

    <label for="studentEmail">Student Email</label>
    <input type="text" placeholder="Enter Student Email" name="studentEmail" id="studentEmail" required>

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