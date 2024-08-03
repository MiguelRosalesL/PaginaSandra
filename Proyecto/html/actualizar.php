<?php
include "conexion.php";

// Obtener datos del formulario
$id = $_POST['id'];
$fecha = $_POST['fecha'];
$elementos = $_POST['elementos'];
$detalles_envio = $_POST['detalles_envio'];

// Actualizar los datos del pedido
$sql_pedido = "UPDATE pedidos SET fecha = ? WHERE id = ?";
$stmt_pedido = $mysqli->prepare($sql_pedido);
$stmt_pedido->bind_param("si", $fecha, $id);
$stmt_pedido->execute();

// Actualizar los datos de los elementos
foreach ($elementos as $elemento) {
    $sql_elemento = "UPDATE elementos SET nombre_item = ?, cantidad = ?, precio = ? WHERE id = ?";
    $stmt_elemento = $mysqli->prepare($sql_elemento);
    $stmt_elemento->bind_param("sddi", $elemento['nombre_item'], $elemento['cantidad'], $elemento['precio'], $elemento['id']);
    $stmt_elemento->execute();
}

// Actualizar los datos de envío
$sql_envio = "UPDATE datos_envio SET nombre = ?, apellido = ?, telefono = ?, calle = ?, no_calle_interior = ?, no_calle_exterior = ?, departamento = ?, colonia = ?, cp = ?, indicaciones = ?, forma_pago = ? WHERE pedido_id = ?";
$stmt_envio = $mysqli->prepare($sql_envio);
$stmt_envio->bind_param("sssssssssssi", $detalles_envio['nombre'], $detalles_envio['apellido'], $detalles_envio['telefono'], $detalles_envio['calle'], $detalles_envio['no_calle_interior'], $detalles_envio['no_calle_exterior'], $detalles_envio['departamento'], $detalles_envio['colonia'], $detalles_envio['cp'], $detalles_envio['indicaciones'], $detalles_envio['forma_pago'], $id);
$stmt_envio->execute();

// Cerrar la conexión
$mysqli->close();

// Redirigir a la página de gestión de ventas
header("Location: GestionVentas.php");
exit();
?>
