<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bagares";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['edit_information'])) {
    $id = $_POST['id'];

    // Fetch the employee data based on the ID
    $result = $conn->query("SELECT * FROM information WHERE id = $id");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
       
        echo '<style>
                form {
                    margin: 20px;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                    width: 300px;
                }
                input, button {
                    margin: 5px;
                    padding: 5px;
                    width: 100%;
                    box-sizing: border-box;
                }
                button {
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 3px;
                    cursor: pointer;
                }
              </style>';
        echo '<form method="post" action="update_information.php">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="text" name="fullname" value="' . $row['fullname'] . '"><br>';
        echo '<input type="text" name="age" value="' . $row['age'] . '"><br>';
        echo '<input type="text" name="address" value="' . $row['address'] . '"><br>';
        echo '<input type="text" name="contact" value="' . $row['contact'] . '"><br>';
        echo '<button type="submit" name="update_information">Update</button>';
        echo '</form>';
    } else {
        echo 'Information not found.';
    }
}

$conn->close();
?>
