<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene el perfil de administrador
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    // Si no ha iniciado sesión o no tiene perfil de administrador, redirigir al login
    header("Location: login.php");
    exit();
}

// Si llega hasta aquí, el usuario ha iniciado sesión como administrador
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Agrega aquí tus estilos CSS -->
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
    <h1>Bienvenido al Panel de Administración</h1>
    <!-- Agrega aquí el contenido de tu panel de administración -->
    <p>Aquí puedes administrar los usuarios, entradas, categorías, etc.</p>
    <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
