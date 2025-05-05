<?php
include 'conexion_be.php'; // Conexión a la base de datos

// Consulta para obtener los datos de los docentes
$sql = "SELECT Codigo, NombreCompleto, correo_institucional FROM docentes";
$resultado = mysqli_query($conexion, $sql);

// Verifica si hay resultados
if (mysqli_num_rows($resultado) > 0) {
    // Crea un archivo temporal
    $filename = "reporte_docentes.txt";
    $file = fopen($filename, "w");

    // Escribe el encabezado
    fwrite($file, "Reporte de docentes\n");
    fwrite($file, "=====================\n\n");
    fwrite($file, str_pad("Nombre del docente", 30) . "\t" . str_pad("Correo electronico", 30) . "\t" . str_pad("Codigo", 10) . "\n");
    fwrite($file, str_repeat("-", 80) . "\n");

    // Escribe los datos de los docentes en el archivo
    while ($docente = mysqli_fetch_assoc($resultado)) {
        $nombre = str_pad($docente['NombreCompleto'], 30);
        $correo = str_pad($docente['correo_institucional'], 30);
        $codigo = str_pad($docente['Codigo'], 10);

        fwrite($file, "$nombre\t$correo\t$codigo\n");
    }

    fclose($file);

    // Envía el archivo al navegador para descargar
    header('Content-Description: File Transfer');
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename=' . basename($filename));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);

    // Elimina el archivo temporal después de la descarga
    unlink($filename);
    exit;
} else {
    echo "No hay datos para generar el reporte.";
}
?>
