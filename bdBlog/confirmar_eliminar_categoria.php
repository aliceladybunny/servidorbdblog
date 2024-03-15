<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $categoria_id = $_GET['id'];
    
    // Consultar el nombre de la categoría
    $consulta_nombre = "SELECT nombre FROM categorias WHERE id = $categoria_id";
    $resultado_nombre = $conexion->query($consulta_nombre);
    
    if ($resultado_nombre && $resultado_nombre->num_rows > 0) {
        $categoria = $resultado_nombre->fetch_assoc();
        $nombre_categoria = $categoria['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminar Categoría</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Confirmar Eliminar Categoría</h2>
        <p>¿Estás seguro de que deseas eliminar la categoría "<?php echo $nombre_categoria; ?>"?</p>
        <form action="eliminar_categoria.php" method="post">
            <input type="hidden" name="categoria_id" value="<?php echo $categoria_id; ?>">
            <button type="submit">Sí, eliminar</button>
            <a href="listado_categorias.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
<?php
        // Liberar el resultado de la consulta del nombre de la categoría
        $resultado_nombre->free();
    } else {
        echo "No se encontró la categoría a eliminar.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
