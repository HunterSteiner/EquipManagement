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
  //after dom is loaded
  $(function () {
    //getting data for drop down
    $.getJSON('../../PHP/populateManageStudents.php', function(data) {
      
      
      let dropDown = document.getElementById("classID");

      for(i=0; i<data.length; i++){
        let option = document.createElement("option");
        option.value = data[i];
        option.innerHTML = data[i];
        dropDown.appendChild(option);
      }
      let options = document.querySelectorAll("option");
          for(i=0; i<options.length; i++){
            if(options[i].value == "<?php if(isset ($_SESSION["selectedClass"])){ 
                                          echo $_SESSION["selectedClass"];
                                          }else{
                                            echo "notset";
                                          }
            
                                                                    ?>"){
              options[i].selected = "selected";
            }
          }
      

    });



    let actualcond = false;

      let cond = <?php
                       if(isset($_COOKIE["backtoStudents"])){
                        echo "true";
                       }else{
                        echo "false";
                       }
                       ?>;
      console.log(cond);
      if(cond){
        console.log("this");
        actualcond = true;
      }
      console.log(actualcond);

      
      
      
      
      if(actualcond){
        console.log("running one");
        $.getJSON('../../PHP/manageStudentsTest.php', function(data) {
          console.log("running");

          



          
          var start = document.getElementById("loadLocation");
              start.innerHTML = "";
              headDiv = document.createElement("div");
              colHead = document.createElement("p");
              colHead.innerHTML = "<strong>Name</strong>";
              colHead2 = document.createElement("p");
              colHead2.innerHTML = "<strong>ID</strong>";

              headDiv.appendChild(colHead);
              headDiv.appendChild(colHead2);
              start.appendChild(headDiv);
              headDiv.classList.add("listResponse");
              linebreak = document.createElement("hr");
              start.appendChild(linebreak);
              linebreak.style.backgroundColor = "#f1f1f1";
              linebreak.style.height = "7px";
              linebreak.style.border = "none";
              
              
              
              
                
              var array = data;

              for(i=0; i<array.length; i +=2){
                divCont = document.createElement("div");
                



                line = document.createElement("p");
                text = document.createTextNode(array[i+1]);
                line2 = document.createElement("p");
                text2= document.createTextNode(array[i]);
                divCont.appendChild(line);
                line.appendChild(text);
                divCont.appendChild(line2);
                line2.appendChild(text2);

                start.appendChild(divCont);
                divCont.classList.add("listResponse");
                linebreak = document.createElement("hr");
                start.appendChild(linebreak);

              }
              console.log("this area");
              <?php setcookie("backtoStudents","",time() - (80000 *20), "/"); ?>

          

        });
        
        

      } 










    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/manageStudentsFile.php',
            data: $('form').serialize(),
            success: function(res) {

              var start = document.getElementById("loadLocation");
              start.innerHTML = "";
              headDiv = document.createElement("div");
              colHead = document.createElement("p");
              colHead.innerHTML = "<strong>Name</strong>";
              colHead2 = document.createElement("p");
              colHead2.innerHTML = "<strong>ID</strong>";

              headDiv.appendChild(colHead);
              headDiv.appendChild(colHead2);
              start.appendChild(headDiv);
              headDiv.classList.add("listResponse");
              linebreak = document.createElement("hr");
              start.appendChild(linebreak);
              linebreak.style.backgroundColor = "#f1f1f1";
              linebreak.style.height = "7px";
              linebreak.style.border = "none";
              
              
                
              var array = JSON.parse(res);

              for(i=0; i<array.length; i +=2){
                divCont = document.createElement("div");
                



                line = document.createElement("p");
                text = document.createTextNode(array[i+1]);
                line2 = document.createElement("p");
                text2= document.createTextNode(array[i]);
                divCont.appendChild(line);
                line.appendChild(text);
                divCont.appendChild(line2);
                line2.appendChild(text2);

                start.appendChild(divCont);
                divCont.classList.add("listResponse");
                linebreak = document.createElement("hr");
                start.appendChild(linebreak);

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
        <a href="addClass.php">Add Class</a>
        <a class="active" href="manageStudents.php">Manage Students</a>
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
    <label for="classID">Select Class</label>
    <select name="classID" placeholder ="Select" id = "classID">
    </select>
    <button type="submit" name="save" class="registerbtn">Display</button>
  </div>
</form>
<div class= "listGroup">

 <h4 >Student List:</h4>
 <a href="addStudent.php">Add Students</a>
 
</div>
 <div id="loadLocation" class = "loadLocation">
</div>
 
 
</div>

</body>
<footer>
    <div class="footergroup">
    <p>CopyRight                          (999)999-9999</p>
    <p>123 street ave, Normal IL</p>
    </div>
</footer>
</html>