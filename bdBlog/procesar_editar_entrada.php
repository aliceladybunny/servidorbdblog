<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se han enviado datos mediante el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['entrada_id'])) {
    $entrada_id = $_POST['entrada_id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    // Actualizar la entrada en la base de datos
    $consulta = "UPDATE entradas SET titulo = '$titulo', descripcion = '$descripcion' WHERE id = $entrada_id";

    if ($conexion->query($consulta) === TRUE) {
        echo "Entrada actualizada correctamente";
    } else {
        echo "Error al actualizar la entrada: " . $conexion->error;
    }
} else {
    echo "Acceso no permitido";
}

// Cerrar la conexión al finalizar
if (isset($conexion) && $conexion->ping()) {
    $conexion->close();
}
?>
