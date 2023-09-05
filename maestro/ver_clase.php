<?php
include('../includes/conexion.php');

// Suponiendo que tienes una sesión iniciada para el maestro y conoces su ID
$maestroId = $_SESSION['maestro_id'];

// Consulta SQL para obtener la información de la clase asignada al maestro
$sql = "SELECT clases.nombre, clases.descripcion FROM clases INNER JOIN clases_maestros ON clases.id = clases_maestros.clase_id WHERE clases_maestros.maestro_id = '$maestroId'";

$resultado = $conexion->query($sql);

include('../includes/header.php');
?>

<h1>Información de la Clase</h1>

<?php
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<h2>Clase: " . $fila['nombre'] . "</h2>";
        echo "<p>Descripción: " . $fila['descripcion'] . "</p>";
    }
} else {
    echo "<p>No estás asignado a ninguna clase.</p>";
}

include('../includes/footer.php');
?>
