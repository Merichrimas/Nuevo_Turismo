<?php
$host = "localhost"; // o el nombre de host de tu servidor de base de datos
$user = "root"; // tu usuario de MySQL
$password = "0921"; // tu contraseña de MySQL
$dbname = "yucatan"; // el nombre de tu base de datos

// Crear conexión
$mysqli = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
?>
