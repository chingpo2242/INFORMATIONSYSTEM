<style>
  body {
            font-family: 'Comic Sans MS', 'Arial', sans-serif;
            background-color: #fdf7f7;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #ff4d4d;
            margin-top: 20px;
            font-size: 36px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Additional styles for the form and table */
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container button {
            border: none;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #ffe6e6;
            color: #ff4d4d;
        }

        .form-container button {
            background-color: #ff9999;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #ff6666;
        }

        .table-container {
            margin-top: 20px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
            font-size: 18px;
            color: #ff4d4d;
        }

        .table-container th {
            background-color: #ff9999;
            color: #fff;
        }

        .table-container tr:nth-child(even) {
            background-color: #ffe6e6;
        }

        .table-container button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 16px;
            color: #fff;
        }

        .table-container button.edit {
            background-color: #4CAF50; /* Green color for edit button */
        }

        .table-container button.delete {
            background-color: #DC3545; /* Red color for delete button */
        }

        .table-container button:hover {
            background-color: #ff3333;
        }

        .table-container button.edit:hover {
            background-color: #2e8b57; /* Darker green on edit button hover */
        }

        .table-container button.delete:hover {
            background-color: #c82333; /* Darker red on delete button hover */
        }

        .table-container button:hover {
            transform: scale(1.05);
        }
    
</style>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bagares";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addInformation($conn, $fullname, $age, $address, $contact) {
   
    if(strlen($age) > 10) { // Adjust the maximum length as per your database schema
        echo "Error: Age is too long.";
        return;
    }
    
    $sql = "INSERT INTO information (fullname, age, address, contact) VALUES ('$fullname', '$age', '$address', '$contact')";
    if ($conn->query($sql) === TRUE) {
        echo "New information added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['add_information'])) {
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];

    addInformation($conn, $fullname, $age, $address, $contact);
    header("Location: bagares.php");
    exit();
}
?>

<div class="container">

    <div class="form-container form-animation">
        <form method="post" action="bagares.php">
            <input type="text" name="fullname" placeholder="FullName"><br>
            <input type="text" name="age" placeholder="Age"><br>
            <input type="text" name="address" placeholder="Address"><br>
            <input type="text" name="contact" placeholder="Contact"><br>
            <button type="submit" name="add_information">Add information</button>
        </form>
    </div>

    <?php
    echo '<div class="table-container table-animation">';
    echo '<table>';
    echo '<tr>';
    echo '<th>FullName</th>';
    echo '<th>Age</th>';
    echo '<th>Address</th>';
    echo '<th>Contact</th>';
    echo '<th>Actions</th>'; 
    echo '</tr>';

    $result = $conn->query("SELECT * FROM information");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['fullname'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . $row['address'] . '</td>';
            echo '<td>' . $row['contact'] . '</td>';
    

            echo '<td>';
            echo '<form method="post" action="edit_information.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="edit_information">Edit</button>';
            echo '</form>';
            echo '<form method="post" action="delete_information.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="delete_information">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
    }

    echo '</table>';
    echo '</div>';
    ?>
</div>


<?php $conn->close(); ?>
