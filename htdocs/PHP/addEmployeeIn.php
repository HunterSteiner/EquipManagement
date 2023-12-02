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


    $full_name = $_POST['fullname'];
    
    $user_name = $_POST['username'];
    $passcode = $_POST['psw'];

    $pass_hash = password_hash("$passcode", PASSWORD_BCRYPT);

    $assignment = $_POST['user_type'];

    if($assignment== "Employee"){
        $privledge = 0;
    }else if($assignment == "Administrator"){
        $privledge = 1;

    }
    

    $sql_query = "INSERT INTO employee (employee_id,employee_name,employee_role,passcode)
    VALUES ('$user_name','$full_name','$privledge','$pass_hash')";

    if (mysqli_query($conn,$sql_query))
    {
        echo "1";
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
