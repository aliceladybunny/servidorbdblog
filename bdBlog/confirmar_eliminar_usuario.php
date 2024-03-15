<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminación de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Confirmar Eliminación de Usuario</h2>
        <p>¿Estás seguro de que quieres eliminar este usuario?</p>
        <form action="eliminar_usuario.php" method="get">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit">Sí, eliminar</button>
            <a href="listado_usuarios.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
