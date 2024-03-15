<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consultar el usuario en la base de datos
    $consulta = "SELECT id, perfil, password FROM usuarios WHERE email = '$email'";
    $resultado = $conexion->query($consulta);

    if ($resultado && $resultado->num_rows > 0) {
        $usuarioData = $resultado->fetch_assoc();
        if (password_verify($password, $usuarioData['password'])) {
            // Iniciar sesión y almacenar el ID de usuario y el perfil
            $_SESSION['usuario_id'] = $usuarioData['id'];
            $_SESSION['perfil'] = $usuarioData['perfil'];

            // Redireccionar según el perfil del usuario
            if ($_SESSION['perfil'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
} else {
    echo "Acceso no permitido";
}

$conexion->close();
?>
