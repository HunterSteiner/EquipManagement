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

if(isset($_POST['save']))
{
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $user_name = $_POST['username'];
    $passcode = $_POST['psw'];
    $privledge = 0;

    $sql_query = "INSERT INTO employee (employee_id,first_name,last_name,employee_role,passcode)
    VALUES ('$user_name','$first_name','$last_name','$privledge','$passcode')";

    if (mysqli_query($conn,$sql_query))
    {
        echo "New Details Entry inserted successfully !";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}