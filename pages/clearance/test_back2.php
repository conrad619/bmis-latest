<?php

$imageName = "none";
    if (!empty($_FILES['attached_photo'])) {
        echo "image set";
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

    echo $leader_write;
    echo $imageName;
?>