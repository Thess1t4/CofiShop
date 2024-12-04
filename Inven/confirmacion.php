<?php
$producto_id = $_GET['producto_id'];
$cantidad_comprada = $_GET['cantidad'];
$total = $_GET['total'];

// Conectar a la base de datos
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

// Obtener información del producto
$sql = "SELECT * FROM producto WHERE id = $producto_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Mostrar detalles de la compra
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
</head>
<body>

<h1>Compra realizada con éxito</h1>
<p><strong>Producto:</strong> <?= $row['nombre'] ?></p>
<p><strong>Cantidad comprada:</strong> <?= $cantidad_comprada ?></p>
<p><strong>Total a pagar:</strong> $<?= number_format($total, 2) ?></p>

<p>Gracias por tu compra, ¡te esperamos pronto!</p>

</body>
</html>

<?php
$conn->close();
?>
