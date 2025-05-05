<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no está logueado
    header("Location: index.php");
    exit();
}

// Conexión a la base de datos
include 'PHP/conexion_be.php';

// Consultar los datos del usuario logueado
$matricula_usuario = $_SESSION['usuario'];
$sql = "SELECT id, nombre_completo, correo_institucional, rol FROM usuarios WHERE matricula = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $matricula_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $usuario_id = $usuario['id'];
    $nombre_usuario = $usuario['nombre_completo'];
    $correo_institucional = $usuario['correo_institucional'];
    $rol_usuario = $usuario['rol'];
} else {
    // Si no se encuentra el usuario, cerrar sesión y redirigir
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
