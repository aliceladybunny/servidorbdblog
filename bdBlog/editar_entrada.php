<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $entrada_id = $_GET['id'];
    
    // Consultar la entrada a editar
    $consulta = "SELECT * FROM entradas WHERE id = $entrada_id";
    $resultado = $conexion->query($consulta);
    
    if ($resultado && $resultado->num_rows > 0) {
        $entrada = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entrada</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Entrada</h2>
        <form action="procesar_editar_entrada.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="entrada_id" value="<?php echo $entrada['id']; ?>">
            
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $entrada['titulo']; ?>" required>
            
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $entrada['descripcion']; ?></textarea>
            
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">
            
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        echo "No se encontró la entrada.";
    }
    $resultado->free();
    $conexion->close();
} else {
    // Redirigir si no se proporciona un ID de entrada
    header("Location: entradas.html");
}
?>
