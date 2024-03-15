<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se han enviado datos mediante el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $usuario_id = $_POST['usuario_id'];
    $categoria_id = $_POST['categoria_id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion']; // Cambio en la captura de datos

    // Subir la imagen de entrada (opcional)
    $rutaImagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $rutaImagen = 'carpeta_imagenes/' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
    }

    // Insertar datos en la tabla de entradas
    $consulta = "INSERT INTO entradas (usuario_id, categoria_id, titulo, descripcion, imagen) 
                 VALUES ('$usuario_id', '$categoria_id', '$titulo', '$descripcion', '$rutaImagen')";

    if ($conexion->query($consulta) === TRUE) {
        echo "Entrada registrada correctamente";
    } else {
        echo "Error al registrar la entrada: " . $conexion->error;
    }
} else {
    echo "Acceso no permitido";
}

// Cerrar la conexión al finalizar
if (isset($conexion) && $conexion->ping()) {
    $conexion->close();
}
?>
