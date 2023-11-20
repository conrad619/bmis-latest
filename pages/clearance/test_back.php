<?php
session_start();
include "../connection.php";
$status = "Pending";


$imageName = null;
if (isset($_FILES['attached_photo'])) {
    $file = $_FILES['attached_photo'];
    echo $file['name'];
    // Check if the uploaded file is an image
    $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (getimagesize($file['tmp_name']) === false) {
        die("Error: This is not an image file.");
    }

    // Generate a unique name for the image
    $imageName = uniqid() . '.' . $imageFileType;

    // Set the upload directory path
    $uploadDir = "uploads/";
    echo $imageName;
    // Move the uploaded image to the server
    echo move_uploaded_file($file['tmp_name'], $uploadDir . $imageName);
    // Insert image information into the database

}

$request_form_type_insert = mysqli_query($con, 
        "INSERT INTO image_store (file_name)
        values ('" . $imageName  . "')");

        
$sql = "SELECT * FROM image_store
        WHERE file_name!=''";
        $user_member = $con->query($sql) or die ($con->error);
        $row = $user_member->fetch_assoc();
    

        $data =  array("success" => 0,
            "data" => array(
            "file_name" => $row['file_name']
        ));
?>