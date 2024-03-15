<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $entrada_id = $_GET['id'];
    
    // Consultar la entrada
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
    <title>Detalle de Entrada</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Detalle de Entrada</h2>
        <p><strong>Título:</strong> <?php echo $entrada['titulo']; ?></p>
        <p><strong>Descripción:</strong> <?php echo $entrada['descripcion']; ?></p>
        <img src="<?php echo $entrada['imagen']; ?>" alt="Imagen de la entrada">
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
