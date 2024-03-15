<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $usuario_id = $_GET['id'];
    
    // Eliminar el usuario
    $consulta = "DELETE FROM usuarios WHERE id = $usuario_id";

    if ($conexion->query($consulta) === TRUE) {
        echo "Usuario eliminado correctamente";
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }

    // Cerrar la conexión al finalizar
    if ($conexion->ping()) {
        $conexion->close();
    }
} else {
    echo "Acceso no permitido.";
}
?>
