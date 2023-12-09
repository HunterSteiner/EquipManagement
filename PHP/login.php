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


    session_start();

    $user_name = $_POST['user_name'];
    $passcode = $_POST['passcode'];
    $user_type = $_POST['user_type'];
    $user_type_conv = 0;
    

    if ($user_type == "Administrator"){
        $user_type_conv = 1;
    }

    //check to see if username and password is valid

    
    

    $sql_query = "SELECT employee_id, passcode, employee_role FROM employee WHERE employee_id = ?";

    $stmt = $conn->prepare($sql_query);

    $stmt->bind_param("s", $user_name);

    $stmt->execute();
    

    $result = $stmt->get_result();

    if($result->num_rows == 0){
        echo "fail";
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
                    echo "admin";
                    die;
                
            }else{
                echo "employee";
                die;

            }
            
            
        }
        else {
            echo "fail";
        }
        
    }
    
    mysqli_close($conn);
