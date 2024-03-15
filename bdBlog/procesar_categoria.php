<?php
// Verificar si se han enviado datos mediante el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha recibido el nombre de la categoría
    if (isset($_POST['nombre_categoria']) && !empty($_POST['nombre_categoria'])) {
        // Obtener el nombre de la categoría desde el formulario
        $nombre_categoria = $_POST['nombre_categoria'];
        
        // Aquí puedes realizar cualquier validación adicional que necesites

        // Guardar la categoría en la base de datos o realizar cualquier otra operación necesaria
        // Por ejemplo, podrías insertarla en la tabla de categorías
        
        // Incluir el archivo de conexión a la base de datos
        include 'conexion.php';

        // Consulta para insertar la categoría en la base de datos
        $consulta = "INSERT INTO categorias (nombre_categoria) VALUES ('$nombre_categoria')";

        // Ejecutar la consulta
        if ($conexion->query($consulta) === TRUE) {
            echo "Categoría creada correctamente";
        } else {
            echo "Error al crear la categoría: " . $conexion->error;
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    } else {
        echo "El nombre de la categoría es requerido";
    }
} else {
    echo "Acceso no permitido";
}
?>
