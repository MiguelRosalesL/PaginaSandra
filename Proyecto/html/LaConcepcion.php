<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}

$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];
?>
<html>

<head>
    <title>La Concepcion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    
    <link rel="stylesheet" href="/PaginaSandra/Proyecto/css/LaConcepcion.css">

</head>


<body>
   

<header>
<div class="container">
    <div class="d-flex justify-content-end">
      <div class="dropdown text-end" style="position: absolute; top:30;">
        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $nombre; ?>
          <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small" >
          <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
        </ul>
      </div>

  </div>
    <img src="/PaginaSandra/Proyecto/images/image1.jpeg" alt="Logo" class="encima-image">
    <h1 class="nombre-logo"> La Concepcion</h1>

</header>

    <h1>
        <center>Bienvenido</center>
    </h1>
    <h1>
        <center>Seleccione una opcion
    </h1>
    </center>

    

    <div class="menu-circular">


        <a href="GestionVentas.php" class="opcion1"> Gestion de ventas</a>  

    <?php
        if ($tipo_usuario==1) {
    ?>
        <a href="#" class="opcion2">Gestion de compras</a>
        <a href="#" class="opcion3">Gestion de clientes</a>
        <a href="#" class="opcion4">Gestion de contabilidad</a>
        <a href="#" class="opcion5">Gestion de inventario</a>
        <a href="#" class="opcion6">Gestion de produccion</a>
        <a href="#" class="opcion7">Gestion de calidad</a>
        <a href="#" class="opcion8">Marketing</a>
        <a href="#" class="opcion9">Gestion de finanzas</a>
    
    <?php
        }
    ?> 
    </div>
    
    <footer>
    </footer>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>