<?php
// Database configuration
$servername = "localhost";
$username = "elsebaey";
$password = "admin";
$dbname = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,6767);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check if the username exists
function checkUsername($conn, $username) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Function to insert user data
function insertUser($conn, $userData) {
    $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (full_name, user_name, birthdate, phone, address, password, user_image, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $userData['full_name'], $userData['user_name'], $userData['birthdate'], $userData['phone'], $userData['address'], $userData['password'], $userData['user_image'], $userData['email']);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}
?>