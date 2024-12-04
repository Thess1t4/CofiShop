<?php
session_start(); // Iniciar sesión

// Destruir la sesión y eliminar todos los datos guardados
session_unset();
session_destroy();

// Redirigir al usuario al login
header("Location: index.php");
exit();
?>
