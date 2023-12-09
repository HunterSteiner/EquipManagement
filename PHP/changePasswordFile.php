<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="checkoutdb";

$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error()); 
}


    $employee_id = $_POST['employeeId'];
    $employee_password = $_POST['employeePassword'];
    

    $pass_hash = password_hash("$employee_password", PASSWORD_BCRYPT);

    $sql_query = "UPDATE employee SET passcode = '$pass_hash' WHERE employee_id = '$employee_id'";

    

    if (mysqli_query($conn,$sql_query))
    {
        echo "New Details Entry inserted successfully !";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);