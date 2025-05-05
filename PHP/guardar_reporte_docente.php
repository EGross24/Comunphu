<?php
// Incluir la biblioteca FPDF
require('fpdf/fpdf.php');

// Conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$database = "tu_base_de_datos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos
$sql = "SELECT nombre_completo, matricula, correo_electronico, usuario FROM tu_tabla";
$result = $conn->query($sql);

// Crear una clase personalizada extendiendo FPDF para agregar el encabezado y pie de página
class PDF extends FPDF {
    // Encabezado
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de usuario', 0, 1, 'C');
        $this->Ln(5);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear el PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 10, 'Nombre completo', 1, 0, 'C');
$pdf->Cell(30, 10, 'Matricula', 1, 0, 'C');
$pdf->Cell(60, 10, 'Correo electronico', 1, 0, 'C');
$pdf->Cell(30, 10, 'Usuario', 1, 1, 'C');

// Rellenar los datos de la tabla
$pdf->SetFont('Arial', '', 10);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(60, 10, utf8_decode($row['nombre_completo']), 1, 0, 'C');
        $pdf->Cell(30, 10, utf8_decode($row['matricula']), 1, 0, 'C');
        $pdf->Cell(60, 10, utf8_decode($row['correo_electronico']), 1, 0, 'C');
        $pdf->Cell(30, 10, utf8_decode($row['usuario']), 1, 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
}

$conn->close();

// Salida del archivo PDF
$pdf->Output('D', 'reporte_usuarios.pdf');
?>
