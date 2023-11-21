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
    $.getJSON('../../PHP/populateManageStudents.php', function(data) {
      
      
      let dropDown = document.getElementById("classID");

      for(i=0; i<data.length; i++){
        let option = document.createElement("option");
        option.value = data[i];
        option.innerHTML = data[i];
        dropDown.appendChild(option);
      }
      let studentLine = document.getElementById("studentDesc");
      let newstring = "Selected Student: <strong>"+ sessionStorage.getItem("selectedStuName") + "</strong>"
      studentLine.innerHTML = newstring;
    });
    let movebutton = document.getElementById("moveStudent");
    

    movebutton.addEventListener("click", function(){
      let dropDown = document.getElementById("classID");
      let values = {
        'stuId': sessionStorage.getItem("selectedStuId"),
        'newClassId': dropDown.value
      };
      $.ajax({
        type: 'post',
        url: '../../PHP/moveStudentFile.php',
        data: values,
        success: function(res){
          alert("Student moved.");
          sessionStorage.setItem("saveSpot", "set");
          
          window.location.href= "manageStudents.php";
          
        }
      })


    })



    

});
</script>

</head>
<body>
  <div class="menuBar">
        <a href="adminHome.php">Home</a>
        <a href="addEmployee.php">Add Employee</a>
        <a href="addInventory.php">Add Inventory</a>
        <a href="addClass.php">Add Class</a>
        <a class= "active" href="manageStudents.php">Manage Students</a>
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
    <h1>Move Student</h1>
    <p>Select which class to move the student.</p>
    <hr>
    <p id = "studentDesc">Selected Student: </p>
    

    <label for="classID">New Class</label>
    <select name="classID" placeholder ="Select" id = "classID">
    </select>

    <hr>

    <button type="button" name="save" id="moveStudent" class="registerbtn">Move</button>
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