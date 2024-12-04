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

// Obtener los datos de la compra
$producto_id = $_POST['producto_id'];
$cantidad_comprada = $_POST['cantidad_comprada'];

// Obtener información del producto
$sql = "SELECT * FROM producto WHERE id = $producto_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['cantidad'] >= $cantidad_comprada) {
    // Calcular el total de la compra
    $precio_total = $row['precio'] * $cantidad_comprada;

    // Restar la cantidad del inventario
    $nueva_cantidad = $row['cantidad'] - $cantidad_comprada;
    $update_sql = "UPDATE producto SET cantidad = $nueva_cantidad WHERE id = $producto_id";
    
    if ($conn->query($update_sql) === TRUE) {
        // Redirigir a la página de confirmación
        header("Location: confirmacion.php?producto_id=$producto_id&cantidad=$cantidad_comprada&total=$precio_total");
        exit;
    } else {
        echo "Error al procesar la compra. Intenta de nuevo.";
    }
} else {
    echo "No hay suficiente stock disponible para completar tu compra.";
}

$conn->close();
?>
