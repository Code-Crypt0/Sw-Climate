<?php
// Conexión a la base de datos
include('Conexion_bd.php');

// Verificar si se solicitó exportar todos los datos (el parámetro export_all se puede omitir o pasar como 'true')
$export_all = isset($_GET['export_all']) && $_GET['export_all'] == 'true';

// Si se solicita exportar todo, no se agrega un límite en la consulta
$limit = $export_all ? "" : "LIMIT 5";  // Si no es exportar todo, se aplica un límite (modificar según necesidad)

// Consulta para obtener los registros (sin límite si se está exportando todo)
$query = "SELECT Temperatura, Humedad, Presion, Velocidad, Precipitacion, Pronostico, Fecha_Hora 
          FROM tbl_pronostico 
          ORDER BY Fecha_Hora DESC 
          $limit";

// Ejecutar la consulta
$result = mysqli_query($conexion, $query);

// Verificar si la consulta fue exitosa
if ($result) {
    // Crear un array para almacenar los resultados
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Si lo que necesitas es exportar a Excel, puedes generar el archivo aquí
    if ($export_all) {
        // Definir los encabezados para la exportación en Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Datos_pronostico.xls"');
        
        // Limpiar cualquier salida antes de los encabezados
        ob_clean();
        flush();

        // Crear la salida en formato Excel (tabla HTML)
        echo "<table border='1'>";
        echo "<tr><th>Temperatura (°C)</th><th>Humedad (%)</th><th>Presion (hPa)</th><th>Velocidad (m/s)</th><th>Precipitacion (mm)</th><th>Pronostico</th><th>Fecha/Hora</th></tr>";
        
        // Recorrer los resultados y agregar cada fila a la tabla
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>" . $row['Temperatura'] . "</td>";
            echo "<td>" . $row['Humedad'] . "</td>";
            echo "<td>" . $row['Presion'] . "</td>";
            echo "<td>" . $row['Velocidad'] . "</td>";
            echo "<td>" . $row['Precipitacion'] . "</td>";
            echo "<td>" . $row['Pronostico'] . "</td>";
            echo "<td>" . $row['Fecha_Hora'] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        exit(); // Detener la ejecución después de la exportación
    }

    // Devolver los datos como JSON (si necesitas como respuesta JSON)
    echo json_encode($data);

} else {
    echo json_encode(['error' => 'No se pudo obtener los datos']);
}

mysqli_close($conexion);
?>
