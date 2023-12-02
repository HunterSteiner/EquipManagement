
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
   //17
    function loadList(){
    console.log("hello");
    let values = {
       'recordOffset': recordOffset
    };
    $.ajax({
            type: 'post',
            url: '../../PHP/populateCheckout.php',
            data: values,
            success: function(res) {
                let array = JSON.parse(res);
                console.log(array.length);
                recordAmount = array.length;
                let pageNumberPara = document.getElementById("numberVal");
                pageNumberPara.innerHTML = pageNumbVal;
                let loadLocation = document.getElementById("loadLocation");
                loadLocation.innerHTML = "";
                let header1 = document.createElement("p");
                header1.innerHTML = "<strong>Equipment ID</strong>";
                let header2 = document.createElement("p");
                header2.innerHTML = "<strong>Equipment Name</strong>";
                let headerDiv = document.createElement("div");
                headerDiv.classList.add("listGroup");

                headerDiv.appendChild(header1);
                header1.style.marginLeft = "50px";
                headerDiv.appendChild(header2);
                header2.style.marginLeft = "30px";
                

                loadLocation.appendChild(headerDiv);
                let headerSpacer = document.createElement("hr");
                loadLocation.appendChild(headerSpacer);
      
      
               for(let i =0; i<array.length; i+=2){
                  let selectBtn1 = document.createElement("button");
                  selectBtn1.innerHTML = "Select";
                  selectBtn1.setAttribute("type","button");
                  selectBtn1.classList.add("selectBtn");
                  selectBtn1.style.marginBottom = "0px";
                  selectBtn1.style.marginLeft ="10px";
                  let line1 = document.createElement("p");
                  let line2 = document.createElement("p");
                  let listingGroup = document.createElement("div");
                  
                  listingGroup.classList.add("listGroup");
                  listingGroup.style.margin = "0px";
                  line1.innerHTML = array[i];
                  line2.innerHTML = array[i+1];
                  listingGroup.appendChild(selectBtn1);
                  listingGroup.appendChild(line1);
                  listingGroup.appendChild(line2);
                  loadLocation.appendChild(listingGroup);
                  let lineSpacer = document.createElement("hr");
                  loadLocation.appendChild(lineSpacer);
                  lineSpacer.style.margin = "0px";
                  lineSpacer.style.marginBottom = "5px";
                  lineSpacer.style.padding = "0px";
                  lineSpacer.style.paddingLeft = "10px";
                  
                  


                  //styles
                  line1.style.marginTop = "0px";
                  line1.style.marginLeft = "5px";

                  line2.style.marginTop = "0px";
                  line2.style.marginLeft = "auto";
      }
      let cloneLocation = loadLocation.cloneNode(true);
      loadLocation.parentNode.replaceChild(cloneLocation,loadLocation);

      cloneLocation.addEventListener("click", function(e){

        if(e.target.tagName == "BUTTON"){
          let thisDiv = e.target.parentElement;
          thisDivChildren = thisDiv.children;
          let incomingEquipId = thisDivChildren[1];

          let equipmentIdSearch = document.getElementById("equipmentid");
          equipmentIdSearch.value = incomingEquipId.innerHTML;
        }

      });
              }
              
        });
      
  }
  function loadDropDown(){
    $.getJSON('../../PHP/populateManageStudents.php', function(data){
      let dropDown = document.getElementById("classID");
      console.log(dropDown);
      for(i=0; i<data.length; i++){
        let option = document.createElement("option");
        option.value = data[i];
        option.innerHTML = data[i];
        dropDown.appendChild(option);
      }
      displayBtn.click();
      
    });
  }
  let recordOffset = 0;
  let recordAmount = 0;
  let pageNumbVal = 1;
  loadList();
  loadDropDown();
  let forwardBtn = document.getElementById("forwardBtn");
  forwardBtn.addEventListener("click", function(){
    if(recordAmount == 40){
    recordOffset +=20;
    pageNumbVal +=1;
    loadList();
    }
  });
  let backBtn = document.getElementById("backBtn");
  backBtn.addEventListener("click", function(){
    if(recordOffset >0){
      recordOffset -=20;
      pageNumbVal -=1;
      loadList();
    }


  });
  let displayBtn = document.getElementById("displayBtn");
  displayBtn.addEventListener("click", function(){
    let dropDown = document.getElementById("classID");
    let classID = dropDown.value;
    console.log(classID);

    let values = {
        'classID': classID
      };
      
    
      $.ajax({
        type: 'post',
        url: '../../PHP/manageStudentsFile.php',
        data: values,
        success: function(res){
          let errorFlag = false;
          try{
            var array = JSON.parse(res);
          } catch(error){
            let errorLine = document.getElementById("errorText");
            errorLine.innerHTML = "No Students have been added to this class";
            errorFlag = true;
            let loadSpot = document.getElementById("subsection1");
            loadSpot.innerHTML = "";
          }
          if(!errorFlag){
            var array = JSON.parse(res);
            let errorLine = document.getElementById("errorText");
            errorLine.innerHTML = "";
          console.log(array.length);
          let loadSpot = document.getElementById("subsection1");
          loadSpot.innerHTML = "";
          let headerParagraph = document.createElement("p");
          headerParagraph.innerHTML = "<strong>(ID,Name)</strong>";
          headerParagraph.style.marginLeft = "197px";
          headerParagraph.style.marginTop = "0px";
          loadSpot.appendChild(headerParagraph);
          console.log(loadSpot);

          let loadLength = array.length / 3;
          let j = 0;

          for(let i = 0; i<loadLength; i+=2){
            console.log("this is running");
           let loadDiv = document.createElement("div");
           let line1 = document.createElement("button");
           line1.innerHTML = array[j] + ", "+ array[j+1];
           line1.setAttribute("type","button");
           line1.dataset.id = array[j];
            loadDiv.appendChild(line1);
            line1.style.borderRight = "3px groove #f1f1f1";
            line1.style.width = "250px";
            line1.style.marginTop = "0px";
            line1.style.marginBottom = "0px";
            line1.style.paddingBottom = "8px";
            line1.style.borderBottom = "3px groove #f1f1f1";

            if(i < loadLength-1){
              let line2 = document.createElement("button");
              line2.innerHTML = array[j+3] + ", "+ array[j+4];
              line2.setAttribute("type","button");
              line2.dataset.id = array[j+3];
              loadDiv.appendChild(line2);
              line2.style.marginLeft = "0px";
              line2.style.paddingLeft= "20px";
              line2.style.marginTop = "0px";
              line2.style.marginBottom = "0px";
              line2.style.borderBottom = "3px groove #f1f1f1";
              line2.style.width = "250px";
            }
            loadSpot.appendChild(loadDiv);
            loadDiv.classList.add("subListing");

            j = j+6;


          }

          let cloneSpot = loadSpot.cloneNode(true);
          loadSpot.parentNode.replaceChild(cloneSpot,loadSpot);

          cloneSpot.addEventListener("click", function(e){

            if(e.target.tagName == "BUTTON"){
          

          let studentIdSearch = document.getElementById("studentid");
          studentIdSearch.value = e.target.dataset.id;
        }

          });

          }
          



        }
      });



  });
  

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/checkoutFile.php',
            data: $('form').serialize(),
            success: function(res) {
              if(res == "11"){
                alert("Equipment checked out.");
                input1 = document.getElementById("equipmentid");
                input1.value = "";

                input2 = document.getElementById("studentid");
                input2.value = "";

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
    <a class = "active" href="checkout.php">Check-Out</a>
    <a href="return.php">Return</a>
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
    <!-- left side of page -->
    <div class = "section1">
    <h1>Check-Out</h1>
    <p>Please fill in this form to check-out an item</p>
    <p class= "errorField" id="errorField"></p>
    <label for="equipmentid">Equipment ID</label>
    <input type="text" placeholder="Enter Equipment ID" name="equipmentid" id="equipmentid" required>
    <label for="studentid">Student ID</label>
    <input type="text" placeholder="Enter Student ID" name="studentid" id="studentid" required>
    <button type="submit" name="save" class="registerbtn">Check-Out</button>
    <hr>
    <p class ="errorText" id="errorText"></p>
    <select id = "classID">
    </select>
    <button type="button" class="displayBtn" id= "displayBtn">Display Students</button>
    <div class = "subsection1" id = "subsection1">
    
    
    </div>

    
    </div>
    
    <!-- right side of page -->
    <div class = "section2">
      <h1>Available</h1>
      <p> Below is a list of all equipment available for checkout </p>
      <div class = "loadLocation" id = "loadLocation">
          <div class= "heading">
              <p class= "first"> <strong>Name</strong> </p>
              <p class= "second"> <strong>ID</strong> </p> 
          </div>
      <hr>
      </div>
      
      <div class="advanceButtons">
          <button type="button" id="backBtn"><<</button>
          <button type="button" id ="forwardBtn">>></button>
      </div>
      <div class="pageNumber">
      <p id = "numberVal">1</p>
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