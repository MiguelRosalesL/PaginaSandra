<?php
$host = 'localhost';
$dbname = 'erp';
$user = 'root';
$password = '';

try {
    // Cambiar el DSN para MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData);

    // Guardar los datos del pedido en la tabla "pedidos"
    $stmtPedido = $pdo->prepare("INSERT INTO pedidos (fecha) VALUES (NOW())");
    $stmtPedido->execute();
    $pedidoId = $pdo->lastInsertId(); // Obtener el ID del pedido recién insertado

    // Guardar los datos del formulario en la tabla "datos_envio"
    $stmtDatosEnvio = $pdo->prepare("INSERT INTO datos_envio (pedido_id, nombre, apellido, telefono, calle, no_calle_interior, no_calle_exterior, departamento, colonia, cp, indicaciones, forma_pago) 
                                    VALUES (:pedido_id, :nombre, :apellido, :telefono, :calle, :noCalleInterior, :noCalleExterior, :departamento, :colonia, :cp, :indicaciones, :formaPago)");
    $stmtDatosEnvio->bindParam(':pedido_id', $pedidoId);
    $stmtDatosEnvio->bindParam(':nombre', $data->datosFormulario->nombre);
    $stmtDatosEnvio->bindParam(':apellido', $data->datosFormulario->apellido);
    $stmtDatosEnvio->bindParam(':telefono', $data->datosFormulario->telefono);
    $stmtDatosEnvio->bindParam(':calle', $data->datosFormulario->calle);
    $stmtDatosEnvio->bindParam(':noCalleInterior', $data->datosFormulario->noCalleInterior);
    $stmtDatosEnvio->bindParam(':noCalleExterior', $data->datosFormulario->noCalleExterior);
    $stmtDatosEnvio->bindParam(':departamento', $data->datosFormulario->departamento);
    $stmtDatosEnvio->bindParam(':colonia', $data->datosFormulario->colonia);
    $stmtDatosEnvio->bindParam(':cp', $data->datosFormulario->cp);
    $stmtDatosEnvio->bindParam(':indicaciones', $data->datosFormulario->indicaciones);
    $stmtDatosEnvio->bindParam(':formaPago', $data->datosFormulario->formaPago);
    $stmtDatosEnvio->execute();

    // Recorrer los elementos del carrito y guardarlos en la tabla "elementos"
    foreach ($data->carrito as $item) {
        $stmtElemento = $pdo->prepare("INSERT INTO elementos (pedido_id, nombre_item, cantidad, precio) 
                                      VALUES (:pedido_id, :nombre_item, :cantidad, :precio)");
        $stmtElemento->bindParam(':pedido_id', $pedidoId);
        $stmtElemento->bindParam(':nombre_item', $item->item);
        $stmtElemento->bindParam(':cantidad', $item->cantidad);
        $stmtElemento->bindParam(':precio', $item->precio);
        $stmtElemento->execute();
    }

    // Enviar una respuesta al cliente
    echo json_encode(['message' => 'Pedido y datos de envío guardados en la base de datos']);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
