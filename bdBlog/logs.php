<?php
include 'conexion.php';

// Obtener los registros de la tabla logs ordenados por fecha descendente
$consultaLogs = "SELECT * FROM logs ORDER BY fechaInicio DESC";
$resultadoLogs = $conexion->query($consultaLogs);

// Mostrar los registros en una lista
if ($resultadoLogs && $resultadoLogs->num_rows > 0) {
    echo "<h2>Registros de Logs</h2>";
    echo "<ul>";

    while ($fila = $resultadoLogs->fetch_assoc()) {
        echo "<li>{$fila['mensaje']} - {$fila['fechaInicio']}</li>";
    }

    echo "</ul>";
} else {
    echo "No hay registros de logs.";
}

// Cerrar la conexión
$conexion->close();
?>
