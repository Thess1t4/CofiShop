<?php
// Verifica si se ha pasado el parámetro 'id' en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conectar a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'inventario');
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Verificar si el formulario fue enviado para modificar el producto
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recuperar los datos del formulario
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $imagen = $_POST['imagen'];

        // Actualizar el producto en la base de datos
        $sql = "UPDATE producto SET nombre = '$nombre', precio = '$precio', cantidad = '$cantidad', imagen = '$imagen' WHERE id = $id";

        if ($conexion->query($sql) === TRUE) {
            $mensaje = "Producto actualizado correctamente.";
        } else {
            $mensaje = "Error al actualizar el producto: " . $conexion->error;
        }
    }

    // Consulta para obtener los datos del producto según el ID
    $sql = "SELECT * FROM producto WHERE id = $id";
    $resultado = $conexion->query($sql);

    // Verifica si el producto existe
    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
} else {
    echo "No se ha proporcionado un ID.";
    exit();
}
?>
?>

<html>
<head>
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
        <a href="#" class="logo"> CofiShop<span>.</span></a>

        <nav class="navbar">
            <a href="Inven.php">Inventario</a>
            <a href="cerrar.php">Cerrar</a>
        </nav>
    </header>

    <div class="wrapper">
       <?php if (isset($producto)) { ?>
        <form action="" method="POST">
            <h1>Modificar Producto</h1>

            <div class="input-box">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            </div>

            <div class="input-box">
                <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>">
            </div>

            <div class="input-box">
                <input type="number" id="precio" name="precio" value="<?php echo $producto['precio']; ?>">
            </div>

            <div class="input-box">
                <input type="number" id="cantidad" name="cantidad" value="<?php echo $producto['cantidad']; ?>">
            </div>

            <div class="input-box">
                <input type="file" id="imagen" name="imagen" value="<?php echo $producto['imagen']; ?>">
            </div>

            <button type="submit" class="btn">Modificar Producto</button>
        </form>
        <?php } else { ?>
        <p> Producto no encontrado. </p>
    <?php } ?>

    <?php if (isset($mensaje)) { ?>
        <p><?php echo $mensaje; ?></p>
    <?php } ?>

    </div>
</body>
</html>
 