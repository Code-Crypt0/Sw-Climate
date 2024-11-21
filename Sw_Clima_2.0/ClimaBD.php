<?php
// Inicia la conexión a la base de datos
include('Conexion_bd.php');

// Verifica si se han enviado datos a través del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera los datos del formulario
    $temperatura = $_POST['temperatura'] ?? null;
    $humedad = $_POST['humedad'] ?? null;
    $presion = $_POST['presion'] ?? null;
    $viento = $_POST['viento'] ?? null;
    $precipitacion = $_POST['precipitacion'] ?? null;

    // Inicializa el pronóstico
    $pronostico = '';
    $indiceCalor = null;

    // Valida que no falte ningún campo obligatorio
    if ($temperatura !== null && $humedad !== null && $presion !== null && $viento !== null && $precipitacion !== null) {
        // Cálculo del índice de calor (si la temperatura es mayor a 27 °C)
        if ($temperatura > 27) {
            $indiceCalor = -42.379 + 2.04901523 * $temperatura + 10.14333127 * $humedad
                - 0.22475541 * $temperatura * $humedad - 0.00122874 * pow($temperatura, 2)
                - 0.00085282 * pow($humedad, 2) + 0.00000199 * pow($temperatura, 2) * $humedad
                + 0.00000001 * $temperatura * pow($humedad, 2) - 0.00000001 * pow($temperatura, 2) * pow($humedad, 2);
            $indiceCalor = round($indiceCalor);
        }

        // Determinar el pronóstico en base a los datos ingresados
        if ($temperatura <= 0 && $precipitacion > 0) {
            $pronostico = "Se espera nieve.";
        } else if ($precipitacion > 0) {
            if ($humedad > 80) {
                $pronostico = "Se espera lluvia intensa.";
            } else if ($humedad > 60) {
                $pronostico = "Se espera lluvia moderada.";
            } else {
                $pronostico = "Se espera lluvia ligera.";
            }
        } else if ($humedad > 70) {
            if ($temperatura < 15) {
                $pronostico = "El día estará nublado y fresco.";
            } else {
                $pronostico = "El día estará nublado.";
            }
        } else if ($temperatura > 20 && $humedad <= 60 && $viento < 5) {
            $pronostico = "El día estará soleado y cálido.";
        } else if ($presion < 1013) {
            $pronostico .= " La presión atmosférica está baja, lo que puede indicar mal tiempo.";
        } else if ($presion > 1020) {
            $pronostico .= " La presión atmosférica está alta, lo que sugiere un clima estable.";
        } else {
            $pronostico = "El día tendrá condiciones variables.";
        }

        // Captura la fecha y hora actual
        $fecha_hora = date('Y-m-d H:i:s');

        // Prepara la consulta para insertar los datos
        $sql = "INSERT INTO tbl_pronostico (Temperatura, Humedad, Presion, Velocidad, Precipitacion, Pronostico, Fecha_Hora)
                VALUES ('$temperatura', '$humedad', '$presion', '$viento', '$precipitacion', '$pronostico', '$fecha_hora')";

        // Ejecuta la consulta
        if (mysqli_query($conexion, $sql)) {
            echo '
            <script>
                alert("Datos meteorológicos guardados exitosamente.");
                window.location = "Index_Admin.php";
            </script>';
        } else {
            echo '
            <script>
                alert("Error al guardar los datos: ' . mysqli_error($conexion) . '");
                window.location = "Index_Admin.php";
            </script>';
        }
    } else {
        echo '
        <script>
            alert("Por favor, complete todos los campos.");
            window.location = "Index_Admin.php";
        </script>';
    }
}
?>
