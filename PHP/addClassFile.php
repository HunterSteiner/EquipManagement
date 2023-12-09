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
    $class_id = $_POST['classID'];
    $class_name = $_POST['className'];

    

    $sql_query = "INSERT INTO class (class_id,class_name)
    VALUES ('$class_id','$class_name')";

    if (mysqli_query($conn,$sql_query))
    {
        echo "1";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
