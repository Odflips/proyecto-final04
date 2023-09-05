<?php
    if ($resultado->num_rows == 1) {
        // Autenticación exitosa
        $fila = $resultado->fetch_assoc();
        $hash_almacenado = $fila['contrasena'];

        // Verificar la contraseña utilizando password_verify()
        if (password_verify($contrasena, $hash_almacenado)) {
            $_SESSION['usuario_id'] = $fila['id'];
            $_SESSION['rol'] = $fila['rol'];
            var_dump($hash_almacenado);

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
    ?>