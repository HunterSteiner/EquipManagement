<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="checkoutdb";

session_start();
if (!isset ($_SESSION["username"])){
    header ("Location: ../../index.html");
    die;
}

$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error()); 
}

if(isset($_POST['save']))
{
    $equipment_id = $_POST['equipmentid'];
    $student_id = $_POST['studentid'];

    $transaction_info = "Check-Out";
    $transaction_date = date("Y-m-d");

    $employee_id = $_SESSION["username"];

    
    

    $sql_query = "INSERT INTO transaction (transaction_info,transaction_date,employee_id,equipment_id,student_id)
    VALUES ('$transaction_info','$transaction_date','$employee_id','$equipment_id','$student_id')";

    if (mysqli_query($conn,$sql_query))
    {
        echo "New Details Entry inserted successfully !";
        $sql_query = "UPDATE equipment SET equipment_status=0 WHERE equipment_id='$equipment_id'";
        if(mysqli_query($conn,$sql_query)){
            echo "status has been changed for equipment";
        }
        else{
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }

    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}