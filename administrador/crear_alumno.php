<?php
// Asegúrate de incluir tus clases y configurar la conexión a la base de datos aquí

include('../includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreAlumno = $_POST['nombre_alumno'];
    $emailAlumno = $_POST['email_alumno'];

    $sql = "INSERT INTO alumnos (nombre, email) VALUES ('$nombreAlumno', '$emailAlumno')";
    
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
    <title>Crear Alumno</title>
    <!-- Agrega tus enlaces a Tailwind CSS aquí -->
</head>
<body>
    <h1>Crear Alumno</h1>
    <form action="crear_alumno.php" method="post">
        <label for="nombre_alumno">Nombre del Alumno:</label>
        <input type="text" id="nombre_alumno" name="nombre_alumno" required>
        <label for="email_alumno">Email del Alumno:</label>
        <input type="email" id="email_alumno" name="email_alumno" required>
        <button type="submit">Crear Alumno</button>
    </form>
</body>
</html>
