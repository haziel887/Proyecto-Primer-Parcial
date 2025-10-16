<?php
// Conexión a MySQL (cambia si tu variable es diferente)
$conexion = new mysqli("localhost", "root", "", "cursos_programacion");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';

function mostrar_tabla($resultado, $columnas) {
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        foreach ($columnas as $col) echo "<th>$col</th>";
        echo "</tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            foreach ($columnas as $col) echo "<td>{$fila[$col]}</td>";
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "No hay registros.<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="container">
    <a href="index.php" class="boton">← Volver</a>

<?php
switch ($opcion) {
    case 'Todos':
        echo "<h2>Todos los registros</h2>";
        $res = $conexion->query("SELECT * FROM cursos_computacion");
        mostrar_tabla($res, ['id_inscripcion','alumno','curso','nivel','turno','costo','fecha_inscripcion','profesor']);
        break;
    case 'Matutino':
        echo "<h2>Registros del turno Matutino</h2>";
        $res = $conexion->query("SELECT * FROM cursos_computacion WHERE turno='Matutino'");
        mostrar_tabla($res, ['alumno','curso','nivel','turno']);
        break;
    case 'Despues_julio':
        echo "<h2>Registros después del 12 de julio de 2024</h2>";
        $res = $conexion->query("SELECT * FROM cursos_computacion WHERE fecha_inscripcion>'2024-07-12'");
        mostrar_tabla($res, ['alumno','curso','fecha_inscripcion']);
        break;
    case 'Cursos':
        echo "<h2>Todos los cursos disponibles</h2>";
        $res = $conexion->query("SELECT DISTINCT curso FROM cursos_computacion ORDER BY curso");
        mostrar_tabla($res, ['curso']);
        break;
    default:
        echo "<p>Seleccione una opción para mostrar los registros.</p>";
        break;
}
$conexion->close();
?>
</div>
</body>
</html>
