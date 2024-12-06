<?php
require 'database.php';

// Crear destino
function createReserva($nombre, $anticipo) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO reserva (nombre, anticipo) VALUES (?, ?)");
    $stmt->bind_param("sssd", $nombre, $anticipo);
    $stmt->execute();
    $stmt->close();
}

// Leer todos los destinos
function getReserva() {
    global $mysqli;
    $result = $mysqli->query("SELECT id, nombre, anticipo FROM reserva");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Actualizar un destino
function updateReserva($id, $nombre, $anticipo) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE reserva SET nombre = ?, anticipo= ? WHERE id = ?");
    $stmt->bind_param("sssdi", $nombre, $anticipo, $id);
    $stmt->execute();
    $stmt->close();
}

// Eliminar un destino
function deleteReserva($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM reserva WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?> 
