<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario_id'])) {
    $usuario_id = $_POST['usuario_id'];
    $nick = $_POST['nick'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];

    // Actualizar datos en la tabla de usuarios
    $consulta = "UPDATE usuarios 
                 SET nick = '$nick', nombre = '$nombre', apellidos = '$apellidos', email = '$email' 
                 WHERE id = $usuario_id";

    if ($conexion->query($consulta) === TRUE) {
        echo "Usuario actualizado correctamente";
    } else {
        echo "Error al actualizar el usuario: " . $conexion->error;
    }

    // Cerrar la conexión al finalizar
    if ($conexion->ping()) {
        $conexion->close();
    }
} else {

}
?>
