<?php
// Get the form data
$resident_id = $_POST['resident_id'];
$complainant = $_POST['complainant'];
$against = $_POST['against'];
$date = date('Y-m-d');
$time = date('H:i:s');
$purpose = $_POST['purpose'];
$complain_description = $_POST['complain_description'];
$response = $_POST['response'];

include "../connection.php";

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert the form data into the "complaints" table
$sql = "INSERT INTO complaints (resident_id, complainant, against, date, time, purpose, complain_description, response) VALUES ('$resident_id', '$complainant', '$against', '$date', '$time', '$purpose', '$complain_description', '$response')";
if ($con->query($sql) === TRUE) {
    echo "Complaint submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$con->close();

// Reload the page
header("Location: complaints.php?ID=$complaint_id");
exit;
