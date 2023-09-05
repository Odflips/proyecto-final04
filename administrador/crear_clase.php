<?php
include('../includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreClase = $_POST['nombre_clase'];
    $maestroAsignado = $_POST['maestro_asignado'];

    $sql = "INSERT INTO clases (nombre, maestro_id) VALUES ('$nombreClase', '$maestroAsignado')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../confirmacion.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

include('../includes/header.php');
?>

<h1>Crear Clase/Materia/Curso</h1>
<form action="crear_clase.php" method="post">
    <label for="nombre_clase">Nombre de la Clase:</label>
    <input type="text" id="nombre_clase" name="nombre_clase" required>
    <label for="maestro_asignado">Maestro Asignado:</label>
    <!-- Aquí puedes incluir un select para elegir un maestro -->
    <button type="submit">Crear Clase</button>
</form>

<?php
include('../includes/footer.php');
?>
