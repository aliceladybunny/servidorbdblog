<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se han enviado datos mediante el formulario
    if (isset($_POST['categoria_id']) && !empty($_POST['categoria_id'])) {
        // Recoger el ID de la categoría y los nuevos datos del formulario
        $categoria_id = $_POST['categoria_id'];
        $nuevo_nombre = $_POST['nombre_categoria'];

        // Actualizar los datos de la categoría en la base de datos
        $consulta = "UPDATE categorias SET nombre_categoria = '$nuevo_nombre' WHERE id = $categoria_id";

        if ($conexion->query($consulta) === TRUE) {
            echo "Categoría actualizada correctamente";
        } else {
            echo "Error al actualizar la categoría: " . $conexion->error;
        }
    } else {
        echo "ID de categoría no proporcionado";
    }
} else {
    // Redirigir si se intenta acceder al archivo directamente sin enviar datos mediante POST
    header("Location: categorias.html");
}

// Cerrar la conexión al finalizar
$conexion->close();
?>
