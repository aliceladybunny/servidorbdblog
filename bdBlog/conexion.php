<?php
global $conexion;

// Datos de conexión a la base de datos
$host = "127.0.0.1";
$usuario = "agonfer";
$contrasena = "agonfer";
$base_datos = "bdBlog";

// Intentar establecer la conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
     echo "Conexión exitosa";   // Comenté esta línea para que no imprima la conexión exitosa aquí
}
?>
