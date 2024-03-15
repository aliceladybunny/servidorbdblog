<?php
include 'conexion.php';

// Función para eliminar un registro de log
function eliminarRegistro($id) {
    global $conexion;
    $consulta = "DELETE FROM logs WHERE id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Verificar si se ha enviado una solicitud de eliminación
if (isset($_POST['eliminar'])) {
    $idEliminar = $_POST['eliminar'];
    eliminarRegistro($idEliminar);
}

// Obtener los registros de la tabla logs
$consultaLogs = "SELECT * FROM logs ORDER BY fechaInicio DESC";
$resultadoLogs = $conexion->query($consultaLogs);

// Generar PDF con el contenido de los logs
// Aquí deberías agregar el código para generar el PDF utilizando la biblioteca FPDF

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Logs</title>
    <!-- Agrega enlaces a tus archivos CSS y JavaScript -->
</head>
<body>
    <h1>Gestión de Logs</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mensaje</th>
                <th>Usuario</th>
                <th>Tipo de Operación</th>
                <th>Fecha de Inicio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultadoLogs && $resultadoLogs->num_rows > 0) : ?>
                <?php while ($fila = $resultadoLogs->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['mensaje']; ?></td>
                        <td><?php echo $fila['usuario']; ?></td>
                        <td><?php echo $fila['tipo_operacion']; ?></td>
                        <td><?php echo $fila['fechaInicio']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="eliminar" value="<?php echo $fila['id']; ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">No hay registros de logs.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <form action="" method="post">
        <button type="submit" name="generar_pdf">Generar PDF</button>
    </form>

</body>
</html>
