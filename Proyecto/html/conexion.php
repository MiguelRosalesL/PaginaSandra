<?php
$mysqli = new mysqli('localhost', 'root', '', 'erp');

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
?>
