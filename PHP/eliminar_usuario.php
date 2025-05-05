<?php
// Incluir conexión a la base de datos
include 'conexion_be.php';

// Verificar si se envió el ID del usuario
if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id = '$id_usuario'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        echo '
        <script>
            alert("Usuario eliminado exitosamente.");
            window.location = "../usuariosadmin.php"; 
        </script>';
    } else {
        echo '
        <script>
            alert("Error al eliminar el usuario.");
            window.location = "../usuarioadmin.php";
        </script>';
    }
} else {
    echo '
    <script>
        alert("ID de usuario no válido.");
        window.location = "../usuariosadmin.php";
    </script>';
}

// Cerrar la conexión
mysqli_close($conexion);
?>
