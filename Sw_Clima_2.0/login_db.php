<?php
session_start(); // Iniciar la sesión

include('Conexion_bd.php'); // Conexión a la base de datos

// Verificar si los campos de correo y contraseña están vacíos
if (empty($_POST['usuario']) || empty($_POST['contraseña'])) {
    echo '
    <script>
    alert("Por favor, complete todos los campos para iniciar sesión.");
    window.location = "Login.php"; // Redirige al formulario de login
    </script>
    ';
    exit;
}

// Limitar el correo a 50 caracteres
$correo = substr($_POST['usuario'], 0, 50);
$contraseña = $_POST['contraseña']; // Obtener la contraseña desde el formulario

// Verificar si el usuario existe en la base de datos
$validar_correo = mysqli_query($conexion, "SELECT * FROM tbl_usuarios WHERE Nombre_usuario='$correo'");
if (mysqli_num_rows($validar_correo) > 0) {
    
    // Obtener los detalles del usuario
    $usuario = mysqli_fetch_assoc($validar_correo);

    // Obtener la contraseña almacenada en la base de datos
    $contraseña_guardada = $usuario['Contraseña'];

    // Verificar si la contraseña almacenada es un hash (usando password_get_info)
    if (password_get_info($contraseña_guardada)['algo']) {
        // Si la contraseña almacenada es un hash, usar password_verify()
        if (password_verify($contraseña, $contraseña_guardada)) {
            $tipo_usuario = $usuario['Tipo_usuario']; // Obtener el tipo de usuario (ej. Admin, Cliente)

            // Establecer variables de sesión
            $_SESSION['Nombre'] = $correo; // Nombre de usuario (correo)
            $_SESSION['TipoUsuario'] = $tipo_usuario; // Tipo de usuario

            // Redirigir según el tipo de usuario
            if ($tipo_usuario == 'Admin') {
                echo '
                <script>
                alert("Inicio de sesión exitoso como Admin.");
                window.location = "Index_Admin.php"; // Redirigir al panel de administración
                </script>
                ';
            } elseif ($tipo_usuario == 'Cliente') {
                echo '
                <script>
                alert("Inicio de sesión exitoso como Cliente.");
                window.location = "Index_Cliente.php"; // Redirigir a la página cliente
                </script>
                ';
            } else {
                echo '
                <script>
                alert("Tipo de usuario desconocido.");
                window.location = "Login.php"; // Redirigir al formulario de login
                </script>
                ';
            }
            exit;
        } else {
            // Si la contraseña no coincide con el hash
            echo '
            <script>
            alert("La contraseña no coincide con el usuario proporcionado.");
            window.location = "Login.php"; // Redirige al formulario de login
            </script>
            ';
            exit;
        }
    } else {
        // Si la contraseña no está en hash (es texto claro), compararla directamente
        if ($contraseña == $contraseña_guardada) {
            // Si la contraseña coincide con la almacenada, hacer el hash y actualizarla en la base de datos
            $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la base de datos a hash
            $actualizar_contraseña = mysqli_query($conexion, "UPDATE tbl_usuarios SET Contraseña='$contraseña_hash' WHERE Nombre_usuario='$correo'");

            if ($actualizar_contraseña) {
                $tipo_usuario = $usuario['Tipo_usuario']; // Obtener el tipo de usuario (ej. Admin, Cliente)

                // Establecer variables de sesión
                $_SESSION['Nombre'] = $correo; // Nombre de usuario (correo)
                $_SESSION['TipoUsuario'] = $tipo_usuario; // Tipo de usuario

                // Redirigir según el tipo de usuario
                if ($tipo_usuario == 'Admin') {
                    echo '
                    <script>
                    alert("Inicio de sesión exitoso como admin. La contraseña se ha actualizado.");
                    window.location = "Index_Admin.php"; // Redirigir al panel de administración
                    </script>
                    ';
                } elseif ($tipo_usuario == 'Cliente') {
                    echo '
                    <script>
                    alert("Inicio de sesión exitoso como cliente. La contraseña se ha actualizado.");
                    window.location = "Index_Cliente.php"; // Redirigir a la página cliente
                    </script>
                    ';
                } else {
                    echo '
                    <script>
                    alert("Tipo de usuario desconocido.");
                    window.location = "Login.php"; // Redirigir al formulario de login
                    </script>
                    ';
                }
                exit;
            } else {
                echo '
                <script>
                alert("Error al actualizar la contraseña.");
                window.location = "Login.php"; // Redirige al formulario de login
                </script>
                ';
                exit;
            }
        } else {
            // Si la contraseña no coincide
            echo '
            <script>
            alert("La contraseña no coincide con el usuario proporcionado.");
            window.location = "Login.php"; // Redirige al formulario de login
            </script>
            ';
            exit;
        }
    }
} else {
    // Si el correo no existe en la base de datos
    echo '
    <script>
    alert("El usuario proporcionado no existe.");
    window.location = "Login.php"; // Redirige al formulario de login
    </script>
    ';
    exit;
}
?>
