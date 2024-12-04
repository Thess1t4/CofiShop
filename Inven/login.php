<?php

session_start();

$host = 'localhost';
$usuario = 'root';  // Usuario de la base de datos
$password = '';     // Contraseña de la base de datos
$base_datos = 'inventario';

// Crear conexión
$conexion = new mysqli($host, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_POST['iniciar'])) {
    // Capturar los valores del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    
    
    // Consulta para verificar el usuario y la contraseña
    $sql = "SELECT * FROM ussers WHERE usuario = ? AND password = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($row = $resultado->fetch_assoc()) {
        // El usuario existe, ahora verificar la contraseña
        if ($password == $row['password']) {
            // Contraseña correcta, se inicia sesión
            $_SESSION['id'] = $row['id'];
            $_SESSION['usuario'] = $row['usuario'];
            header('Location: index2.php'); // Redirige al inicio
            exit(); // Asegúrate de que el script se detenga aquí
        }
    }
    // Si llegamos aquí, el usuario o la contraseña son incorrectos
    $_SESSION['error1'] = 'USUARIO O CONTRASEÑA INCORRECTOS';
    header('Location: login.php'); // Redirige a la página de login
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CofiShop - Inicio de Sesión</title>
    <style type="text/CSS">
        body { 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('LOGO.png') no-repeat;
        }

        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(5, 5, 5, 0.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 10px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box {
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(14, 13, 13, 0.2);
            border-radius: 40px;
            font-size: 16px;
        }

        .input-box input::placeholder {
            color: black;
        }

        .wrapper .btn {
            width: 100%;
            height: 45px;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="" method="POST">
            <h1> Bienvenido</h1>
                <div class="input-box">
                    <input type="text" name="usuario" placeholder="Usuario" required>
                </div>
                <div class="input-box">
                    <input type="password" name= "password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn" name="iniciar"> Iniciar </button>

                 <!-- Mostrar el mensaje de error si existe -->
            <?php
            if (isset($_SESSION['error1'])) {
                echo '<p class="error" align=center>' . $_SESSION['error1'] . '</p>';
                unset($_SESSION['error1']); // Elimina el mensaje después de mostrarlo
            } 
            ?>
                
        </form>
    </div>
</body>
</html>