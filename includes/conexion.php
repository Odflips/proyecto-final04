<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'universidad';

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
