<?php
// session_start();
// session_destroy();
// header("location: login.php");
session_start();
session_destroy();

if (isset($_SESSION['resident']) == 1) {
    header("location: pages/resident/login.php");
   
}

if (isset($_SESSION['role']) == "Zone Leader") {
    header("location: pages/zone/login.php");
}else{
    header("location: pages/resident/login.php");

}
if (isset($_SESSION['role']) == "Administrator") {
    header("location: pages/resident/login.php");

}else{
    header("location: pages/resident/login.php");

}
?>