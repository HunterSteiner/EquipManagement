
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

    function loadList(){
    console.log("hello");
    $.getJSON('../../PHP/populateLogs.php', function(data) {
        let array = data;
        console.log(array[0]);
        console.log(array[1]);
        console.log(array[2]);
        console.log(array[3]);
        console.log(array[4]);
        console.log(array[5]);
        
        let pageTable = document.getElementById("pageTable");

        for(let i = 0; i <array.length; i+=6){
            let tableRow = document.createElement("tr");
            let data1 = document.createElement("td");
            let data2 = document.createElement("td");
            let data3 = document.createElement("td");
            let data4 = document.createElement("td");
            let data5 = document.createElement("td");
            let data6 = document.createElement("td");

            data1.innerHTML = array[i];
            data2.innerHTML = array[i+1];
            data3.innerHTML = array[i+2];
            data4.innerHTML = array[i+3];
            data5.innerHTML = array[i+4];
            data6.innerHTML = array[i+5];

            tableRow.appendChild(data1);
            tableRow.appendChild(data2);
            tableRow.appendChild(data3);
            tableRow.appendChild(data4);
            tableRow.appendChild(data5);
            tableRow.appendChild(data6);

            pageTable.appendChild(tableRow);


        }
      

    });
  }
  loadList();

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../../PHP/checkoutFile.php',
            data: $('form').serialize(),
            success: function(res) {

              alert("Equipment checked out.");

              input1 = document.getElementById("equipmentid");
              input1.value = "";

              input2 = document.getElementById("studentid");
              input2.value = "";

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
        <form>
                <div class="inputGroup">
                    <label for="dataSearch">Equipment ID:</label>
                    <input type="text" name="dataSearch" id="dataSearch">
                </div>
                <div class="inputGroup">
                    <label for="date1">From:</label>
                    <input type="date" name="date1" id="date1">
                </div>
                <div class="inputGroup">
                    <label for="date2">To:</label>
                    <input type="date" name="date2" id="date2">
                </div>
                <div class="buttonGroup">
                    <input type="submit" value="Search">
                    <input type="reset"  value="Reset">
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
            </tr>

        </table>
    </div>

</body>
<footer>
    <div class="footergroup">
    <p>CopyRight                          (999)999-9999</p>
    <p>123 street ave, Normal IL</p>
    </div>
</footer>