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

    $sql_query = "SELECT equipment_id, equipment_name FROM equipment WHERE equipment_status = 0 AND active = 1";

    $result = mysqli_query($conn,$sql_query);

    $stuList = array();

    

    if (mysqli_num_rows($result) == 0){
        echo "<p>Incorrect username or password.</p>";
    }
    else
    {
       while($row = mysqli_fetch_assoc($result)){
        $equipmentID = $row["equipment_id"];
        $stuList[] = $equipmentID;
        $stuList[] = $row["equipment_name"];

        $transaction_type = "Check-Out";

        $sql_query2 = "SELECT student_id FROM transaction WHERE equipment_id = $equipmentID ORDER BY transaction_id DESC LIMIT 1";
        $result2 = mysqli_query($conn,$sql_query2);

        while($row2 = mysqli_fetch_assoc($result2)){
            $studentID = $row2["student_id"];
            $stuList[] = $studentID;

            $sql_query3 = "SELECT student_name FROM student WHERE student_id = $studentID";
            $result3 = mysqli_query($conn,$sql_query3);

            while($row3 = mysqli_fetch_assoc($result3)){
                $stuList[] = $row3["student_name"];
            }
        }

       }

    }
    echo json_encode($stuList);


    
    mysqli_close($conn);
    ?>