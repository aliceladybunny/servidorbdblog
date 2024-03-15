<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $categoria_id = $_GET['id'];
    
    // Consultar la categoría
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
    <title>Detalle de Categoría</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Detalle de Categoría</h2>
        <p>ID: <?php echo $categoria['id']; ?></p>
        <p>Nombre de Categoría: <?php echo $categoria['nombre_categoria']; ?></p>
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
