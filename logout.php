<?php
session_start();
session_destroy(); // Destruye la sesión actual

// Redirigir a la página de inicio de sesión
header("Location: index.php");
exit();
?>
