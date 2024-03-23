<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bagares";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['update_information'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    // Update the employee details in the database
    $sql = "UPDATE information SET fullname='$fullname', age='$age', address='$address', contact='$contact' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: bagares.php');
        exit();
    } else {
        echo 'Error updating information details: ' . $conn->error;
    }
}

$conn->close();
?>
