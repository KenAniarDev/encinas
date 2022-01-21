<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'encinas';

$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error) {
    die('error:' . $conn->connect_error);
}