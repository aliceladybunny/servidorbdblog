<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $usuario_id = $_GET['id'];
    
    // Consultar el usuario a editar
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
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Usuario</h2>
        <form action="procesar_editar_usuario.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
            
            <label for="nick">Nick:</label>
            <input type="text" id="nick" name="nick" value="<?php echo $usuario['nick']; ?>" required>
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
            
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $usuario['apellidos']; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
            
            <label for="imagen_avatar">Imagen de Avatar:</label>
            <input type="file" id="imagen_avatar" name="imagen_avatar" accept="image/*">
            
            <button type="submit">Guardar Cambios</button>
        </form>
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
