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


    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $user_name = $_POST['username'];
    $passcode = $_POST['psw'];

    $pass_hash = password_hash("$passcode", PASSWORD_BCRYPT);

    $assignment = $_POST['user_type'];

    if($assignment== "Employee"){
        $privledge = 0;
    }else if($assignment == "Administrator"){
        $privledge = 1;

    }
    

    $sql_query = "INSERT INTO employee (employee_id,first_name,last_name,employee_role,passcode)
    VALUES ('$user_name','$first_name','$last_name','$privledge','$pass_hash')";

    if (mysqli_query($conn,$sql_query))
    {
        echo "New Details Entry inserted successfully !";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
