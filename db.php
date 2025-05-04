<?php
$host = 'localhost';
$user = 'root';
$pass = 'Sistemas.1234';
$db = 'sistemas';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>