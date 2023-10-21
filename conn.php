<?php
$host = 'localhost';
$username = 'root';
$password = 'admin';
$database = 'p2_php';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
} else {
    return $conn;
}