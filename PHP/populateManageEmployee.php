<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="checkoutdb";

session_start();
if ((!isset ($_SESSION["username"])) || (!isset ($_SESSION["administrator"]))){
    header ("Location: ../../index.html");
    die;
} 



$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error()); 
}

    $sql_query = "SELECT employee_id, employee_name, employee_role FROM employee WHERE active = 1";

    $result = mysqli_query($conn,$sql_query);

    $stuList = array();

    

    if (mysqli_num_rows($result) == 0){
        echo "<p>Incorrect username or password.</p>";
    }
    else
    {
       while($row = mysqli_fetch_assoc($result)){
        $stuList[] = $row["employee_id"];
        $stuList[] = $row["employee_name"];
        $stuList[] = $row["employee_role"];

       }

    }
    echo json_encode($stuList);


    
    mysqli_close($conn);
    ?>