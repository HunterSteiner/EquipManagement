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
    if(sessionStorage.getItem("saveSpot") == "set"){
      loadUpdateStuList(sessionStorage.getItem("lastSelectedClass"));
      
      
    }
    

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

              for(i=0; i<array.length; i +=3){
                divCont = document.createElement("div");
                divCont.dataset.id = array[i];
                



                line = document.createElement("p");
                text = document.createTextNode(array[i+1]);
                line2 = document.createElement("p");
                text2= document.createTextNode(array[i]);
                line3 = document.createElement("P");
                text3 = document.createTextNode(array[i+2])
                editbtn = document.createElement("button");
                editbtn.innerHTML = "Edit";
                editbtn.dataset.id = array[i];
                editbtn.dataset.crrent = "0";
                divCont.appendChild(line);
                line.appendChild(text);
                divCont.appendChild(line2);
                line2.appendChild(text2);
                divCont.appendChild(line3);
                line3.appendChild(text3);
                divCont.appendChild(editbtn);

                start.appendChild(divCont);
                divCont.classList.add("listResponse");
                divCont.style.height = "30px";
                linebreak = document.createElement("hr");
                start.appendChild(linebreak);

              }
              //event listener for the edit buttons
              
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

                 let newinput2 = document.createElement("input");
                 thistext2 = thistestChildren[1].innerHTML;
                 let newpara2 = thistestChildren[1].cloneNode(true);

                 let newinput3 = document.createElement("input");
                 thistext3 = thistestChildren[2].innerHTML;
                 let newpara3 = thistestChildren[2].cloneNode(true);

                 thistest.removeChild(thistestChildren[0]);
                 thistest.removeChild(thistestChildren[0]);
                 thistest.removeChild(thistestChildren[0]);


                 let confbtn = document.createElement("button");
                 confbtn.innerHTML = "Confirm";
                 confbtn.dataset.crrent = "notset";

                 let deletebtn = document.createElement("button");
                 deletebtn.innerHTML = "Remove";
                 deletebtn.dataset.crrent = "notset";
                 

                 let movebtn = document.createElement("button");
                 movebtn.innerHTML = "Move";
                 movebtn.dataset.crrent = "notset";
                 

                 thistest.prepend(deletebtn);
                 deletebtn.style.marginLeft = "20px";
                 deletebtn.style.backgroundColor="red";
                 deletebtn.style.marginLeft = "0px";

                 thistest.prepend(movebtn);
                 movebtn.style.backgroundColor= "#022b3a";
                 movebtn.style.marginLeft = "0px";
                 movebtn.style.marginRight= "14.3px";

                 thistest.prepend(confbtn);
                 confbtn.style.marginLeft = "0px";
                 confbtn.style.marginRight= "14.3px";
                 confbtn.style.backgroundColor="#022b3a";
                 
                 thistest.prepend(newinput3);
                 newinput3.value = thistext3;
                 newinput3.classList.add("newinput");
                 newinput3.style.marginLeft = "130px";
                 newinput3.style.width = "210px";

                 thistest.prepend(newinput2);
                 newinput2.value = thistext2;
                 newinput2.classList.add("newinput");
                 newinput2.style.width = "120px";

                 thistest.prepend(newinput);
                 newinput.value = thistext;
                 newinput.classList.add("newinput");
                 newinput.style.marginLeft = "16px";

                 //change edit button to cancel. also adds an event listener and disables the current event listener
                 let thisEditbtn = thistestChildren[6];
                 thisEditbtn.innerHTML = "Cancel";
                 thisEditbtn.style.backgroundColor = "#022b3a";

                 thisEditbtn.dataset.crrent = "1";
                 thisEditbtn.addEventListener("click",function(e){
                  if(thisEditbtn.dataset.crrent == "1");
                  thisEditbtn.innerHTML = "Edit";
                  thisEditbtn.style.backgroundColor = "#1f7a8c";
                  
                  
                  thistest.removeChild(thistestChildren[0]);
                  thistest.removeChild(thistestChildren[0]);
                  thistest.removeChild(thistestChildren[0]);
                  thistest.removeChild(thistestChildren[0]);
                  thistest.removeChild(thistestChildren[0]);
                  thistest.removeChild(thistestChildren[0]);
                  

                  thistest.prepend(newpara3);
                  thistest.prepend(newpara2);
                  thistest.prepend(newpara);

                  

                 });
                 confbtn.addEventListener("click", function(e){
                  let values = {
                    'stuName': newinput.value,
                    'stuId': newpara2.innerHTML,
                    'stuEmail': newinput3.value,
                    'newId': newinput2.value
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
                 deletebtn.addEventListener("click", function(e){
                  let userResponse = confirm("Are you sure you want to remove this student?");
                  if(userResponse){
                  let values = {
                    'stuId': newpara2.innerHTML
                  }
                  $.ajax({
                    type: 'post',
                    url: '../../PHP/removeStudent.php',
                    data: values,
                    success: function(res){
                      let dropDown = document.getElementById("classID");
                      let inputClass = dropDown.value;
                      loadUpdateStuList(inputClass);
                      

                    }

                  })
                }

                

                 });
                 movebtn.addEventListener("click", function(e){
                  sessionStorage.setItem("selectedStuId", newpara2.innerHTML);
                  sessionStorage.setItem("selectedStuName", newpara.innerHTML);
                  window.location.href= "moveStudent.php";

                 })

                 
                 
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
      if(sessionStorage.getItem("saveSpot") == "set"){
        dropDown.value = sessionStorage.getItem("lastSelectedClass");
        sessionStorage.setItem("saveSpot", "notset");
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
              let dropDown = document.getElementById("classID");
              sessionStorage.setItem("lastSelectedClass", dropDown.value);

              
              

              
               
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