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
    session_start();

    $user_name = $_POST['user_name'];
    $passcode = $_POST['passcode'];
    $user_type = $_POST['user_type'];
    $user_type_conv = 0;

    if ($user_type == "Administrator"){
        $user_type_conv = 1;
    }

    //check to see if username and password is valid

    
    

    $sql_query = "SELECT employee_id, passcode, employee_role FROM employee WHERE employee_id = '$user_name'";
    

    $result = mysqli_query($conn,$sql_query);

    if(mysqli_num_rows($result) == 0){
        echo "<p>Incorrect username or password.</p>";
    }
    else
    {
        $row = mysqli_fetch_assoc($result);

        $user_name_test = $row['employee_id'];
        $passcode_test = $row['passcode'];
        $user_type_test = $row['employee_role'];
        if(password_verify($passcode,$passcode_test)){
            $_SESSION["username"] = $user_name_test;
            if(($user_type_conv == 1) && ($user_type_test == 1) ){
                    $_SESSION["administrator"] = $user_type_test;
                    header("Location: ../HTML/Admin/adminHome.php");
                    die;
                
            }else{
                header("Location: ../HTML/Employee/employeeHome.php");
                die;

            }
            
            
        }
        else {
            echo "Incorrect username or password. </p>";
        }
        
    }
    
    mysqli_close($conn);
}