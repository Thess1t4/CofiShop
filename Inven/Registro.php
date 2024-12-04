<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "inventario"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario al enviar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    
    // Procesar la imagen
    $imagen = $_FILES["imagen"]["name"];
    $tempname = $_FILES["imagen"]["tmp_name"];
    $carpeta = "images/" . $imagen;

    // Subir la imagen al servidor
    if (move_uploaded_file($tempname, $carpeta)) {
        // Insertar el nuevo producto en la base de datos
        $sql = "INSERT INTO producto (nombre, precio, cantidad, imagen) VALUES ('$nombre', '$precio', '$cantidad', '$carpeta')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Producto \"$nombre\" agregado exitosamente');
                    setTimeout(function() {
                        window.location.href='Inven.php';
                    }, 2000);
                  </script>";
        } else {
            echo "Error al registrar el producto: " . $conn->error;
        }
    } else {
        echo "<script>alert('Error al subir la imagen.');</script>";
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
    <style>
        :root{
            --pink:#e84393;
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:Verdana, Geneva, Tahoma, sans-serif;
            outline: none;
            border: none;
            text-decoration: none;
            text-transform: capitalize;
            transition: .2s linear;
        }

        html{
            scroll-behavior: smooth;
            scroll-padding-top: 6rem;
            overflow-x: hidden;
        }

        section{
            padding: 2rem 9%;
        }

        header{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #fff;
            padding: 2rem 9%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            box-shadow: 0 .5rem 1rem rgb(0, 0, 0,.1);
        }

        header .logo{
            font-size: 3rem;
            color: #333;
            font-weight: bolder;
        }

        header .logo span{
            color: var(--pink);
        }

        header .navbar a{
            font-size: 2rem;
            padding: 0 1.5rem;
            color: #666;
        }

        header .navbar a:hover{
            color: var(--pink);
        }

        body { 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('LOGO.png') no-repeat;
            background-size: cover;
            padding-top: 100px;
        }

        .wrapper {
            width: 420px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(5, 5, 5, 0.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 10px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 28px;
            text-align: center;
            color: var(--pink);
            margin-bottom: 20px;
        }

        .wrapper .input-box {
            width: 100%;
            height: 50px;
            margin: 20px 0;
        }

        .input-box input, .input-box textarea {
            width: 100%;
            height: 100%;
            background: transparent;
            border: 2px solid rgba(14, 13, 13, 0.2);
            border-radius: 40px;
            font-size: 16px;
            padding: 0 15px;
        }

        .input-box input[type="file"] {
            padding: 5px 15px;
        }

        .input-box textarea {
            height: 100px;
            resize: none;
            padding-top: 10px;
        }

        .input-box input::placeholder, .input-box textarea::placeholder {
            color: black;
        }

        .btn {
            width: 100%;
            height: 45px;
            background: var(--pink);
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
        }

        .btn:hover {
            background-color: #c42e70;
        }
    </style>
</head>
<body>
    <header>
        <a href="#" class="logo">CofiShop<span>.</span></a>
        <nav class="navbar">
            <a href="Inven.php">Inventario</a>
            <a href="cerrar.php">Cerrar</a>
        </nav>
    </header>

    <div class="wrapper">
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>Registrar Producto</h1>

            <div class="input-box">
                <input type="text" name="nombre" placeholder="Nombre del Producto" required>
            </div>

            <div class="input-box">
                <input type="number" name="precio" placeholder="Precio" step="0.01" required>
            </div>

            <div class="input-box">
                <input type="number" name="cantidad" placeholder="Cantidad" required>
            </div>

            <div class="input-box">
                <input type="file" name="imagen" accept="image/*" required>
            </div>

            <button type="submit" class="btn">Registrar Producto</button>
        </form>
    </div>
</body>
</html>
