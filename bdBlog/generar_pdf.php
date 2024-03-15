<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Incluir la biblioteca FPDF (ajustando la ruta de acuerdo a la estructura de directorios)
require_once('fpdf/fpdf.php');

// Configuración de la paginación
$resultadosPorPagina = 5; // Número de resultados por página

// Obtener la página actual, si no se proporciona, por defecto es la primera página
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular el inicio del conjunto de resultados para la consulta
$inicio = ($paginaActual - 1) * $resultadosPorPagina;

// Realizar una consulta para obtener los registros con paginación
$consulta = "SELECT * FROM usuarios LIMIT $inicio, $resultadosPorPagina";
$resultado = $conexion->query($consulta);

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Verificar si hay resultados antes de intentar recuperar datos
if ($resultado && $resultado->num_rows > 0) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Listado de Usuarios', 0, 1);

    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(0, 10, "ID: " . $fila['id'] . ", Nick: " . $fila['nick'] . ", Nombre: " . $fila['nombre'] . ", Apellidos: " . $fila['apellidos'] . ", Email: " . $fila['email'], 0, 1);
    }

    // Calcular el número total de páginas
    $totalResultados = $conexion->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];
    $totalPaginas = ceil($totalResultados / $resultadosPorPagina);

    // Mostrar enlaces de paginación
    $paginationText = "Páginas: ";
    for ($i = 1; $i <= $totalPaginas; $i++) {
        $paginationText .= "$i ";
    }

    $pdf->Ln();
    $pdf->Cell(0, 10, $paginationText, 0, 1);
} else {
    $pdf->Cell(0, 10, "No hay usuarios registrados.", 0, 1);
}

// Cerrar la conexión al finalizar
$conexion->close();

// Salida del PDF (ajustando la ruta del archivo de salida según la estructura de directorios)
$pdf->Output('F', 'listado_usuarios.pdf', true);
?>
