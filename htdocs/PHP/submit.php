<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="databasetest";

$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error()); 
}

if(isset($_POST['save']))
{
    $user_type = $_POST['user_type'];
    $user_name = $_POST['user_name'];
    $passcode = $_POST['passcode'];

    $sql_query = "INSERT INTO entry_details (user_type,user_name,passcode)
    VALUES ('$user_type','$user_name','$passcode')";

    if (mysqli_query($conn,$sql_query))
    {
        echo "New Details Entry inserted successfully !";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}