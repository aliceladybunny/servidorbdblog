<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminar Entrada</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Confirmar Eliminar Entrada</h2>
        <p>¿Está seguro de que desea eliminar esta entrada?</p>
        <form action="eliminar_entrada.php" method="post">
            <input type="hidden" name="entrada_id" value="<?php echo $_GET['id']; ?>">
            <button type="submit">Confirmar Eliminar</button>
            <a href="listado_entradas.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
