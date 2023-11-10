<?php
// php -S localhost:8080
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'p2_php';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
} else {
    return $conn;
}