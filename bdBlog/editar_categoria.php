<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $categoria_id = $_GET['id'];
    
    // Consultar la categoría a editar
    $consulta = "SELECT * FROM categorias WHERE id = $categoria_id";
    $resultado = $conexion->query($consulta);
    
    if ($resultado && $resultado->num_rows > 0) {
        $categoria = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Categoría</h2>
        <form action="procesar_editar_categoria.php" method="post">
            <input type="hidden" name="categoria_id" value="<?php echo $categoria['id']; ?>">
            
            <label for="nombre_categoria">Nombre de Categoría:</label>
            <input type="text" id="nombre_categoria" name="nombre_categoria" value="<?php echo $categoria['nombre_categoria']; ?>" required>
            
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        echo "No se encontró la categoría.";
    }
    $resultado->free();
    $conexion->close();
} else {
    echo "Acceso no permitido";
}
?>
