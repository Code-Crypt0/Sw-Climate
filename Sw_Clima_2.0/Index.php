<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pronóstico del Clima</title>
    <link rel="stylesheet" href="Css/Style.css">
</head>
<body>
    <div class="container">
        <div id="form-container">
            <h1>Ingrese Datos Meteorológicos</h1>
            <form id="weather-form" action="ClimaBD.php" method="POST">
                <label for="temperatura">Temperatura (°C):</label>
                <input type="number" id="temperatura" name="temperatura" required step="0.1"><br>

                <label for="humedad">Humedad Relativa (%):</label>
                <input type="number" id="humedad" name="humedad" required step="0.1" min="0" max="100"><br>

                <label for="presion">Presión Atmosférica (hPa):</label>
                <input type="number" id="presion" name="presion" required step="1" min="0"><br>

                <label for="viento">Velocidad del Viento (m/s):</label>
                <input type="number" id="viento" name="viento" step="0.1" min="0"><br>

                <label for="precipitacion">Precipitación Esperada (mm):</label>
                <input type="number" id="precipitacion" name="precipitacion" step="0.1" min="0"><br>

                <input type="submit" value="Obtener Pronóstico">
                <button type="button" id="eliminar-btn" disabled>Eliminar</button>
            </form>
        </div>

        <div id="data-table-container">
            <h2>Datos Almacenados</h2>
            <table id="data-table">
                <thead>
                    <tr>
                        <th>Temperatura (°C)</th>
                        <th>Humedad (%)</th>
                        <th>Presión (hPa)</th>
                        <th>Viento (m/s)</th>
                        <th>Precipitación (mm)</th>
                        <th>Pronóstico</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody id="data-body">
                </tbody>
            </table>

            <div id="gif-container"></div>
            <div id="resultado"></div>
        </div>
    </div>

    <script src="Js/scripts.js"></script>
</body>
</html>
