<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "cursos_programacion";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>