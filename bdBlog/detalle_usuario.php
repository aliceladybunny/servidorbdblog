<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $usuario_id = $_GET['id'];
    
    // Consultar el usuario
    $consulta = "SELECT * FROM usuarios WHERE id = $usuario_id";
    $resultado = $conexion->query($consulta);
    
    if ($resultado && $resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Detalle de Usuario</h2>
        <ul>
            <li><strong>ID:</strong> <?php echo $usuario['id']; ?></li>
            <li><strong>Nick:</strong> <?php echo $usuario['nick']; ?></li>
            <li><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></li>
            <li><strong>Apellidos:</strong> <?php echo $usuario['apellidos']; ?></li>
            <li><strong>Email:</strong> <?php echo $usuario['email']; ?></li>
            <!-- Puedes agregar más detalles aquí si lo deseas -->
        </ul>
    </div>
</body>
</html>
<?php
    } else {
        echo "No se encontró el usuario.";
    }
    $resultado->free();
    $conexion->close();
} else {
    echo "Acceso no permitido.";
}
?>
