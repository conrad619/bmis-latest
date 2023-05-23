<?php
// Get the form data
$complaint_id = $_GET['ID'];
$new_schedule = $_POST['new_schedule'];

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
    if ($update_status === 'settled') {
        $sql = "UPDATE complaints SET status = 'settled' WHERE complaint_id = $complaint_id";
    } else if ($update_status === 'dismissed') {
        $sql = "UPDATE complaints SET status = 'dismissed' WHERE complaint_id = $complaint_id";
    }
}

if ($con->query($sql) === TRUE) {
    echo "Complaint submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

// Close the database connection
$con->close();

// Reload the page
header("Location: complaints.php");
exit;
