<?php
session_start();
include "../connection.php";
    if(isset($_SESSION['role'])){
        $action = 'Added Request information ';
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (userid,user,username,logdate,action) values ('".$_SESSION['userid']."', '".$_SESSION['role']."','".$_SESSION['username']."',  NOW(), '".$action."')");
        echo $iquery;
        echo "test2";
        $last_id = $con->insert_id;
        echo $last_id;
    }
    echo "test";
    echo $_SESSION['role'];
?>