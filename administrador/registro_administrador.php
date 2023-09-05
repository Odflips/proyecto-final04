<?php
// Incluye el código de conexión a la base de datos
include('../includes/conexion.php');

// Inicializa las variables para almacenar los datos del formulario
$nombre = $email = $contrasena = '';
$nombre_error = $email_error = $contrasena_error = '';

// Procesa el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valida y sanitiza los datos ingresados por el usuario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Validación básica de nombre, email y contraseña (puedes agregar más validaciones)
    if (empty($nombre)) {
        $nombre_error = 'Por favor, ingresa un nombre.';
    }

    if (empty($email)) {
        $email_error = 'Por favor, ingresa un correo electrónico.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = 'Por favor, ingresa un correo electrónico válido.';
    }

    if (empty($contrasena)) {
        $contrasena_error = 'Por favor, ingresa una contraseña.';
    }

    // Si no hay errores de validación, procede a registrar al administrador
    if (empty($nombre_error) && empty($email_error) && empty($contrasena_error)) {
        // Genera un salt aleatorio
        $salt = random_bytes(16);

        // Combina la contraseña con el salt y luego hashea el resultado
        $contrasena_hashed = password_hash($contrasena . $salt, PASSWORD_BCRYPT);

        // Consulta SQL para insertar al administrador en la base de datos
        $sql = "INSERT INTO usuarios (usuario, contrasena, rol, salt, email) VALUES ('$nombre', '$contrasena_hashed', 'administrador', '$salt', '$email')";

        if ($conexion->query($sql) === TRUE) {
            // Redirige al administrador a una página de éxito o inicio de sesión
            header("Location: ../includes/registro_exitoso.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    }
}

// Incluye el archivo de encabezado común

?>

<h1>Registro de Administrador</h1>

<!-- Formulario de registro -->
<form action="registro_administrador" method="post">
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
        <span class="error"><?php echo $nombre_error; ?></span>
    </div>
    <div>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $email_error; ?></span>
    </div>
    <div>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena">
        <span class="error"><?php echo $contrasena_error; ?></span>
    </div>
    <div>
        <button type="submit">Registrarse</button>
    </div>
</form>


