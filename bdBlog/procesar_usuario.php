<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se han enviado datos mediante el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario y limpiarlos
    $nick = mysqli_real_escape_string($conexion, $_POST['nick']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña
    
    // Verificar si el campo 'perfil' está definido en $_POST antes de intentar acceder a él
    $perfil = isset($_POST['perfil']) ? mysqli_real_escape_string($conexion, $_POST['perfil']) : ''; 

    // Subir la imagen de avatar (opcional)
    $rutaImagen = '';
    if (isset($_FILES['imagen_avatar']) && $_FILES['imagen_avatar']['error'] === 0) {
        $tipoImagen = $_FILES['imagen_avatar']['type'];
        $tamanioImagen = $_FILES['imagen_avatar']['size'];
        $nombreImagen = $_FILES['imagen_avatar']['name'];

        // Verificar el tipo de imagen y el tamaño
        if (($tipoImagen === 'image/jpeg' || $tipoImagen === 'image/png') && $tamanioImagen <= 1048576) { // 1 MB
            $rutaImagen = 'images/' . $nombreImagen;
            move_uploaded_file($_FILES['imagen_avatar']['tmp_name'], $rutaImagen);
        } else {
            echo "Error: La imagen debe ser de tipo JPEG o PNG y no debe exceder 1 MB de tamaño.";
            exit();
        }
    }

    // Insertar datos en la tabla de usuarios
    $consulta = "INSERT INTO usuarios (nick, nombre, apellidos, email, password, perfil, imagen_avatar) 
                 VALUES ('$nick', '$nombre', '$apellidos', '$email', '$password', '$perfil', '$rutaImagen')";

    if ($conexion->query($consulta) === TRUE) {
        echo "Usuario registrado correctamente";
    } else {
        echo "Error al registrar el usuario: " . $conexion->error;
    }
} else {
    echo "Acceso no permitido";
}

// Cerrar la conexión al finalizar
if ($conexion->ping()) {
    $conexion->close();
}
?>
