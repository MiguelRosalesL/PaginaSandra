<?php
    require_once "conexion.php";

    session_start();

    if ($_POST) {
        $usuario = $_POST['usuario'];
        $password = $_POST['contraseña'];

        $sql = "SELECT id, contraseña, nombre, tipo_usuario FROM usuarios WHERE usuario ='$usuario'";

        $resultado = $mysqli->query($sql);

        $num = $resultado->num_rows;

        if ($num>0) {
            $row = $resultado->fetch_assoc();
            $contraseña_bd = $row['contraseña'];

            $pass = sha1($password);

            if ($contraseña_bd == $pass) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['tipo_usuario'] = $row['tipo_usuario'];

                header("Location: LaConcepcion.php");
            }else{
                echo "La contrasela es incorrecta";
            }
            
        }else{
            echo "No existe el usuario";
        }

    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #45a049;
        }
        #errorMessage {
            color: red;
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form id="loginForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="usuario">Nombre de Usuario</label>
            <input type="text" id="usuario" name="usuario" required>
            <label for="contraseña">Contraseña</label>
            <input type="password" id="contraseña" name="contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
        <p id="errorMessage">Nombre de usuario o contraseña incorrectos.</p>
    </div>
    <!--
    <script>
        const users = {
            "usuario1": "contraseña1",
            "usuario2": "contraseña2"
        };

        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            if (users[username] && users[username] === password) {
                if (username === "usuario1") {
                    window.location.href = "usuario1.html"; // Redirigir a la página usuario1.html
                } else {
                    alert("Inicio de sesión exitoso");
                    // Aquí puedes redirigir a otra página para otros usuarios o realizar alguna acción adicional
                }
            } else {
                document.getElementById("errorMessage").style.display = "block";
            }
        });
    </script>
    -->
</body>
</html>