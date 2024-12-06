<?php
require 'database.php';

// Crear destino
function createHoteles($nombre, $descripcion, $ubicacion, $precio_por_noche, $precio_por_dia,$estrellas) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO hoteles (nombre, descripcion, ubicacion, precio_por_noche,precio_por_dia,estrellas) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssd", $nombre, $descripcion, $ubicacion, $precio_por_noche, $precio_por_dia,$estrellas);
    $stmt->execute();
    $stmt->close();
}

// Leer todos los destinos
function getHoteles() {
    global $mysqli;
    $result = $mysqli->query("SELECT id,nombre, descripcion, ubicacion, precio_por_noche,precio_por_dia,estrellas FROM hoteles");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Actualizar un destino
function updateHoteles($id, $nombre, $descripcion, $ubicacion, $precio_estimado) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE hoteles SET nombre = ?, descripcion = ?, ubicacion = ?, precio_por_noche= ?,precio_por_dia= ?,estrellas = ? WHERE id = ?");
    $stmt->bind_param("sssdi",  $nombre, $descripcion, $ubicacion, $precio_por_noche, $precio_por_dia,$estrellas, $id);
    $stmt->execute();
    $stmt->close();
}

// Eliminar un destino
function deleteHoteles($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM hoteles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>
