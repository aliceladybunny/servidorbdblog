<?php
include 'conexion.php';

// Función para insertar un log utilizando el procedimiento almacenado
function insertarLog($usuario_id, $categoria_id, $titulo, $mensaje) {
    global $conexion;

    // Llamada al procedimiento almacenado
    $sql = "CALL InsertarLog($usuario_id, $categoria_id, '$titulo', '$mensaje')";
    $resultado = $conexion->query($sql);

    // Verificar si la llamada fue exitosa
    if ($resultado) {
        echo "Log insertado correctamente.";
    } else {
        echo "Error al insertar el log: " . $conexion->error;
    }
}

// Ejemplo de uso
$usuario_id = 1; // Reemplaza con el ID de usuario real
$categoria_id = 2; // Reemplaza con el ID de categoría real
$titulo = "Log de prueba";
$mensaje = "Este es un mensaje de log de prueba.";
insertarLog($usuario_id, $categoria_id, $titulo, $mensaje);

// Cerrar la conexión al finalizar
$conexion->close();
?>
