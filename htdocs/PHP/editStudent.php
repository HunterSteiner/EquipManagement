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
    $stu_id = $_POST['stuId'];
    $stu_name = $_POST['stuName'];
    $stu_email = $_POST['stuEmail'];
    $stu_new_id = $_POST['newId'];

    

    $sql_query = "UPDATE student SET student_name = '$stu_name', student_email = '$stu_email', student_id = '$stu_new_id' WHERE student_id = '$stu_id'"; 
    

    if (mysqli_query($conn,$sql_query))
    {
        echo "New Details Entry inserted successfully !";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);