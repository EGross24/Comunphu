<?php
session_start(); // Iniciar la sesión
include 'PHP/conexion_be.php'; // Conexión a la base de datos

// Variables por defecto
$nombre_usuario = 'Invitado';
$matricula_usuario = '---';
$correo_institucional = 'No disponible';
$comentarios_usuario = [];

if (isset($_SESSION['usuario'])) {
    $matricula_usuario = $_SESSION['usuario'];

    // Obtener datos del usuario
    $sql = "SELECT id, nombre_completo, correo_institucional FROM usuarios WHERE matricula = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $matricula_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $id = $usuario['id'];
        $nombre_usuario = $usuario['nombre_completo'];
        $correo_institucional = $usuario['correo_institucional'];

        // Obtener comentarios del usuario actual
        $sql_comentarios = "
            SELECT d.NombreCompleto AS nombre_docente, c.comentario, c.fecha
            FROM comentarios c
            JOIN docentes d ON c.docente_id = d.id_docente
            WHERE c.usuario_id = ?
            ORDER BY c.fecha DESC
        ";
        $stmt2 = $conexion->prepare($sql_comentarios);
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $result_comentarios = $stmt2->get_result();

        while ($row = $result_comentarios->fetch_assoc()) {
            $comentarios_usuario[] = $row;
        }

        $stmt2->close();
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunphu</title>
    <link rel="stylesheet" href="css/try.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=mail" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_vert" />
    <style>
    </style>
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <ul>
                <li>
                    <div class="contenedor-logo">
                        <a href="InicioComunphu.php"><img src="fotos y videos comunphu/logo.png" alt="Logo"
                                class="logo"></a>
                    </div>
                </li>
                <li><a href="Busqueda.php">BÚSQUEDA GENERAL</a></li>
                <li><a href="Reseñas.php">RESEÑAS</a></li>
                <li>
                    <div class="mailhello">
                        <a href="PHP/logout.php" onclick="return confirm('¿Seguro que deseas cerrar sesión?');">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                                <path fill-rule="evenodd"
                                    d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                            </svg>
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
    </header>


    <div class="contenido">
  <!-- PERFIL IZQUIERDA -->
  <div class="perfil-left">
    <div class="perfil-contenido">
      <img src="fotos y videos comunphu/user-icon-on-transparent-background-free-png.webp" alt="Avatar woman">
      <h2><?php echo htmlspecialchars($nombre_usuario); ?></h2>
      <p><?php echo htmlspecialchars($matricula_usuario); ?></p>
      <p><?php echo htmlspecialchars($correo_institucional); ?></p>
    </div>
  </div>

  <!-- COMENTARIOS DERECHA -->
  <div class="comentarios-right">
    <div class="comentarios-scroll">
      <h3>Mis comentarios:</h3>
      <?php if (!empty($comentarios_usuario)): ?>
        <?php foreach ($comentarios_usuario as $comentario): ?>
          <div class="comentario-item">
            <p class="docente"><strong>Docente:</strong> <?php echo htmlspecialchars($comentario['nombre_docente']); ?></p>
            <p class="texto"><?php echo htmlspecialchars($comentario['comentario']); ?></p>
            <p class="fecha"><em><?php echo htmlspecialchars($comentario['fecha']); ?></em></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No has realizado comentarios aún.</p>
      <?php endif; ?>
    </div>
  </div>
</div>


    
</body>

</html>