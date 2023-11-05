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


    $class_id = $_POST['classID'];
    $class_name = $_POST['className'];

    

    $sql_query = "INSERT INTO class (class_id,class_name)
    VALUES ('$class_id','$class_name')";

    if (mysqli_query($conn,$sql_query))
    {
        echo "New Details Entry inserted successfully !";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
