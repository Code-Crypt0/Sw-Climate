<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="Css/Style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Librería para las gráficas -->
    <script>
        // Estado para rastrear la funcionalidad del botón
        let mostrandoDatos = false;
        let mostrandoGraficas = false;  // Bandera para controlar la visibilidad de las gráficas

        // Función para alternar entre mostrar y eliminar datos
        function toggleDatos() {
            const tableBody = document.getElementById('data-body');
            const boton = document.getElementById('mostrar-btn');
            const graficaContainer = document.getElementById('grafica-container');
            const botonDescargarGraficas = document.getElementById('descargar-graficas-btn');  // Referencia al botón de descarga de gráficas

            if (mostrandoDatos) {
                // Eliminar los datos de la tabla
                tableBody.innerHTML = '';
                boton.textContent = 'Mostrar Pronósticos';
                mostrandoDatos = false;
                // Eliminar las gráficas si ya están visibles
                if (mostrandoGraficas) {
                    graficaContainer.innerHTML = '';  // Eliminar la gráfica
                    mostrandoGraficas = false;
                    botonDescargarGraficas.style.display = 'none';  // Ocultar el botón de descarga de gráficas
                }
            } else {
                // Obtener y mostrar los datos
                fetch('Obtener_datos.php')  // Archivo PHP que consulta los últimos 5 registros
                    .then(response => response.json())
                    .then(data => {
                        tableBody.innerHTML = ''; // Limpiar tabla antes de agregar nuevos datos

                        data.forEach(row => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = ` 
                                <td>${row.Temperatura}</td>
                                <td>${row.Humedad}</td>
                                <td>${row.Presion}</td>
                                <td>${row.Velocidad}</td>
                                <td>${row.Precipitacion}</td>
                                <td>${row.Pronostico}</td>
                                <td>${row.Fecha_Hora}</td>
                            `;
                            tableBody.appendChild(tr);
                        });

                        boton.textContent = 'Eliminar Pronósticos';
                        mostrandoDatos = true;
                        // Mostrar las gráficas cuando se presiona el botón para mostrar los datos
                        mostrarGraficas(data);
                    })
                    .catch(error => console.error('Error al obtener los datos:', error));
            }
        }

        // Función para cargar y mostrar las gráficas
        function mostrarGraficas(data) {
            const graficaContainer = document.getElementById('grafica-container');

            if (mostrandoGraficas) {
                return;  // Si las gráficas ya están mostradas, no hacer nada
            }

            // Crear un contenedor para las gráficas
            const canvas = document.createElement('canvas');
            canvas.id = 'grafica';
            graficaContainer.appendChild(canvas);
            const ctx = canvas.getContext('2d');

            const temperaturas = data.map(row => row.Temperatura);
            const humedades = data.map(row => row.Humedad);
            const precipitaciones = data.map(row => row.Precipitacion);

            // Crear las gráficas con Chart.js
            new Chart(ctx, {
                type: 'line',  // Tipo de gráfico: línea
                data: {
                    labels: data.map(row => row.Fecha_Hora),  // Etiquetas con la fecha y hora
                    datasets: [
                        {
                            label: 'Temperatura (°C)',
                            data: temperaturas,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: false,
                            tension: 0.1
                        },
                        {
                            label: 'Humedad (%)',
                            data: humedades,
                            borderColor: 'rgba(153, 102, 255, 1)',
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            fill: false,
                            tension: 0.1
                        },
                        {
                            label: 'Precipitación (mm)',
                            data: precipitaciones,
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            fill: false,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });

            mostrandoGraficas = true;  // Las gráficas ahora están visibles
            // Mostrar el botón de descarga de gráficas
            document.getElementById('descargar-graficas-btn').style.display = 'inline-block';  // Mostrar el botón
        }

        // Función para descargar los datos en formato Excel con todos los datos
        function descargarDatos() {
            // Crear una URL con el parámetro export_all=true
            const url = 'Obtener_datos.php?export_all=true';

            // Redirigir al servidor para que genere el archivo Excel
            window.location.href = url;
        }

        // Función para descargar las gráficas como imagen
        function descargarGraficas() {
            const canvas = document.getElementById('grafica');
            if (!canvas) {
                alert("No hay gráficas para descargar.");
                return;
            }
            const url = canvas.toDataURL('image/png');  // Obtener imagen en formato PNG
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Grafica.png';  // Nombre del archivo de la imagen
            a.click();
        }
    </script>
</head>
<body>
    <!-- Menú de navegación superior -->
    <nav id="navbar">
        <ul>
            <li><a href="Logout.php">Cerrar Sesión</a></li> <!-- Opción para cerrar sesión -->
        </ul>
    </nav>

    <div class="container">
        <!-- Sección para datos meteorológicos -->
        <div id="form-container">
            <h1>Ingrese Datos Meteorológicos</h1>
            <form id="weather-form" action="ClimaBD_cliente.php" method="POST">
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

                <input type="submit" value="Guardar Pronóstico">
                <button type="button" id="mostrar-btn" onclick="toggleDatos()">Mostrar Pronósticos</button>
                <!-- Botón para descargar los datos -->
                <button type="button" id="descargar-btn" onclick="descargarDatos()">Descargar Datos</button>
            </form>
        </div>

        <!-- Sección para mostrar datos meteorológicos almacenados -->
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

            <!-- Sección para las gráficas -->
            <div id="grafica-container"></div>

            <!-- Botón para descargar las gráficas como imagen -->
            <button type="button" id="descargar-graficas-btn" style="display: none;" onclick="descargarGraficas()">Descargar Gráficas</button>
        </div>
    </div>
</body>
</html>
