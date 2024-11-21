<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="Css/usuarios.css">
    <script>
        // Validación del formulario para la contraseña
        function validarFormulario() {
            const contraseña = document.getElementById("contraseña").value;

            // Expresión regular para validar que la contraseña sea alfanumérica y tenga un máximo de 8 caracteres
            // Debe tener al menos una letra y un número, y un máximo de 8 caracteres
            const regex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{1,8}$/;

            if (!regex.test(contraseña)) {
                alert("La contraseña debe ser alfanumérica (contener al menos una letra y un número) y tener un máximo de 8 caracteres, no se aceptan espacios.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <!-- Menú de navegación superior -->
    <nav id="navbar">
        <ul>
            <li><a href="Index_Admin.php">Datos Metereológicos</a></li>
            <li><a href="Registro_usuario.php">Registrar Usuario</a></li>
        </ul>
    </nav>

    <div class="container">
        <div id="form-container">
            <h1>Registrar Usuario</h1>
            <form action="Registros_bd.php" method="POST" id="registro-form" onsubmit="return validarFormulario()">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br>

                <label for="apellido-paterno">Apellido Paterno:</label>
                <input type="text" id="apellido-paterno" name="apellido_paterno" required><br>

                <label for="apellido-materno">Apellido Materno:</label>
                <input type="text" id="apellido-materno" name="apellido_materno" required><br>

                <label for="tipo-usuario">Tipo de Usuario:</label>
                <select id="tipo-usuario" name="tipo_usuario" required>
                    <option value="Admin">Admin</option>
                    <option value="Cliente">Cliente</option>
                </select><br>

                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required><br>
                <small>La contraseña debe ser alfanumérica (contener al menos una letra y un número) y tener un máximo de 8 caracteres, no se aceptan espacios.</small><br>

                <input type="submit" value="Registrar">
            </form>
        </div>
    </div>

    <script src=""></script>
</body>
</html>
