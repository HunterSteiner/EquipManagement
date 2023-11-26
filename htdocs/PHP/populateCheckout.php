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

    $sql_query = "SELECT equipment_id, equipment_name FROM equipment WHERE equipment_status = 1 AND active = 1";

    $result = mysqli_query($conn,$sql_query);

    $stuList = array();

    

    if (mysqli_num_rows($result) == 0){
        echo "<p>Incorrect username or password.</p>";
    }
    else
    {
       while($row = mysqli_fetch_assoc($result)){
        $stuList[] = $row["equipment_id"];
        $stuList[] = $row["equipment_name"];

       }

    }
    echo json_encode($stuList);


    
    mysqli_close($conn);
    ?>