<?php
// Database connection settings
$servername = "127.0.0.1:3307";
$username = "root";
$password = "1@3mys0lwork";
$database = "recipe_web";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>