<?php
include "conexion.php";
// Obtener el ID del pedido a eliminar
$id = $_POST['id'];
// Iniciar una transacción
$mysqli->begin_transaction();

try {
    // Eliminar registros de la tabla `datos_envio`
    $sql = "DELETE FROM datos_envio WHERE pedido_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Eliminar registros de la tabla `elementos`
    $sql = "DELETE FROM elementos WHERE pedido_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Eliminar el pedido de la tabla `pedidos`
    $sql = "DELETE FROM pedidos WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Confirmar la transacción
    $mysqli->commit();

    // Redirigir de vuelta a la página de gestión de ventas
    header("Location: GestionVentas.php");
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $mysqli->rollback();
    echo "Error: " . $e->getMessage();
}
// Cerrar la conexión
$mysqli->close();
?>