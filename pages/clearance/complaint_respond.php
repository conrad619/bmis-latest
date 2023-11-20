<?php
session_start();
// Get the form data
$complaint_id = $_GET['ID'];
if (isset($_POST['new_schedule'])) {
    $new_schedule = $_POST['new_schedule'];
}

// Check which button was clicked
if (isset($_POST['update_settle'])) {
    $update_status = 'settled';
} else if (isset($_POST['update_dismiss'])) {
    $update_status = 'dismissed';
} else {
    // Neither button was clicked
    $update_status = '';
}

include "../connection.php";

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Insert the form data into the "complaints" table

$sql = "SELECT * FROM complaints WHERE complaint_id='$complaint_id'";
$result = $con->query($sql);
$row = $result->fetch_assoc();

if ($row['status'] === 'pending') {
    $sql = "UPDATE complaints SET status = 'acknowledged', new_schedule = '$new_schedule' WHERE complaint_id = $complaint_id";
} else if ($row['status'] === 'acknowledged') {
    
    $imageName = "none";
    
    echo '<pre>'; print_r($_FILES['attached_photo']['name']); echo '</pre>';
    if (isset($_FILES['attached_photo']) && !empty($_FILES['attached_photo']['name'])) {
        echo "set image";
        $file = $_FILES['attached_photo'];

        // Check if the uploaded file is an image
        $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (getimagesize($file['tmp_name']) === false) {
            die("Error: This is not an image file.");
        }

        // Generate a unique name for the image
        $imageName = uniqid() . '.' . $imageFileType;

        // Set the upload directory path
        $uploadDir = "uploads/";

        // Move the uploaded image to the server
        move_uploaded_file($file['tmp_name'], $uploadDir . $imageName);
            // Insert image information into the database

    }
    $leader_write = "";
    if(isset($_POST['leader_write'])){
        $leader_write=$_POST['leader_write'];
    }

    if ($update_status === 'settled') {
        $sql = "UPDATE complaints SET status = 'settled', leader_write = '". $leader_write ."',attached_photo = '".$imageName."' WHERE complaint_id = $complaint_id";
    } else if ($update_status === 'dismissed') {
        $sql = "UPDATE complaints SET status = 'dismissed', leader_write = '". $leader_write ."',attached_photo = '".$imageName."' WHERE complaint_id = $complaint_id";
    }

}

if ($con->query($sql) === TRUE) {
    echo "Complaint submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
if(isset($_SESSION['role'])){
    $action = 'Updated complaint on '. $row['complaint_id'] .'  with status '.$update_status;
    $iquery = mysqli_query($con,"INSERT INTO tbllogs (userid,user,username,logdate,action) values ('".$_SESSION['userid']."', '".$_SESSION['role']."','".$_SESSION['username']."',  NOW(), '".$action."')");
}
// Close the database connection
$con->close();

// Reload the page
// header("Location: complaints.php");
exit;
