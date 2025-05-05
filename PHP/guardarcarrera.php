<?php
// Incluir la conexión a la base de datos
include 'conexion_be.php';

// Obtener datos del formulario
$nombre_carrera = $_POST['nombrecarrera']; // Nombre de la carrera
$id_escuela = $_POST['escuela']; // ID de la escuela seleccionada (FK)


// Verificar si la carrera ya existe en la misma escuela
$verificar_carrera = mysqli_query($conexion, "SELECT * FROM carreras WHERE nombre = '$nombre_carrera' AND id_deptoesc = '$id_escuela'");

if (mysqli_num_rows($verificar_carrera) > 0) {
    echo '
    <script>
        alert("La carrera ya está registrada en esta escuela.");
        window.location = "../Carreras.php.php";
    </script>';
    exit();
}

// Insertar la carrera en la tabla `carreras`
$query = "INSERT INTO carreras (nombre, id_deptoesc) VALUES ('$nombre_carrera', '$id_escuela')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
    <script>
        alert("¡Carrera almacenada exitosamente!");
        window.location = "../Carreras.php";
    </script>';
} else {
    echo '
    <script>
        alert("Error al guardar la carrera. Inténtelo nuevamente.");
        window.location = "../Carreras.php";
    </script>';
}

// Cerrar la conexión
mysqli_close($conexion);
?>
