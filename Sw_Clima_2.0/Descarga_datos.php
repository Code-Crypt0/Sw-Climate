<?php
// Conectar a la base de datos
include('Conexion_bd.php');

// Consulta SQL para obtener los últimos 25 registros
$sql = "SELECT Temperatura, Humedad, Presion, Velocidad, Precipitacion, Fecha_Hora 
        FROM tbl_pronosticos 
        ORDER BY Fecha_Hora DESC 
        LIMIT 25";
$result = $conn->query($sql);

// Validación para comprobar que existen datos
if ($result->num_rows > 0) {
    // Crear un array para almacenar los datos
    $data = array();
    
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Agregar los registros al array
    }
    
    // Convertir el array a formato JSON
    echo json_encode($data);
} else {
    // Retornar un mensaje JSON si no hay datos
    echo json_encode(array("message" => "No hay datos disponibles"));
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
