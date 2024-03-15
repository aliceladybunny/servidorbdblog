<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $categoria_id = $_GET['id'];
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
        <p>¿Estás seguro de que quieres eliminar esta categoría?</p>
        <form action="confirmar_eliminar_categoria.php" method="post">
            <input type="hidden" name="categoria_id" value="<?php echo $categoria_id; ?>">
            <button type="submit">Eliminar</button>
            <a href="categorias.html">Cancelar</a>
        </form>
    </div>
</body>
</html>
<?php
} else {
    // Redirigir si no se proporciona un ID de categoría
    header("Location: categorias.html");
}
?>
