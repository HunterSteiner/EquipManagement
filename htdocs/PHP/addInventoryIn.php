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


    $equipment_id = $_POST['equipID'];
    $equipment_name = $_POST['equipName'];
    $equipment_status = 1;

    

    $sql_query = "INSERT INTO equipment (equipment_id,equipment_status,equipment_name)
    VALUES ('$equipment_id','$equipment_status','$equipment_name')";

    if (mysqli_query($conn,$sql_query))
    {
        echo "1";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
