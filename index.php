<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad</title>
    
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<h1>Iniciar Sesión</h1>
<div class="bg-blue-200 min-h-screen flex items-center justify-center">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="index.php" method="post">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="usuario">Usuario:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="usuario" name="usuario" type="text" placeholder="Usuario" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="contrasena">Contraseña:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="contrasena" name="contrasena" type="password" placeholder="Contraseña" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Iniciar Sesión</button>
        </div>
    </form>
    <div>
        <a href="administrador/registro_administrador.php" class="text-blue-500 hover:text-blue-700">Registrarse como Administrador</a>
    </div>
</div>


</body>

</html>



<?php
include('includes/conexion.php');
session_start(); // Iniciar la sesión si aún no está iniciada


if (isset($_SESSION['usuario_id'])) {
    // Si el usuario ya está autenticado, redirigir al panel de control correspondiente (administrador, maestro o alumno)
    if ($_SESSION['rol'] == 'administrador') {
        header("Location: administrador/dashboard_admin.php");
    } elseif ($_SESSION['rol'] == 'maestro') {
        header("Location: maestro/dashboard_maestro.php");
    } elseif ($_SESSION['rol'] == 'alumno') {
        header("Location: alumno/dashboard_alumno.php");
    }
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];


    // Establecer las credenciales de tu base de datos
    $db_host = 'localhost';
    $db_usuario = 'root';
    $db_contrasena = '';
    $db_base_datos = 'universidad';

    // Realizar la conexión a la base de datos
    $conexion = new mysqli($db_host, $db_usuario, $db_contrasena, $db_base_datos);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para obtener las credenciales almacenadas
    $sql = "SELECT id, usuario, contrasena, rol, email FROM usuarios WHERE usuario = '$usuario'";

    // Ejecutar la consulta
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        // Autenticación exitosa
        $fila = $resultado->fetch_assoc();
        $hash_almacenado = $fila['contrasena'];

        // Verificar la contraseña utilizando password_verify()
        if (password_verify($contrasena, $hash_almacenado)) {
            $_SESSION['usuario_id'] = $fila['id'];
            $_SESSION['rol'] = $fila['rol'];
            $_SESSION['usuario_email'] = $fila['email'];
          

            // Redirigir al panel de control correspondiente
            if ($_SESSION['rol'] == 'administrador') {
                header("Location: administrador/dashboard_admin.php");
            } elseif ($_SESSION['rol'] == 'maestro') {
                header("Location: maestro/dashboard_maestro.php");
            } elseif ($_SESSION['rol'] == 'alumno') {
                header("Location: alumno/dashboard_alumno.php");
            }
            exit();
        } else {
            // Contraseña incorrecta
            $error = "Credenciales incorrectas. Inténtalo nuevamente.";
        }
    } else {
        // Usuario no encontrado
        $error = "Credenciales incorrectas. Inténtalo nuevamente.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}

include('includes/header.php');
?>



<?php
if (!empty($error)) {
    echo "<p>$error</p>";
}
?>



<?php
include('includes/footer.php');
?>