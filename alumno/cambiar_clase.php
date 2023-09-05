<?php
include('../includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevaClase = $_POST['nueva_clase'];
    $alumnoId = $_SESSION['alumno_id']; // Suponiendo que tengas una sesión iniciada para el alumno

    $sql = "UPDATE alumnos SET clase_id = '$nuevaClase' WHERE id = '$alumnoId'";

    if ($conexion->query($sql) === TRUE) {
        header("Location: confirmacion.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

include('../includes/header.php');
?>

<h1>Cambiar Clase</h1>
<form action="cambiar_clase.php" method="post">
    <label for="nueva_clase">Nueva Clase:</label>
    <!-- Aquí puedes incluir un select para elegir una nueva clase -->
    <button type="submit">Cambiar Clase</button>
</form>

<?php
include('../includes/footer.php');
?>
