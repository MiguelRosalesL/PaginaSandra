<?php
$host = 'localhost';
$dbname = 'erp';
$user = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT pedidos.id AS pedido_id, pedidos.fecha, elementos.nombre_item, elementos.cantidad, elementos.precio,
          datos_envio.nombre, datos_envio.apellido, datos_envio.telefono,
          datos_envio.calle, datos_envio.no_calle_interior, datos_envio.no_calle_exterior,
          datos_envio.departamento, datos_envio.colonia, datos_envio.cp, datos_envio.indicaciones, datos_envio.forma_pago
          FROM pedidos
          JOIN elementos ON pedidos.id = elementos.pedido_id
          LEFT JOIN datos_envio ON pedidos.id = datos_envio.pedido_id
          ORDER BY pedidos.id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $pedidos = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pedido_id = $row['pedido_id'];
        if (!isset($pedidos[$pedido_id])) {
            $pedidos[$pedido_id] = [
                'id' => $pedido_id,
                'fecha' => $row['fecha'],
                'elementos' => [],
                'detalles_envio' => [
                    'nombre' => $row['nombre'],
                    'apellido' => $row['apellido'],
                    'telefono' => $row['telefono'],
                    'calle' => $row['calle'],
                    'no_calle_interior' => $row['no_calle_interior'],
                    'no_calle_exterior' => $row['no_calle_exterior'],
                    'departamento' => $row['departamento'],
                    'colonia' => $row['colonia'],
                    'cp' => $row['cp'],
                    'indicaciones' => $row['indicaciones'],
                    'forma_pago' => $row['forma_pago']
                ],
                'precio_total' => 0
            ];
        }
        $precio_elemento = $row['precio'];
        $pedidos[$pedido_id]['elementos'][] = [
            'nombre_item' => $row['nombre_item'],
            'cantidad' => $row['cantidad'],
            'precio' => $precio_elemento
        ];
        $pedidos[$pedido_id]['precio_total'] += $precio_elemento;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
