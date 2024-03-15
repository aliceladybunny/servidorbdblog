<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['entrada_id'])) {
    $entrada_id = $_POST['entrada_id'];
    
    // Eliminar la entrada
    $consulta = "DELETE FROM entradas WHERE id = $entrada_id";

    if ($conexion->query($consulta) === TRUE) {
        echo "Entrada eliminada correctamente";
    } else {
        echo "Error al eliminar la entrada: " . $conexion->error;
    }

    // Cerrar la conexión al finalizar
    if ($conexion->ping()) {
        $conexion->close();
    }
} else {
    // Redirigir si no se envía correctamente el ID de la entrada
    header("Location: listado_entradas.php");
}
?>
