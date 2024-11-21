<?php
session_start(); // Iniciar la sesión

include('Conexion_bd.php'); // Incluir la conexión a la base de datos

// Verificar si los campos están vacíos
if (empty($_POST['nombre']) || empty($_POST['apellido_paterno']) || empty($_POST['apellido_materno']) || empty($_POST['tipo_usuario']) || empty($_POST['contraseña'])) {
    echo '
    <script>
    alert("Por favor, complete todos los campos.");
    window.location = "Registro_usuario.php"; // Redirigir al formulario de registro
    </script>
    ';
    exit;
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$tipo_usuario = $_POST['tipo_usuario'];
$contraseña = $_POST['contraseña']; // Aquí obtenemos la contraseña

// Validar que la contraseña tenga al menos una letra, un número y un máximo de 8 caracteres
if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{1,8}$/", $contraseña)) {
    echo '
    <script>
    alert("La contraseña debe ser alfanumérica (contener al menos una letra y un número) y tener un máximo de 8 caracteres, no se aceptan espacios.");
    window.location = "Registro_usuario.php"; // Redirigir al formulario de registro
    </script>
    ';
    exit;
}

// Generar el Nombre_usuario en mayúsculas
$nombre_usuario = strtoupper(substr($apellido_paterno, 0, 1) . substr($apellido_materno, 0, 1) . substr($nombre, 0, 1));

// Si el nombre tiene dos partes (dos nombres), generar el Nombre_usuario con las primeras letras de ambos nombres
if (strpos($nombre, " ") !== false) {
    $nombres = explode(" ", $nombre);
    $nombre_usuario = strtoupper(substr($apellido_paterno, 0, 1) . substr($apellido_materno, 0, 1) . substr($nombres[0], 0, 1) . substr($nombres[1], 0, 1));
}

// Verificar si el nombre de usuario ya existe en la base de datos
$validar_usuario = mysqli_query($conexion, "SELECT * FROM tbl_usuarios WHERE Nombre_usuario='$nombre_usuario'");
if (mysqli_num_rows($validar_usuario) > 0) {
    echo '
    <script>
    alert("El nombre de usuario ya está registrado.");
    window.location = "Registro_usuario.php"; // Redirigir al formulario de registro
    </script>
    ';
    exit;
}

// Generar el hash de la contraseña usando bcrypt
$contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

// Insertar en la base de datos
$sql = "INSERT INTO tbl_usuarios (Nombre, App, Apm, Nombre_usuario, Contraseña, Tipo_usuario)
        VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$nombre_usuario', '$contraseña_hash', '$tipo_usuario')";

if (mysqli_query($conexion, $sql)) {
    // Si el registro es exitoso, redirigir a la página de login
    echo '
    <script>
    alert("Registro exitoso. Ahora puedes iniciar sesión.");
    window.location = "Registro_usuario.php"; // Redirigir al formulario de login
    </script>
    ';
} else {
    echo '
    <script>
    alert("Error al registrar el usuario. Intenta nuevamente.");
    window.location = "Registro_usuario.php"; // Redirigir al formulario de registro
    </script>
    ';
}

mysqli_close($conexion); // Cerrar la conexión a la base de datos
?>
