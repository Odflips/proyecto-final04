<?php
// Asegúrate de incluir tus clases y configurar la conexión a la base de datos aquí

include('../includes/conexion.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreMaestro = $_POST['nombre_maestro'];
    $emailMaestro = $_POST['email_maestro'];

    $sql = "INSERT INTO maestros (nombre, email) VALUES ('$nombreMaestro', '$emailMaestro')";
    
    if ($conexion->query($sql) === TRUE) {
        header("Location: ../confirmacion.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

$conexion->close();

// Si no se envió un formulario POST o hubo un error, puedes mostrar el formulario de nuevo
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Maestro</title>
    <!-- Agrega tus enlaces a Tailwind CSS aquí -->
</head>
<body>
    <h1>Crear Maestro</h1>
    <form action="crear_maestro.php" method="post">
        <label for="nombre_maestro">Nombre del Maestro:</label>
        <input type="text" id="nombre_maestro" name="nombre_maestro" required>
        <label for="email_maestro">Email del Maestro:</label>
        <input type="email" id="email_maestro" name="email_maestro" required>
        <button type="submit">Crear Maestro</button>
    </form>
</body>
</html>


