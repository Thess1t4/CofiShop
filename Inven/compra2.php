<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventario"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener productos desde la base de datos
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

// Cerrar la conexión (se puede dejar abierta para más acciones, si lo necesitas)
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .producto {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .producto img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .producto h3 {
            font-size: 18px;
        }
        .producto p {
            font-size: 16px;
        }
        .comprar-btn {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .comprar-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Bienvenido a la Tienda de Productos</h1>

<?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="producto">
            <img src="images/<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>">
            <h3><?= $row['nombre'] ?></h3>
            <p>Precio: $<?= number_format($row['precio'], 2) ?></p>
            <p>Stock: <?= $row['cantidad'] ?> unidades disponibles</p>
            
            <!-- Formulario para comprar -->
            <form action="procesar.php" method="POST">
                <input type="hidden" name="producto_id" value="<?= $row['id'] ?>">
                <input type="number" name="cantidad_comprada" min="1" max="<?= $row['cantidad'] ?>" required>
                <button class="comprar-btn" type="submit">Comprar</button>
            </form>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No hay productos disponibles en el inventario.</p>
<?php endif; ?>

</body>
</html>

