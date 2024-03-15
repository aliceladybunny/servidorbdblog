<?php
session_start();

// Verificar si el usuario ha iniciado sesión y NO tiene el perfil de administrador
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['perfil']) || $_SESSION['perfil'] === 'admin') {
    // Si no ha iniciado sesión o tiene perfil de administrador, redirigir al login
    header("Location: login.php");
    exit();
}

// Si llega hasta aquí, el usuario ha iniciado sesión pero no tiene perfil de administrador
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <!-- Agrega aquí tus estilos CSS -->
    <link rel="stylesheet" href="user_styles.css">
</head>
<body>
    <h1>Bienvenido al Panel de Usuario</h1>
    <!-- Agrega aquí el contenido de tu panel de usuario -->
    <p>Aquí puedes ver tus entradas, actualizar tu perfil, etc.</p>
    <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
