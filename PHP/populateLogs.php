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
    $record_offset = $_POST['recordOffset'];

    $sql_query = "SELECT transaction_id, transaction_info, transaction_date, employee_id, equipment_id, student_id FROM transaction ORDER BY transaction_id DESC LIMIT 25 OFFSET $record_offset";

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
        
        
        $stuIDBuffer = $row["student_id"];
        $stuList[] = $stuIDBuffer;

        $sql_query2 = "SELECT student_name, student_email, class_id FROM student WHERE student_id = '$stuIDBuffer'";
        $result2 = mysqli_query($conn,$sql_query2);

        while($row2 = mysqli_fetch_assoc($result2)){
            $stuList[] = $row2["student_name"];
            $stuList[] = $row2["student_email"];
            $stuList[] = $row2["class_id"];
        }
       }

    }
    echo json_encode($stuList);


    
    mysqli_close($conn);
    ?>