<?php
include 'obtener_pedidos.php';

session_start();
$tipo_usuario = $_SESSION['tipo_usuario'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/PaginaSandra/Proyecto/css/GestionVentas.css">

    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 0 auto;
            /* Centra el contenedor */
        }

        th,
        td {
            border: 2px solid black;
            padding: 3px;
            text-align: center;
        }

        th {
            background-color: #9AFFFC;
        }

        tr:nth-child(even) {
            background-color: white;
        }

        tr:hover {
            background-color: #FDF7F4;
        }

        .detalles-envio {
            text-align: left;
            /* Alinea el contenido a la izquierda */
        }
    </style>
</head>

<body>
    <header>
        <img src="/PaginaSandra/Proyecto/images/image1.jpeg" alt="Logo" class="encima-image">
        <h1 class="nombre-logo"> Gestion de Ventas</h1>
    </header>
    <a class="boton" href="LaConcepcion.php"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
        </svg></a>
    <h1>Lista de Pedidos</h1>
    <table id="tablaPedidos">
        <tr>
            <th>ID Pedido</th>
            <th>Fecha</th>
            <th>Elementos</th>
            <th>Detalles de Envío</th>
            <th>Precio Total</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($pedidos as $pedido) : ?>
            <tr>
                <td><?php echo $pedido['id']; ?></td>
                <td><?php echo "Fecha y hora de pedido: <br>" . date('d-m-Y / H:i:s', strtotime($pedido['fecha'])) . " hrs"; ?></td>
                <td>
                    <?php foreach ($pedido['elementos'] as $elemento) : ?>
                        <?php echo "{$elemento['nombre_item']} - Cantidad: " . number_format($elemento['cantidad'], 2) . " Kg/Pza - Precio: $ " . number_format($elemento['precio'], 2); ?><br>
                    <?php endforeach; ?>

                </td>
                <td class="detalles-envio">
                    <?php echo "Nombre: {$pedido['detalles_envio']['nombre']} {$pedido['detalles_envio']['apellido']}<br>";
                    echo "Teléfono: {$pedido['detalles_envio']['telefono']}<br>";
                    echo "Calle: {$pedido['detalles_envio']['calle']}<br>";
                    echo "No. interior: {$pedido['detalles_envio']['no_calle_interior']}<br>";
                    echo "No. Exterior: {$pedido['detalles_envio']['no_calle_exterior']}<br>";
                    echo "Departamento: {$pedido['detalles_envio']['departamento']}<br>";
                    echo "Colonia: {$pedido['detalles_envio']['colonia']}<br>";
                    echo "C.P: {$pedido['detalles_envio']['cp']}<br>";
                    echo "Indicaciones: {$pedido['detalles_envio']['indicaciones']}<br>";
                    echo "Forma de Pago: {$pedido['detalles_envio']['forma_pago']}";
                    ?>

                </td>
                <td><?php echo "$" . number_format($pedido['precio_total'], 2); ?></td>
                <td>
                    <?php if ($tipo_usuario == 1) { ?>
                        <form method="GET" action="modificar.php">
                            <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
                            <button type="submit" class="Modificar">Modificar</button>
                        </form>
                        <form method="POST" action="eliminar.php">
                            <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
                            <button type="submit" class="Eliminar">Eliminar</button>
                        </form>
                    <?php } elseif ($tipo_usuario == 2) {
                        echo "No cuenta con privilegios";
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Agregar un elemento para mostrar la gráfica de total de pedidos    -->
    <center>
        <h2>Gráfica de Total de Pedidos</h2>
        <!-- <img src="http://127.0.0.1:5000/grafica1" alt="Gráfica de Total de Pedidos" style="max-width: 100%; height: auto;"> -->
        <br>
        <h2>Gráfica de Total de Ingresos</h2>
        <!-- <img src="http://127.0.0.1:5000/grafica2" alt="Gráfica de Total de Ingresos" style="max-width: 100%; height: auto;"> -->
        <br>
        <h2>Gráfica Ventas por Mes</h2>
        <img src="http://127.0.0.1:5000/grafica_ventas_mes" alt="Gráfica de Ventas por Mes" style="max-width: 100%; height: auto;">
    </center>



    <script>
        // Función para recargar la página después de 5 segundos
        //setTimeout(function() {
        //location.reload();
        //}, 60000); // 5000 milisegundos = 5 segundos
    </script>
</body>

</html>