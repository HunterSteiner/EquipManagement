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
  <title> Return Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../CSS/returnV2.css" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  $(function () {

    function loadList(){
    console.log("hello");
    let values = {
       'recordOffset': recordOffset
    };
    $.ajax({
            type: 'post',
            url: '../../PHP/populateReturn.php',
            data: values,
            success: function(res) {



      let array = JSON.parse(res);
      recordAmount = array.length;
      let pageNumberPara = document.getElementById("numberVal");
                pageNumberPara.innerHTML = pageNumbVal;
      let loadLocation = document.getElementById("loadLocation");
      loadLocation.innerHTML = "";
      let filler = document.createElement("p");
      filler.classList.add("filler");
      let header1 = document.createElement("p");
      header1.classList.add("header1");
      header1.innerHTML = "<strong>Equipment ID</strong>";
      let header2 = document.createElement("p");
      header2.classList.add("header2");
      header2.innerHTML = "<strong>Equipment Name</strong>";
      let header3 = document.createElement("p");
      header3.classList.add("header3");
      header3.innerHTML = "<strong>Student ID</strong>";
      let header4 = document.createElement("p");
      header4.classList.add("header4");
      header4.innerHTML = "<strong>Student Name</strong>";
      let headerDiv = document.createElement("div");
      headerDiv.classList.add("headerListGroup");
      headerDiv.appendChild(filler);
      headerDiv.appendChild(header1);
      headerDiv.appendChild(header2);
      
      headerDiv.appendChild(header3);
      
      headerDiv.appendChild(header4);
      

      loadLocation.appendChild(headerDiv);
      let headerSpacer = document.createElement("hr");
      headerSpacer.classList.add("headSpacer");
      loadLocation.appendChild(headerSpacer);
      
      
      for(let i =0; i<array.length; i+=4){
        let selectBtn = document.createElement("button");
        selectBtn.setAttribute("type", "button");
        selectBtn.innerHTML = "Select";
        selectBtn.classList.add("selectBtn");

        let line1 = document.createElement("p");
        let line2 = document.createElement("p");
        let line3 = document.createElement("p");
        let line4 = document.createElement("p");
        let listingGroup = document.createElement("div");
        listingGroup.classList.add("listGroup");
        line1.innerHTML = array[i];
        line1.classList.add("line1");
        line2.innerHTML = array[i+1];
        line2.classList.add("line2");
        line3.innerHTML = array[i+2];
        line3.classList.add("line3");
        line4.innerHTML = array[i+3];
        line4.classList.add("line4");
        listingGroup.appendChild(selectBtn);

        listingGroup.appendChild(line1);
        listingGroup.appendChild(line2);
        listingGroup.appendChild(line3);
        listingGroup.appendChild(line4);
        loadLocation.appendChild(listingGroup);
        let lineSpacer1 = document.createElement("hr");
        
        loadLocation.appendChild(lineSpacer1);
        lineSpacer1.style.margin = "0px";
        lineSpacer1.style.marginBottom = "2px";

        //styles
        

        

        
      }
      let cloneLocation = loadLocation.cloneNode(true);
      loadLocation.parentNode.replaceChild(cloneLocation,loadLocation);

      cloneLocation.addEventListener("click", function(e){

        if(e.target.tagName == "BUTTON"){
          console.log("this button activated");
          let thisDiv = e.target.parentElement;
          thisDivChildren = thisDiv.children;
          let incomingEquipId = thisDivChildren[1];
          let incomingStudentId = thisDivChildren[3];

          let equipmentIdSearch = document.getElementById("equipmentid");
          equipmentIdSearch.value = incomingEquipId.innerHTML;
          let studentIdSearch = document.getElementById("studentid");
          studentIdSearch.value = incomingStudentId.innerHTML;

        }

      });



            }
    });
  }
  let recordOffset = 0;
  let recordAmount = 0;
  let pageNumbVal = 1;
  loadList();
  let forwardBtn = document.getElementById("forwardBtn");
  forwardBtn.addEventListener("click", function(){
    if(recordAmount == 72){
    recordOffset +=18;
    pageNumbVal +=1;
    loadList();
    }
  });
  let backBtn = document.getElementById("backBtn");
  backBtn.addEventListener("click", function(){
    if(recordOffset >0){
      recordOffset -=18;
      pageNumbVal -=1;
      loadList();
    }


  });

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/returnFile.php',
            data: $('form').serialize(),
            success: function(res) {
              if(res == "11"){
                alert("Equipment returned.");
                input1 = document.getElementById("equipmentid");
                input1.value = "";

              input2 = document.getElementById("studentid");
              input2.value = "";
              loadList();
                let errorLine = document.getElementById("errorField");
                errorLine.innerHTML = "";

              }else{
                console.log("no worky");
                let errorLine = document.getElementById("errorField");
                errorLine.innerHTML = "Error: Incorrect Equipment or Student ID.";
                
              }

              }
              
        });
    });

});
</script>

</head>
<body>
  <div class="menuBar">
    <a href="employeeHome.php">Home</a>
    <a href="checkout.php">Check-Out</a>
    <a class = "active" href="return.php">Return</a>
    <a href="logs.php">Logs</a>
    <div class= "subgroup">
        <?php
         echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
        ?>
        <a href="../../PHP/logout.php">|Log Out|</a>
        
        </div>
</div>
<form>
  <div class="container">
    
    <div class = "section1">
    <h1 id ="leftHeader">Check-In</h1>
    <p id = "leftDescription">Please fill in this form to return an item</p>
    <p class= "errorField" id="errorField"></p>
    <label class = "inputSet" for="equipmentid">Equipment ID</label>
    <input  type="text" placeholder="Enter Equipment ID" name="equipmentid" id="equipmentid" required>
    <label class = "inputSet" for="studentid">Student ID</label>
    <input  type="text" placeholder="Enter Student ID" name="studentid" id="studentid" required>
    <button type="submit" name="save" class="registerbtnLeft registerbtn">Check-In</button>
    <button type="reset"  name="reset" class="registerbtn">Reset</button>
    <p></p>
    </div>
    
    
    <div class = "section2">
    <h1 id ="rightHeader">Outstanding Equipment</h1>
      <p id= "rightDescription"> Below is a list of all equipment waiting to be returned: </p>
      <div class = "loadLocation" id = "loadLocation"></div>

      <div class="advanceButtons">
          <button type="button" id="backBtn"><<</button>
          <p id = "numberVal">1</p>
          <button type="button" id ="forwardBtn">>></button>
      </div>
    </div>
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