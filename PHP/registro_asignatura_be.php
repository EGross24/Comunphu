<?php
// Incluir conexión a la base de datos
include 'conexion_be.php';

// Obtener datos del formulario
$codigo_asignatura = $_POST['codigo'];
$nombre_asignatura = $_POST['nombre_asignatura'];
$id_departamento = !empty($_POST['departamento']) ? $_POST['departamento'] : NULL; // Permitir nulo
$id_carrera = !empty($_POST['carrera']) ? $_POST['carrera'] : NULL; // Permitir nulo

// Validar que los campos obligatorios no estén vacíos
if (empty($codigo_asignatura) || empty($nombre_asignatura)) {
    echo '
    <script>
        alert("Por favor, complete los campos obligatorios.");
        window.location = "../asignaturasAdmin.php"; 
    </script>';
    exit();
}

// Verificar si el código de la asignatura ya existe
$verificar_codigo = mysqli_query($conexion, "SELECT * FROM asignaturas WHERE codigo_asignatura = '$codigo_asignatura'");

if (mysqli_num_rows($verificar_codigo) > 0) {
    echo '
    <script>
        alert("El código de la asignatura ya está registrado.");
        window.location = "../asignaturasAdmin.php";
    </script>';
    exit();
}

// Insertar la asignatura en la tabla `asignaturas`
$query = "INSERT INTO asignaturas (nombre_asignatura, codigo_asignatura, id_depto_esc, id_carrera)
          VALUES ('$nombre_asignatura', '$codigo_asignatura', 
          ".($id_departamento ? "'$id_departamento'" : "NULL").", 
          ".($id_carrera ? "'$id_carrera'" : "NULL").")";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
    <script>
        alert("¡Asignatura almacenada exitosamente!");
        window.location = "../asignaturasAdmin.php";
    </script>';
} else {
    echo '
    <script>
        alert("Error al guardar la asignatura. Inténtelo nuevamente.");
        window.location = "../asignaturasAdmin.php";
    </script>';
}

// Cerrar la conexión
mysqli_close($conexion);
?>
