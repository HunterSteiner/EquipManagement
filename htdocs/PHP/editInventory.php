<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="checkoutdb";
//Just checks if the user has the proper authorization to access
session_start();
if ((!isset ($_SESSION["username"])) || (!isset ($_SESSION["administrator"]))){
    header ("Location: ../../index.html");
    die;
} 

//assigns the connection to database with $conn
$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error()); 
}

//  getting values from the form submitted
    $equipment_id = $_POST['equipmentId'];
    $equipment_name = $_POST['equipmentName'];

    
    

    $sql_query = "UPDATE equipment SET equipment_name = '$equipment_name' WHERE equipment_id = '$equipment_id'"; 
    

    if (mysqli_query($conn,$sql_query))
    {
        echo "New Details Entry inserted successfully !";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);