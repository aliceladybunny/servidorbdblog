<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <!-- Enlaza tu archivo CSS específico -->
    <link rel="stylesheet" href="listado_css.css">

    <!-- Agrega jQuery (asegúrate de tener acceso a Internet para cargarlo desde CDN) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Agrega la librería DataTables para la funcionalidad de ordenar -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <style>
        /* Agrega estilos CSS para el icono de orden */
        .sortable-column {
            cursor: pointer;
        }

        .sortable-column::after {
            content: '\2195'; /* Flecha hacia arriba y hacia abajo */
            margin-left: 5px;
        }

        /* Estilos personalizados para la tabla */
        #entriesTable {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        #entriesTable th,
        #entriesTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #entriesTable th {
            background-color: #f2f2f2;
        }

        #entriesTable tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #entriesTable tbody tr:hover {
            background-color: #ddd;
        }

        .operations-column a {
            margin-right: 5px;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Inicializa DataTables
            var table = $('#entriesTable').DataTable();

            // Agrega clic en el encabezado para ordenar
            $('#entriesTable thead').on('click', '.sortable-column', function () {
                var column = table.column($(this).data('column-index'));
                column.order(column.order() === 'asc' ? 'desc' : 'asc').draw();
            });
        });
    </script>
</head>
<body>

    <h2>Listado de Usuarios</h2>

    <!-- Formulario de búsqueda por ID -->
    <form action="listado.php" method="get">
        <label for="buscar">Buscar por ID:</label>
        <input type="number" id="buscar" name="buscar" required>
        <button type="submit">Buscar</button>
    </form>

    <?php
    // Configuración de la paginación
    $resultadosPorPagina = 5; // Número de resultados por página

    // Obtener la página actual, si no se proporciona, por defecto es la primera página
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular el inicio del conjunto de resultados para la consulta
    $inicio = ($paginaActual - 1) * $resultadosPorPagina;

    // Construir la consulta SQL con criterios de búsqueda
    $consulta = "SELECT * FROM usuarios";

    if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
        $busqueda = $_GET['buscar'];
        $consulta .= " WHERE id = $busqueda";
    }

    $consulta .= " LIMIT $inicio, $resultadosPorPagina";

    $resultado = $conexion->query($consulta);

    // Verificar si hay resultados antes de intentar recuperar datos
    if ($resultado && $resultado->num_rows > 0) {
        // Agrega el encabezado de la tabla con clases "sortable-column"
        echo "<table id='entriesTable' class='display'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='sortable-column' data-column-index='0'>ID</th>";
        echo "<th class='sortable-column' data-column-index='1'>Nick</th>";
        echo "<th class='sortable-column' data-column-index='2'>Nombre</th>";
        echo "<th class='sortable-column' data-column-index='3'>Apellidos</th>";
        echo "<th class='sortable-column' data-column-index='4'>Email</th>";
        echo "<th>Operaciones</th>"; // Columna de operaciones
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['nick'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellidos'] . "</td>";
            echo "<td>" . $fila['email'] . "</td>";
            echo "<td class='operations-column'>";
            echo "<a href='editar_usuario.php?id=" . $fila['id'] . "'>Editar</a>";
            echo "<a href='confirmar_eliminar_usuario.php?id=" . $fila['id'] . "'>Eliminar</a>";
            echo "<a href='detalle_usuario.php?id=" . $fila['id'] . "'>Detalle</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        // Liberar el conjunto de resultados
        $resultado->free();

        // Calcular el número total de páginas
        $totalResultados = $conexion->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];
        $totalPaginas = ceil($totalResultados / $resultadosPorPagina);

        // Mostrar enlaces de paginación
        echo "<div class='pagination'>";
        for ($i = 1; $i <= $totalPaginas; $i++) {
            echo "<a href='listado.php?pagina=$i'>$i</a>";
        }
        echo "</div>";
    } else {
        echo "No hay usuarios que coincidan con la búsqueda.";
    }

    // Cerrar la conexión al finalizar
    $conexion->close();
    ?>

<form action="generar_pdf.php" method="post">
    <button type="submit">Generar PDF</button>
</form>

</body>
</html>