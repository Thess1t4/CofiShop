<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // tu usuario de base de datos
$password = ""; // tu contraseña de base de datos
$dbname = "inventario"; // nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del producto a eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Eliminar el producto de la base de datos
    $sql = "DELETE FROM producto WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Producto eliminado exitosamente.');
                window.location.href='Inven.php';
              </script>";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
