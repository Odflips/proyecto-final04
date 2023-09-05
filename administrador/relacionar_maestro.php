<?php
include('../includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maestro = $_POST['maestro'];
    $clase = $_POST['clase'];

    $sql = "INSERT INTO clases_maestros (maestro_id, clase_id) VALUES ('$maestro', '$clase')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: confirmacion.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

include('../includes/header.php');
?>

<h1>Relacionar Maestro a Clase</h1>
<form action="relacionar_maestro.php" method="post">
    <label for="maestro">Maestro:</label>
    <!-- Aquí puedes incluir un select para elegir un maestro -->
    <label for="clase">Clase:</label>
    <!-- Aquí puedes incluir un select para elegir una clase -->
    <button type="submit">Relacionar Maestro a Clase</button>
</form>

<?php
include('../includes/footer.php');
?>
