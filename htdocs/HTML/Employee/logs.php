
<?php

session_start();
if (!isset ($_SESSION["username"])){
    header ("Location: ../../index.html");
    die;
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Logs</title>
    <link rel="stylesheet" href="../../CSS/log.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  $(function () {

    function loadList(array){
        recordFill = array.length;
        let pageTable = document.getElementById("pageTable");
        pageTable.innerHTML = "";
        pageNum.innerHTML = pageNumVal;

        let tableHead1 = document.createElement("th");
        tableHead1.innerHTML = "Transaction ID";
        let tableHead2 = document.createElement("th");
        tableHead2.innerHTML = "Type";
        let tableHead3 = document.createElement("th");
        tableHead3.innerHTML = "Date";
        let tableHead4 = document.createElement("th");
        tableHead4.innerHTML = "Employee ID";
        let tableHead5 = document.createElement("th");
        tableHead5.innerHTML = "Equipment ID";
        let tableHead6 = document.createElement("th");
        tableHead6.innerHTML = "Student ID";
        let tableHead7 = document.createElement("th");
        tableHead7.innerHTML = "Student Name";
        let tableHead8 = document.createElement("th");
        tableHead8.innerHTML = "Student Email";
        let tableHead9 = document.createElement("th");
        tableHead9.innerHTML = "Class ID";


        pageTable.appendChild(tableHead1);
        pageTable.appendChild(tableHead2);
        pageTable.appendChild(tableHead3);
        pageTable.appendChild(tableHead4);
        pageTable.appendChild(tableHead5);
        pageTable.appendChild(tableHead6);
        pageTable.appendChild(tableHead7);
        pageTable.appendChild(tableHead8);
        pageTable.appendChild(tableHead9);



        for(let i = 0; i <array.length; i+=9){
            let tableRow = document.createElement("tr");
            let data1 = document.createElement("td");
            let data2 = document.createElement("td");
            let data3 = document.createElement("td");
            let data4 = document.createElement("td");
            let data5 = document.createElement("td");
            let data6 = document.createElement("td");
            let data7 = document.createElement("td");
            let data8 = document.createElement("td");
            let data9 = document.createElement("td");

            data1.innerHTML = array[i];
            data2.innerHTML = array[i+1];
            data3.innerHTML = array[i+2];
            data4.innerHTML = array[i+3];
            data5.innerHTML = array[i+4];
            data6.innerHTML = array[i+5];
            data7.innerHTML = array[i+6];
            data8.innerHTML = array[i+7];
            data9.innerHTML = array[i+8];

            tableRow.appendChild(data1);
            tableRow.appendChild(data2);
            tableRow.appendChild(data3);
            tableRow.appendChild(data4);
            tableRow.appendChild(data5);
            tableRow.appendChild(data6);
            tableRow.appendChild(data7);
            tableRow.appendChild(data8);
            tableRow.appendChild(data9);

            pageTable.appendChild(tableRow);
        }
        
  }
  function loadInitialList(){
    let values= {
        'recordOffset': recordOffset
    };

        $.ajax({
            type: 'post',
            url: '../../PHP/populateLogs.php',
            data: values,
            success: function(res) {
                let array = JSON.parse(res);
                
                loadList(array);
                let pageTable = document.getElementById("pageTable");
                let caption = pageTable.createCaption();
                caption.textContent = "Recent Logs";

             

              }
              
        });
  }
  function loadSearchList(){
    let values= {
        'equipmentId': searchID,
        'recordOffset': recordOffset
    };

        $.ajax({
            type: 'post',
            url: '../../PHP/searchLogs.php',
            data: values,
            success: function(res) {
                let errorFlag = false;
                try{
                    let array = JSON.parse(res);
                } catch(error){
                    console.log("no results");
                    let errorLine = document.getElementById("errorField");
                    errorLine.innerHTML = "No results found, try a different Equipment ID.";
                    errorFlag = true;
                    loadInitialList();
                }
                if(!errorFlag){
                let array = JSON.parse(res);
                let errorLine = document.getElementById("errorField");
                errorLine.innerHTML = "";
                loadList(array);
                let pageTable = document.getElementById("pageTable");
                let caption = pageTable.createCaption();
                caption.textContent = "Search Results";

                }
                

             

              }
              
        });

  }
  let searchBtn = document.getElementById("searchBtn");
  let resetBtn = document.getElementById("resetBtn");
  let prevBtn = document.getElementById("prevPage");
  let nextBtn = document.getElementById("nextPage");
  let recordOffset = 0;
  let recordFill = 0;
  let searchBool = false;
  let searchID = "0";
  let pageNum = document.getElementById("pageNumVal");
  let pageNumVal = 1;
  loadInitialList();
  
  
  searchBtn.addEventListener("click",function(){
    let searchBar = document.getElementById("dataSearch");
    searchID = searchBar.value;
    recordOffset = 0;
    searchBool = true;
    loadSearchList();
    
    });
  resetBtn.addEventListener("click", function(){
    recordOffset = 0;
    recordFill = 0;
    searchBool = false;
    let searchID = "0";
    let searchBar = document.getElementById("dataSearch");
    pageNumVal=1;
    searchBar.value = "";

    loadInitialList();

  });
  nextBtn.addEventListener("click", function(){
    if(recordFill==225 && (searchBool == false)){
        recordOffset +=25;
        loadInitialList();
        pageNumVal +=1;
    }else if(recordFill==225 &&(searchBool == true)){
        recordOffset +=25;
        loadSearchList();
        pageNumVal +=1;
    }

  });
  prevBtn.addEventListener("click", function(){
    if(recordOffset > 0 && (searchBool == false)){
        recordOffset -=25;
        loadInitialList();
        pageNumVal -=1;
    }else if(recordOffset > 0 && (searchBool == true)){
        recordOffset -=25;
        loadSearchList();
        pageNumVal -=1;
    }

  });
    

});
</script>
</head>

<body>
    <div class="menuBar">
        <a href="employeeHome.php">Home</a>
        <a href="checkout.php">Check-Out</a>
        <a href="return.php">Return</a>
        <a class="active" href="logs.php">Logs</a>
        <div class= "subgroup">
        <?php
         echo '<p class= "dynamic"> Welcome, '. $_SESSION['username']. '</p>';
        ?>
        <a href="../../PHP/logout.php">|Log Out|</a>
        <img src="../../img/Icon2.png" alt="Icon"> <!-- icon needs to be 50px by 50px -->
        </div>


    </div>
    <div class="mainContent">
        <h1>Logs</h1>
        <p class = "errorField" id ="errorField" ></p>
        <form>
                <div class="inputGroup">
                    <label for="dataSearch">Equipment ID:</label>
                    <input type="text" name="dataSearch" id="dataSearch">
                </div>
                
                <div class="buttonGroup">
                    <input type="button" id= "searchBtn" value="Search">
                    <input type="button" id="resetBtn" value="Reset">
                </div>
        </form>
        <table id = "pageTable">
            <caption>Recent Recordings</caption>
            <tr>
                <th>Transaction ID</th>
                <th>Type</th>
                <th>Date</th>
                <th>Employee ID</th>
                <th>Equipment ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Student Email</th>
                <th>Class</th>
            </tr>

        </table>
        <div class = "nextButtons">
        <button type="button" id= "prevPage"> << </button>
        <button type="button" id= "nextPage"> >> </button>
        
        </div>
        <div class="pageNumber">
            <p id= "pageNumVal">1</p>
        </div>
    </div>

</body>
<footer>
    <div class="footergroup">
    <p>CopyRight                          (999)999-9999</p>
    <p>123 street ave, Normal IL</p>
    </div>
</footer>