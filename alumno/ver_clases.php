<?php
include('../includes/conexion.php');

// Suponiendo que tienes una sesión iniciada para el alumno y conoces su ID
$alumnoId = $_SESSION['alumno_id'];

// Consulta SQL para obtener las clases registradas por el alumno
$sql = "SELECT clases.nombre FROM clases INNER JOIN alumnos ON clases.id = alumnos.clase_id WHERE alumnos.id = '$alumnoId'";

$resultado = $conexion->query($sql);

include('../includes/header.php');
?>

<h1>Clases Registradas</h1>
<ul>
    <?php
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<li>" . $fila['nombre'] . "</li>";
        }
    } else {
        echo "<p>No estás registrado en ninguna clase.</p>";
    }
    ?>
</ul>

<?php
include('../includes/footer.php');
?>
