<?php
session_start(); // Iniciar sesión

include 'conexion_be.php'; // Conexión a la base de datos

$matricula = $_POST['matricula'];
$contraseña = $_POST['contraseña'];

// Consulta el usuario y su rol en la base de datos
$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE matricula = '$matricula'");

if (mysqli_num_rows($validar_login) > 0) {
    $usuario = mysqli_fetch_assoc($validar_login);

    // Verificar la contraseña
    if ($contraseña === $usuario['contraseña']) {
        // Guardar información del usuario en la sesión
        $_SESSION['usuario'] = $usuario['matricula'];
        $_SESSION['nombre_completo'] = $usuario['nombre_completo'];
        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['rol']; // Guardar el rol del usuario

        // Redirigir según el rol
        if ($usuario['rol'] === 'admin') {
            header("Location: ../InicioAdmin.php"); // Página para administradores
        } else {
            header("Location: ../InicioComunphu.php"); // Página para usuarios
        }
        exit();
    } else {
        echo '
            <script>
            alert("Contraseña incorrecta. Por favor, inténtelo de nuevo.");
            window.location = "../index.php";
            </script>';
    }
} else {
    echo '
        <script>
        alert("Usuario no existe. Por favor, verifique sus datos.");
        window.location = "../index.php";
        </script>';
}
exit;
?>
