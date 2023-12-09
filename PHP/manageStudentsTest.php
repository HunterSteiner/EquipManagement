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
    
    $class_id = $_SESSION["selectedClass"];
    

    $sql_query = "SELECT student_id, student_name FROM student WHERE class_id = '$class_id'";

    $result = mysqli_query($conn,$sql_query);

    $stuList = array();

    $_SESSION["selectedClass"] = $class_id;

    $testval = 0;

    $counter = 0;


    if (mysqli_num_rows($result) == 0){
        echo "<p>Incorrect username or password.</p>";
    }
    else
    {
       while($row = mysqli_fetch_assoc($result)){
        $stuList[] = $row["student_id"];

        $stuList[] = $row["student_name"];
        

       }

    }

    echo json_encode($stuList);
    
    mysqli_close($conn);
