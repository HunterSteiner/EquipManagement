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
<title>Employees</title>
<link rel="icon" type="image/x-icon" href="../../Favicon2.ico" />
<link rel="stylesheet" href="../../CSS/addEmployee.css" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    //after dom is loaded
    $(function (){
        function loadClasses(){
            $.getJSON('../../PHP/populateManageEmployee.php', function(data) {
              let array = data;
              var start = document.getElementById("loadLocation");
              start.innerHTML = "";
              headDiv = document.createElement("div");
              colHead = document.createElement("p");
              colHead.innerHTML = "<strong>ID</strong>";
              colHead2 = document.createElement("p");
              colHead2.innerHTML = "<strong>Name</strong>";
              let colhead3 = document.createElement("p");
              colhead3.innerHTML = "<strong>Status</strong>";

              headDiv.appendChild(colHead);
              headDiv.appendChild(colHead2);
              headDiv.appendChild(colhead3);
              colhead3.style.marginLeft = "50px";
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
                text = document.createTextNode(array[i]);

                line2 = document.createElement("p");
                text2= document.createTextNode(array[i+1]);

                line3 = document.createElement("p");
                let text3 = document.createTextNode("placeholder");
                console.log(array[i+1]);
                if(array[i+2] == 1){
                    text3= document.createTextNode("Admin");
                }else{
                    text3= document.createTextNode("Employee");
                }
                
                let editbtn = document.createElement("button");
                editbtn.innerHTML = "Edit";
                editbtn.dataset.id = array[i];
                editbtn.dataset.crrent = "0";

                divCont.appendChild(line);
                line.appendChild(text);
                divCont.appendChild(line2);
                line2.appendChild(text2);
                line2.style.width = "300px";
                divCont.appendChild(line3);
                line3.appendChild(text3);
                divCont.appendChild(editbtn);

                start.appendChild(divCont);
                divCont.classList.add("listResponse");
                divCont.style.height = "30px";
                linebreak = document.createElement("hr");
                start.appendChild(linebreak);
              }
              let cloneStart = start.cloneNode(true);
              start.parentNode.replaceChild(cloneStart,start);
              cloneStart.addEventListener("click", function(e){
                if((e.target.tagName == "BUTTON") && (e.target.dataset.crrent == "0")){
                    console.log("thisbutton was clicked");
                    let thistest= e.target.parentElement;
                    let thistestChildren = thistest.children;



                    let newinput = document.createElement("input");
                    let thistext = thistestChildren[1].innerHTML;
                    let newpara = thistestChildren[1].cloneNode(true);

                    let newpara2 = thistestChildren[0].cloneNode(true);

                    let newpara3 = thistestChildren[2].cloneNode(true);

                    sessionStorage.setItem("selectedEmployee",newpara2.innerHTML);

                    thistest.removeChild(thistestChildren[0]);
                    thistest.removeChild(thistestChildren[0]);
                    thistest.removeChild(thistestChildren[0]);

                    let confbtn = document.createElement("button");
                    confbtn.innerHTML = "Confirm";
                    confbtn.dataset.crrent = "notset";

                    let deletebtn = document.createElement("button");
                    deletebtn.innerHTML = "Remove";
                    deletebtn.dataset.crrent = "notset";

                    let swapbtn = document.createElement("button");
                    swapbtn.innerHTML = "SwapStatus";
                    swapbtn.dataset.crrent = "notset";

                    let changePassbtn = document.createElement("button");
                    changePassbtn.innerHTML = "Change Password";
                    changePassbtn.dataset.crrent = "notset";
                    
                 
                 
                    thistest.prepend(deletebtn);
                    deletebtn.style.marginLeft = "20px";
                    deletebtn.style.backgroundColor="red";
                    deletebtn.style.marginLeft = "0px";

                    thistest.prepend(changePassbtn);
                    changePassbtn.style.marginRight= "10px";
                    changePassbtn.style.backgroundColor = "#022b3a";
                    changePassbtn.style.marginLeft = "0px";

                    thistest.prepend(swapbtn);
                    swapbtn.style.marginLeft = "0px";
                    swapbtn.style.backgroundColor = "#022b3a"
                    swapbtn.style.marginRight = "10px";
                    


                    

                    thistest.prepend(newpara3);
                    
                    newpara3.style.marginRight = "0px";
                    newpara3.style.width = "130px";
                    

                    thistest.prepend(confbtn);
                    confbtn.style.marginLeft = "0px";
                    confbtn.style.marginRight= "45.34px";
                    confbtn.style.backgroundColor="#022b3a";

                    thistest.prepend(newinput);
                    newinput.value = thistext;
                    newinput.classList.add("newinput");
                    newinput.style.marginLeft = "16px";
                    newinput.style.width = "180px";
                    newinput.style.marginRight = "0px";

                    thistest.prepend(newpara2);


                    //change edit button to cancel. also adds an event listener and disables the current event listener
                    let thisEditbtn = thistestChildren[7];
                    thisEditbtn.innerHTML = "Cancel";
                    thisEditbtn.style.backgroundColor = "#022b3a";
                    thisEditbtn.dataset.crrent = "1";
                    thisEditbtn.addEventListener("click",function(e){
                        if(thisEditbtn.dataset.crrent == "1"){
                            console.log("this plays");
                            thistest.removeChild(thistestChildren[0]);
                            thistest.removeChild(thistestChildren[0]);
                            thistest.removeChild(thistestChildren[0]);
                            thistest.removeChild(thistestChildren[0]);
                            thistest.removeChild(thistestChildren[0]);
                            thistest.removeChild(thistestChildren[0]);
                            thistest.removeChild(thistestChildren[0]);

                            
                            thistest.prepend(newpara3);
                            thistest.prepend(newpara);
                            thistest.prepend(newpara2);

                            thisEditbtn.innerHTML = "Edit";
                            thisEditbtn.style.backgroundColor = "#1f7a8c";

                            

                            

                        }
                    });
                    confbtn.addEventListener("click", function(e){

                        
                    let values = {
                      'employeeId': newpara2.innerHTML,
                      'employeeName': newinput.value
                    };
                    $.ajax({
                      type: 'post',
                      url: '../../PHP/editEmployee.php',
                      data: values,
                      success: function(res){
                        loadClasses();

                      }
                  })

                 });
                 deletebtn.addEventListener("click", function(e){
                  let userResponse = confirm("Are you sure you want to remove this student?");
                  if(userResponse){
                    console.log(newpara2.innerHTML);
                  let values = {
                    'employeeId': newpara2.innerHTML
                  };
                  $.ajax({
                    type: 'post',
                    url: '../../PHP/removeEmployee.php',
                    data: values,
                    success: function(res){
                      
                        loadClasses();
                      

                    }

                  })
                }

                

                 });
                 swapbtn.addEventListener("click", function(e){
                    let numbStatus = 99;
                    if(newpara3.innerHTML == "Employee"){
                        numbStatus = 1;
                    }else{
                        numbStatus = 0;
                    }
                    console.log(numbStatus);
                    let values = {
                    'employeeId': newpara2.innerHTML,
                    'employeeRole': numbStatus
                  };
                  $.ajax({
                    type: 'post',
                    url: '../../PHP/swapEmployee.php',
                    data: values,
                    success: function(res){

                        loadClasses();
                      
                        
                      

                    }

                  })


                 });
                 changePassbtn.addEventListener("click", function(){
                  
                  window.location.href= "changePassword.php";

                 });

                    




                }
                else if ((e.target.tagName == "BUTTON") && (e.target.dataset.crrent == "1")){
                    let cloneEditbtn = e.target.cloneNode(true);
                    e.target.parentNode.replaceChild(cloneEditbtn,e.target);
                    cloneEditbtn.dataset.crrent = "0";
                    console.log("this is running and data ="+e.target.dataset.crrent);

                }

              });

              
            
            

        });
        }
        loadClasses();
        

    });

</script>
</head>
<body>
  <div class="menuBar">
        <a href="adminHome.php">Home</a>
        <a class="active" href="manageEmployee.php">Employees</a>
        <a href="manageInventory.php">Inventory</a>
        <a href="manageClass.php">Classes</a>
        <a href="manageStudents.php">Students</a>
        <div class= "subgroup">
        <?php
            echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
         ?>
         <a href="../../PHP/logout.php">|Log Out|</a>
        
       </div>
</div>
<div class="extended-form">
<form>
  <div class="container">
    <h1>Manage Employees</h1>
    <p>All current employees found below:</p>
    <hr>
  </div>
</form>
<div class= "listGroup">

 <h4 >Employee List:</h4>
 <a href="addEmployee.php">Add Employee</a>
 
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