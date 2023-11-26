<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="checkoutdb";


session_start();
if (!isset ($_SESSION["username"])){
    header ("Location: ../../index.html");
    die;
}


$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error()); 
}

    $sql_query = "SELECT transaction_id, transaction_info, transaction_date, employee_id, equipment_id, student_id FROM transaction ORDER BY transaction_id DESC";

    $result = mysqli_query($conn,$sql_query);

    $stuList = array();

    

    if (mysqli_num_rows($result) == 0){
        echo "<p>Incorrect username or password.</p>";
    }
    else
    {
       while($row = mysqli_fetch_assoc($result)){
        $stuList[] = $row["transaction_id"];
        $stuList[] = $row["transaction_info"];
        $stuList[] = $row["transaction_date"];
        $stuList[] = $row["employee_id"];
        $stuList[] = $row["equipment_id"];
        $stuList[] = $row["student_id"];

       }

    }
    echo json_encode($stuList);


    
    mysqli_close($conn);
    ?>