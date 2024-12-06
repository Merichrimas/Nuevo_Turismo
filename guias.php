<?php
require 'database.php';

// Crear destino
function createGuias($nombre, $edad, $especialidad, $num_telefono,$correo,$precio) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO guias (nombre, edad, especialidad,num_telefono, correo, precio) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssd", $nombre, $edad, $especialidad, $num_telefono,$correo,$precio );
    $stmt->execute();
    $stmt->close();
}

// Leer todos los destinos
function getGuias() {
    global $mysqli;
    $result = $mysqli->query("SELECT id, nombre, edad, especialidad,num_telefono, correo, precio FROM guias");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Actualizar un destino
function updateGuias($id, $nombre, $edad, $especialidad, $num_telefono,$correo,$precio) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE guias SET nombre= ?, edad= ?, especialidad= ?,num_telefono= ?, correo= ?, precio = ? WHERE id = ?");
    $stmt->bind_param("sssdi", $nombre, $edad, $especialidad, $num_telefono,$correo,$precio $id);
    $stmt->execute();
    $stmt->close();
}

// Eliminar un destino
function deleteGuias($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM guias WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>
