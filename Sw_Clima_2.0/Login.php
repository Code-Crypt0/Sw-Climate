<?php
session_start();

if(isset($_SESSION['tbl_usuarios'])){
    header("location: Index_Admin.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="login_db.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        // Verificar si el parámetro 'logout' está presente en la URL
        const urlParams = new URLSearchParams(window.location.search);
        const logoutParam = urlParams.get('logout');

        // Mostrar la alerta si el parámetro 'logout' está presente
        if (logoutParam === '1') {
            alert("La sesión se ha cerrado exitosamente.");
        }
    });
    </script>
</body>
</html>
