<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="shop";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("kết nối thất bại: " . $conn->connect_error);
}