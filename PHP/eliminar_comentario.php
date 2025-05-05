<?php
// Incluir la conexión a la base de datos
include 'conexion_be.php';

// Obtener el ID del comentario a eliminar
$id_comentario = $_POST['id_comentario'];

// Validar que el ID no esté vacío
if (empty($id_comentario)) {
    echo '
    <script>
        alert("ID de comentario no válido.");
        window.location = "comentariosadmin.php"; // 
    </script>';
    exit();
}

// Eliminar el comentario de la base de datos
$sql = "DELETE FROM comentarios WHERE id_comentario = '$id_comentario'";
$resultado = mysqli_query($conexion, $sql);

// Verificar si la eliminación fue exitosa
if ($resultado) {
    echo '
    <script>
        alert("¡Comentario eliminado exitosamente!");
        window.location = "comentariosadmin.php";
    </script>';
} else {
    echo '
    <script>
        alert("Error al eliminar el comentario.");
        window.location = "comentariosadmin.php";
    </script>';
}

// Cerrar la conexión
mysqli_close($conexion);
?>
