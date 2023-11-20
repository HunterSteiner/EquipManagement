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

    function loadStuList(array){

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

              for(i=0; i<array.length; i +=2){
                divCont = document.createElement("div");
                divCont.dataset.id = array[i];
                



                line = document.createElement("p");
                text = document.createTextNode(array[i+1]);
                line2 = document.createElement("p");
                text2= document.createTextNode(array[i]);
                editbtn = document.createElement("button");
                editbtn.innerHTML = "Edit";
                editbtn.dataset.id = array[i];
                editbtn.dataset.crrent = "0";
                divCont.appendChild(line);
                line.appendChild(text);
                divCont.appendChild(line2);
                line2.appendChild(text2);
                divCont.appendChild(editbtn);

                start.appendChild(divCont);
                divCont.classList.add("listResponse");
                linebreak = document.createElement("hr");
                start.appendChild(linebreak);

              }
              //event listener for the edit buttons
              //to do: need to remove this event listener each time after the display button is pressed
              let cloneStart = start.cloneNode(true);
              start.parentNode.replaceChild(cloneStart,start);

              cloneStart.addEventListener("click", function(e){
                if((e.target.tagName == "BUTTON") && (e.target.dataset.crrent == "0")){
                 let thistest= e.target.parentElement;
                 console.log("this button is activating");
                 let thistestChildren = thistest.children;
                 let newinput = document.createElement("input");
                 thistext = thistestChildren[0].innerHTML;
                 let newpara = thistestChildren[0].cloneNode(true);
                 thistest.removeChild(thistestChildren[0]);

                 //add confirm button
                 let confbtn = document.createElement("button");
                 confbtn.innerHTML = "Confirm";
                 confbtn.dataset.crrent = "notset";
                 thistest.prepend(confbtn);
                 confbtn.style.marginLeft = "0px";
                 confbtn.style.marginRight= "14.3px";
                 
                 thistest.prepend(newinput);
                 newinput.value = thistext;

                 //change edit button to cancel. also adds an event listener and disables the current event listener
                 let thisEditbtn = thistestChildren[3];
                 thisEditbtn.innerHTML = "Cancel";
                 thisEditbtn.style.backgroundColor = "red";

                 thisEditbtn.dataset.crrent = "1";
                 thisEditbtn.addEventListener("click",function(e){
                  if(thisEditbtn.dataset.crrent == "1");
                  thisEditbtn.innerHTML = "Edit";
                  thisEditbtn.style.backgroundColor = "#1f7a8c";
                  
                  
                  thistest.removeChild(thistestChildren[0]);
                  thistest.prepend(newpara);
                  thistest.removeChild(thistestChildren[1]);

                 });
                 confbtn.addEventListener("click", function(e){
                  let values = {
                    'stuName': newinput.value,
                    'stuId': thistestChildren[2].innerHTML
                  };
                  $.ajax({
                    type: 'post',
                    url: '../../PHP/editStudent.php',
                    data: values,
                    success: function(res){

                      let dropDown = document.getElementById("classID");
                      let inputClass = dropDown.value;
                      loadUpdateStuList(inputClass);
                      
                      

                    }
                  })

                 });

                 
                 
                }
                else if ((e.target.tagName == "BUTTON") && (e.target.dataset.crrent == "1")){
                  
                  let cloneEditbtn = e.target.cloneNode(true);
                  e.target.parentNode.replaceChild(cloneEditbtn,e.target);
                  cloneEditbtn.dataset.crrent = "0";
                  console.log("this is running and data ="+e.target.dataset.crrent);
                 
                }

              });





    }
    function loadUpdateStuList(classID){
      let values = {
        'classID': classID
      };
      console.log("got this far");
    
      
      $.ajax({
        type: 'post',
        url: '../../PHP/manageStudentsFile.php',
        data: values,
        success: function(res){
          var array = JSON.parse(res);
          loadStuList(array);

        }
      })

    }
    //getting data for drop down
    //TODO use browser storage to determine if the class should be pre displayed
    $.getJSON('../../PHP/populateManageStudents.php', function(data) {
      
      
      let dropDown = document.getElementById("classID");

      for(i=0; i<data.length; i++){
        let option = document.createElement("option");
        option.value = data[i];
        option.innerHTML = data[i];
        dropDown.appendChild(option);
      }
    });

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/manageStudentsFile.php',
            data: $('form').serialize(),
            success: function(res) {

              var array = JSON.parse(res);
              loadStuList(array);

              
              

              
               
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