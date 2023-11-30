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
<link rel="stylesheet" href="../../CSS/checkout.css" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  $(function () {

    function loadList(){
    console.log("hello");
    $.getJSON('../../PHP/populateReturn.php', function(data) {
      console.log(data);
      let array = data;
      let loadLocation = document.getElementById("loadLocation");
      loadLocation.innerHTML = "";
      let header1 = document.createElement("p");
      header1.innerHTML = "<strong>Equipment ID</strong>";
      let header2 = document.createElement("p");
      header2.innerHTML = "<strong>Equipment Name</strong>";
      let header3 = document.createElement("p");
      header3.innerHTML = "<strong>Student ID</strong>";
      let header4 = document.createElement("p");
      header4.innerHTML = "<strong>Student Name</strong>";
      let headerDiv = document.createElement("div");
      headerDiv.classList.add("listGroup");

      headerDiv.appendChild(header1);
      header1.style.marginLeft = "50px";
      headerDiv.appendChild(header2);
      header2.style.marginLeft = "30px";
      headerDiv.appendChild(header3);
      header3.style.marginLeft = "30px";
      headerDiv.appendChild(header4);
      header4.style.marginLeft = "30px";

      loadLocation.appendChild(headerDiv);
      let headerSpacer = document.createElement("hr");
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
        line2.innerHTML = array[i+1];
        line3.innerHTML = array[i+2];
        line4.innerHTML = array[i+3];
        listingGroup.appendChild(selectBtn);

        listingGroup.appendChild(line1);
        listingGroup.appendChild(line2);
        listingGroup.appendChild(line3);
        listingGroup.appendChild(line4);
        loadLocation.appendChild(listingGroup);

        //styles
        line1.style.marginTop = "0px";
        line1.style.marginLeft = "5px";

        line2.style.marginTop = "0px";
        line2.style.marginLeft = "70px";
        line2.style.width = "200px";

        line3.style.marginTop = "0px";
        line3.style.marginLeft = "10px";
        line3.style.width="100px";

        line4.style.marginTop = "0px";
        line4.style.marginLeft = "10px";





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




    });
  }
  loadList();

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/returnFile.php',
            data: $('form').serialize(),
            success: function(res) {

              alert("Equipment checked out.");

              input1 = document.getElementById("equipmentid");
              input1.value = "";

              input2 = document.getElementById("studentid");
              input2.value = "";
              loadList();

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
        <img src="../../img/Icon2.png" alt="Icon"> <!-- icon needs to be 50px by 50px -->
        </div>
</div>
<form>
  <div class="container">
    
    <div class = "section1">
    <h1>Check-In</h1>
    <p>Please fill in this form to return an item</p>
    <label for="equipmentid">Equipment ID</label>
    <input type="text" placeholder="Enter Equipment ID" name="equipmentid" id="equipmentid" required>
    <label for="studentid">Student ID</label>
    <input type="text" placeholder="Enter Student ID" name="studentid" id="studentid" required>
    <button type="submit" name="save" class="registerbtn">Check-In</button>
    <p></p>
    </div>
    
    
    <div class = "section2">
    <h1>Outstanding Equipment</h1>
      <p> Below is a list of all equipment waiting to be returned </p>
      <div class = "loadLocation" id = "loadLocation">
        



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