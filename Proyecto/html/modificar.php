<?php
include "conexion.php";

// Obtener el ID del pedido a editar
$id = $_GET['id']; 

// Recuperar los datos del pedido
$sql = "SELECT * FROM pedidos WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$pedido = $result->fetch_assoc();

// Recuperar los datos de elementos
$sql_elementos = "SELECT * FROM elementos WHERE pedido_id = ?";
$stmt_elementos = $mysqli->prepare($sql_elementos);
$stmt_elementos->bind_param("i", $id);
$stmt_elementos->execute();
$result_elementos = $stmt_elementos->get_result();
$elementos = $result_elementos->fetch_all(MYSQLI_ASSOC);

// Recuperar los datos de envío
$sql_envio = "SELECT * FROM datos_envio WHERE pedido_id = ?";
$stmt_envio = $mysqli->prepare($sql_envio);
$stmt_envio->bind_param("i", $id);
$stmt_envio->execute();
$result_envio = $stmt_envio->get_result();
$envio = $result_envio->fetch_assoc();

// Cerrar la conexión
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Editar Pedido</h2>
        <form action="actualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
            
            <!-- Campos de pedidos -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $pedido['fecha']; ?>">
            </div>

            <!-- Campos de elementos -->
            <?php foreach ($elementos as $index => $elemento) { ?>
                <div class="mb-3">
                    <label for="nombre_item_<?php echo $index; ?>" class="form-label">Nombre Item</label>
                    <input type="text" class="form-control" id="nombre_item_<?php echo $index; ?>" name="elementos[<?php echo $index; ?>][nombre_item]" value="<?php echo $elemento['nombre_item']; ?>">
                    
                    <label for="cantidad_<?php echo $index; ?>" class="form-label">Cantidad</label>
                    <input type="number" step="0.01" class="form-control" id="cantidad_<?php echo $index; ?>" name="elementos[<?php echo $index; ?>][cantidad]" value="<?php echo number_format($elemento['cantidad'], 2); ?>">
                    
                    <label for="precio_<?php echo $index; ?>" class="form-label">Precio</label>
                    <input type="number" step="0.01" class="form-control" id="precio_<?php echo $index; ?>" name="elementos[<?php echo $index; ?>][precio]" value="<?php echo number_format($elemento['precio'], 2); ?>">
                    
                    <input type="hidden" name="elementos[<?php echo $index; ?>][id]" value="<?php echo $elemento['id']; ?>">
                </div>
            <?php } ?>

            <!-- Campos de envío -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="detalles_envio[nombre]" value="<?php echo $envio['nombre']; ?>">
                
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="detalles_envio[apellido]" value="<?php echo $envio['apellido']; ?>">
                
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="detalles_envio[telefono]" value="<?php echo $envio['telefono']; ?>">
                
                <label for="calle" class="form-label">Calle</label>
                <input type="text" class="form-control" id="calle" name="detalles_envio[calle]" value="<?php echo $envio['calle']; ?>">
                
                <label for="no_calle_interior" class="form-label">No. Calle Interior</label>
                <input type="text" class="form-control" id="no_calle_interior" name="detalles_envio[no_calle_interior]" value="<?php echo $envio['no_calle_interior']; ?>">
                
                <label for="no_calle_exterior" class="form-label">No. Calle Exterior</label>
                <input type="text" class="form-control" id="no_calle_exterior" name="detalles_envio[no_calle_exterior]" value="<?php echo $envio['no_calle_exterior']; ?>">
                
                <label for="departamento" class="form-label">Departamento</label>
                <input type="text" class="form-control" id="departamento" name="detalles_envio[departamento]" value="<?php echo $envio['departamento']; ?>">
                
                <label for="colonia" class="form-label">Colonia</label>
                <input type="text" class="form-control" id="colonia" name="detalles_envio[colonia]" value="<?php echo $envio['colonia']; ?>">
                
                <label for="cp" class="form-label">Código Postal</label>
                <input type="text" class="form-control" id="cp" name="detalles_envio[cp]" value="<?php echo $envio['cp']; ?>">
                
                <label for="indicaciones" class="form-label">Indicaciones</label>
                <input type="text" class="form-control" id="indicaciones" name="detalles_envio[indicaciones]" value="<?php echo $envio['indicaciones']; ?>">
                
                <label for="forma_pago" class="form-label">Forma de Pago</label>
                <input type="text" class="form-control" id="forma_pago" name="detalles_envio[forma_pago]" value="<?php echo $envio['forma_pago']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
