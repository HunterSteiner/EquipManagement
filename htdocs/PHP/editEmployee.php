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
    $employee_id = $_POST['employeeId'];
    $employee_name = $_POST['employeeName'];
    

    
    

    $sql_query = "UPDATE employee SET employee_name = '$employee_name' WHERE employee_id = '$employee_id'"; 
    

    if (mysqli_query($conn,$sql_query))
    {
        echo "New Details Entry inserted successfully !";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);