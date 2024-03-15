<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Definir la consulta SQL para llamar al procedimiento almacenado
$consulta = "CALL InsertarLog(?, ?, ?, ?)";

// Preparar la sentencia SQL
$stmt = $conexion->prepare($consulta);

// Vincular los parámetros
$mensaje = "Mensaje de ejemplo";
$usuario = "agonfer";
$tipo_operacion = "operacion1";
$fechaInicio = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual

$stmt->bind_param('ssss', $mensaje, $usuario, $tipo_operacion, $fechaInicio);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro insertado correctamente en los logs.";
} else {
    echo "Error al insertar el registro en los logs.";
}

// Cerrar la conexión al finalizar
$conexion->close();
?>
