<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bagares";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete_information'])) {
    $id = $_POST['id'];

    // Delete the employee based on the ID
    $sql = "DELETE FROM information WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: bagares.php');
        exit();
    } else {
        echo 'Error deleting information: ' . $conn->error;
    }
}

$conn->close();
?>
