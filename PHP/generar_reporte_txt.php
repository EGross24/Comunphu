<?php
session_start();
include 'conexion_be.php'; // Conexión a la base de datos

// Consultar usuarios
$sql = "SELECT nombre_completo, matricula, correo_institucional FROM usuarios WHERE rol != 'admin'";
$resultado = mysqli_query($conexion, $sql);

// Crear contenido del archivo TXT
$reporte = "Reporte de Usuarios\n";
$reporte .= str_repeat("=", 80) . "\n";
$reporte .= str_pad("Nombre completo", 30) . str_pad("Matrícula", 20) . str_pad("Correo electrónico", 30) . "\n";
$reporte .= str_repeat("-", 80) . "\n";

while ($fila = mysqli_fetch_assoc($resultado)) {
    $nombre = str_pad($fila['nombre_completo'], 30);
    $matricula = str_pad($fila['matricula'], 20);
    $correo = str_pad($fila['correo_institucional'], 30);

    $reporte .= "$nombre$matricula$correo\n";
}

// Establecer cabeceras para la descarga
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="Reporte_Usuarios.txt"');

// Imprimir contenido
echo $reporte;
exit();
?>
