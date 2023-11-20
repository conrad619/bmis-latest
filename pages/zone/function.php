<?php
session_start();
include "../connection.php";


if(isset($_POST['btn_add'])){
    $txt_zone = $_POST['txt_zone'];
    $txt_uname = $_POST['txt_uname'];
    $txt_pass = $_POST['txt_pass'];
    $txt_fullname = $_POST['txt_fullname'];
    $txt_bday = $_POST['txt_bday'];
    $txt_addr = $_POST['txt_addr'];
    $txt_bcontactno = $_POST['txt_bcontactno'];
    $txt_position = $_POST['txt_position'];
    $txt_emcontactno = $_POST['txt_emcontactno'];


    // if(isset($_SESSION['role'])){
    //     $action = 'Added Zone number '.$txt_zone;
    //     $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    // }

    $su = mysqli_query($con,"SELECT * from tblzone where username = '".$txt_uname."' ");
    $ct = mysqli_num_rows($su);

    if($ct == 0){
        $query = mysqli_query($con,"INSERT INTO tblzone (zone,username,password,zone_name,zone_birthday,zone_address,bcontactno,position,emcontactno) 
            values ('$txt_zone', '$txt_uname', '$txt_pass', '$txt_fullname', '$txt_bday', '$txt_addr ', '$txt_bcontactno', '$txt_position','$txt_emcontactno')") or die('Error: ' . mysqli_error($con));
        if($query == true)
        {
            $_SESSION['added'] = 1;
            header ("location: zone.php");
        } 
        if(isset($_SESSION['role'])){
            $action = 'Added Zone number '.$txt_zone;
            $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
        }
    }
    else{
        $_SESSION['duplicateuser'] = 1;
        header ("location: zone.php");
    } 
}


if(isset($_POST['btn_save']))
{
    $txt_id = $_POST['hidden_id'];
    $txt_edit_zone = $_POST['txt_edit_zone'];
    $txt_edit_uname = $_POST['txt_edit_uname'];
    $txt_edit_pass = $_POST['txt_edit_pass'];
    $txt_edit_fullname = $_POST['txt_edit_fullname'];
    $txt_edit_bday = $_POST['txt_edit_bday'];
    $txt_edit_addr = $_POST['txt_edit_addr'];
    $txt_edit_bcontactno = $_POST['txt_edit_bcontactno'];
    $txt_edit_position = $_POST['txt_edit_position'];
    $txt_edit_emcontactno = $_POST['txt_edit_emcontactno'];
    

    if(isset($_SESSION['role'])){
        $action = 'Update Zone number '.$txt_edit_busname;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    $su = mysqli_query($con,"SELECT * from tblzone where username = '".$txt_edit_uname."' ");
    $ct = mysqli_num_rows($su);
    
    if($ct == 0){
        $update_query = mysqli_query($con,"UPDATE tblzone set zone = '".$txt_edit_zone."', username = '".$txt_edit_uname."', password = '".$txt_edit_pass."', zone_name='".$txt_edit_fullname."', zone_birthday = '".$txt_edit_bday."', zone_address = '" .$txt_edit_addr."', bcontactno = '".$txt_edit_bcontactno."', position = '".$txt_edit_position."', emcontactno = '".$txt_edit_emcontactno."' where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

        if($update_query == true){
            $_SESSION['edited'] = 1;
            header("location: ".$_SERVER['REQUEST_URI']);
        }
    }
    else{
        $_SESSION['duplicateuser'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    } 
}

if(isset($_POST['btn_delete']))
{
    if(isset($_POST['chk_delete']))
    {
        foreach($_POST['chk_delete'] as $value)
        {
            $delete_query = mysqli_query($con,"DELETE from tblzone where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if(isset($_SESSION['role'])){
                $action = 'Delete zone with id '.$value;
                $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
            }
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }
    }
}


?>