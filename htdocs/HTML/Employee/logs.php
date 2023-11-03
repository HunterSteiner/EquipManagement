
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
        <table>
            <caption>Results</caption>
            <tr>
                <th>Equipment ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Owner</th>
            </tr>
            <tr>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
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