<?php
// Incluir la conexión a la base de datos
include 'conexion_be.php';

// Obtener datos del formulario
$codigo_docente = $_POST['codigod'];
$nombre_completo = $_POST['nombre_completo'];
$correo_institucional = $_POST['correo_institucional'];
$id_facultad = $_POST['facultad'];
$asignaturas = isset($_POST['asignaturas']) ? $_POST['asignaturas'] : []; // Array de asignaturas

// Validar que los campos obligatorios no estén vacíos
if (empty($codigo_docente) || empty($nombre_completo) || empty($correo_institucional) || empty($id_facultad)) {
    echo '
    <script>
        alert("Por favor, complete todos los campos obligatorios.");
        window.location = "../añadirDocente.php";
    </script>';
    exit();
}

// Insertar el docente en la tabla `docentes`
$query_docente = "INSERT INTO docentes (codigo_docente, nombre_completo, correo_institucional, id_facultad)
                  VALUES ('$codigo_docente', '$nombre_completo', '$correo_institucional', '$id_facultad')";
$ejecutar_docente = mysqli_query($conexion, $query_docente);

if ($ejecutar_docente) {
    // Obtener el ID del docente insertado
    $id_docente = mysqli_insert_id($conexion);

    // Insertar las asignaturas seleccionadas en la tabla `docente_asignatura`
    foreach ($asignaturas as $id_asignatura) {
        $query_asignatura = "INSERT INTO docente_asignatura (id_docente, id_asignatura) VALUES ('$id_docente', '$id_asignatura')";
        mysqli_query($conexion, $query_asignatura);
    }

    echo '
    <script>
        alert("¡Docente almacenado exitosamente!");
        window.location = "../añadirDocente.php";
    </script>';
} else {
    echo '
    <script>
        alert("Error al guardar el docente. Inténtelo nuevamente.");
        window.location = "../añadirDocente.php";
    </script>';
}

// Cerrar la conexión
mysqli_close($conexion);
?>
