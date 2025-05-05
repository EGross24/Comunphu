<?php
// Incluir conexión a la base de datos
include 'conexion_be.php';

// Obtener datos del formulario
$nombre_departamento = $_POST['dep_escuela']; 
$id_facultad = $_POST['facultad']; 



// Verificar si el departamento ya existe en esa facultad
$verificar_departamento = mysqli_query($conexion, "SELECT * FROM departamentos_escuelas WHERE nombre = '$nombre_departamento' AND id_facultad = '$id_facultad'");

if (mysqli_num_rows($verificar_departamento) > 0) {
    echo '
    <script>
        alert("El departamento o escuela ya está registrado en esta facultad.");
        window.location = "../dep-escuelas.php";
    </script>';
    exit();
}

// Insertar el departamento o escuela en la tabla `departamentos_escuelas`
$query = "INSERT INTO departamentos_escuelas (nombre, id_facultad) VALUES ('$nombre_departamento', '$id_facultad')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
    <script>
        alert("¡Departamento o Escuela almacenado exitosamente!");
        window.location = "../dep-escuelas.php";
    </script>';
} else {
    echo '
    <script>
        alert("Error al guardar el Departamento o Escuela. Inténtelo nuevamente.");
        window.location = "../dep-escuelas.php";
    </script>';
}

// Cerrar la conexión
mysqli_close($conexion);
?>
