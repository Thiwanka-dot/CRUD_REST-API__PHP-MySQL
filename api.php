<?php
header('Content-Type: application/json'); // Set the response header to JSON
include 'conn.php'; // Database connection file

// POST Method - Create a new user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $age = mysqli_real_escape_string($con, $_POST['age']);

    $query = "INSERT INTO users (name, email, age) VALUES ('$name', '$email', '$age')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo json_encode(["message" => "User created successfully"]);
    } else {
        echo json_encode(["error" => mysqli_error($con)]);
    }
}

// GET Method - Retrieve all users or a single user by ID
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $query = "SELECT * FROM users WHERE id = $id";
    } else {
        $query = "SELECT * FROM users";
    }

    $result = mysqli_query($con, $query);
    if ($result) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($users);
    } else {
        echo json_encode(["error" => mysqli_error($con)]);
    }
}

// PUT Method - Update user information
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = mysqli_real_escape_string($con, $_PUT['id']);
    $name = mysqli_real_escape_string($con, $_PUT['name']);
    $email = mysqli_real_escape_string($con, $_PUT['email']);
    $age = mysqli_real_escape_string($con, $_PUT['age']);

    $query = "UPDATE users SET name='$name', email='$email', age='$age' WHERE id=$id";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        echo json_encode(["error" => mysqli_error($con)]);
    }
}

// DELETE Method - Delete a user by ID
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = mysqli_real_escape_string($con, $_DELETE['id']);

    $query = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo json_encode(["message" => "User deleted successfully"]);
    } else {
        echo json_encode(["error" => mysqli_error($con)]);
    }
}

// Close the database connection
mysqli_close($con);
?>
