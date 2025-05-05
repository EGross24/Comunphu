<?php
session_start(); // Iniciar la sesión

include 'PHP/conexion_be.php'; // Conexión a la base de datos

// Verificar si el usuario está logueado
if (isset($_SESSION['usuario'])) {
    $matricula_usuario = $_SESSION['usuario']; // Obtener la matrícula del usuario desde la sesión

    // Consultar los datos del usuario en la base de datos
    $sql = "SELECT nombre_completo, correo_institucional FROM usuarios WHERE matricula = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $matricula_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $nombre_usuario = $usuario['nombre_completo'];
        $correo_institucional = $usuario['correo_institucional'];
    } else {
        $nombre_usuario = 'Invitado';
        $correo_institucional = 'No disponible';
    }
} else {
    $nombre_usuario = 'Invitado'; // En caso de que no esté logueado
    $matricula_usuario = '---';  // Matrícula no disponible si no está logueado
    $correo_institucional = 'No disponible'; // Correo no disponible si no está logueado
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunphu</title>
    <link rel="stylesheet" href="css/busqueda.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" hre="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=mail" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_vert" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        h3 {
            font-family: 'FontAwesome';
            text-align: center;
        }
        h1 {
            color: rgb(22, 138, 45);
            font-size: 50px;
            text-align: center;
        }
        .comments {
            font-size: 20px;
            font-family: Arial, Helvetica, sans-serif;
            color: grey;
            margin-left: 1%;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
            text-align: center;
            justify-content: center;
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }
        .modal-header, .modal-footer {
            padding: 10px;
            background-color: #f1f1f1;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .botones {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 400px;
            height: auto;
            margin: 0 auto;
            justify-content: space-between;
        }
        #btnCalificar {
            background-color: rgb(13, 70, 112);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        #btnComentar {
            background-color: rgb(13, 70, 112);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        #btnComentar:hover, #btnCalificar:hover {
            background-color: rgb(13, 70, 112);
        }
        .stars {
            display: inline-block;
            font-size: 24px;
            color: #FFD700;
        }
        .stars input {
            display: none;
        }
        .stars label {
            cursor: pointer;
        }
        .stars input:checked ~ label {
            color: #FFD700;
        }
        .stars input:checked ~ label ~ label {
            color: #ccc;
        }
        /* Estilo para los comentarios */
        .comentario-box {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin-left: 25px;
            height: auto
        }
        .comentario-box p {
            margin: 10px 0;
        }
        .comentario-box em {
            color: black;
            font-size: 0.9em;
        }
        .enviarycancelarcom{
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            width: 800px;
            text-align: center;
            align-items: left;

        }
        .enviarcom{
            background-color: rgb(13, 70, 112);
            border-radius: 10px;
            height: 25px;
            width: auto;
            font-family: Arial, Helvetica, sans-serif;
            color: white;
            font-weight: bold;
        }
        .cancelcom{
            background-color: darkred;
            border-radius: 10px;
            height: 25px;
            width: auto;
            font-family: Arial, Helvetica, sans-serif;
            color: white;
            font-weight: bold;
        }
        #comentario{
            width: 90%;
        }

    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <ul>
                <li><div class="contenedor-logo">
                    <a href="InicioComunphu.php"><img src="fotos y videos comunphu/logo.png" alt="Logo" class="logo"></a></div></li>
                <li><a href="Busqueda.php">BÚSQUEDA GENERAL</a></li>
                <li><a href="">RESEÑAS</a></li>
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
    </header><br><br><br><br><br><br><br><br>
    
    <?php


// Conexión a la base de datos
try {
    $con = new PDO("mysql:host=localhost; dbname=comunphu_registro_db", 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

// Verificar si se recibió el ID del docente
if (isset($_GET['id_docente'])) {
    $id = $_GET['id_docente'];

    // Consulta actualizada con LEFT JOIN para obtener el nombre de la facultad
    $sth = $con->prepare("
        SELECT d.*, f.nombrefacultad 
        FROM docentes d 
        LEFT JOIN facultades f ON d.id_facultad = f.id 
        WHERE d.id_docente = :id_docente
    ");
    $sth->bindParam(':id_docente', $id, PDO::PARAM_INT);
    $sth->execute();

    // Verificar si se encontró el docente
    if ($sth->rowCount() > 0) {
        $row = $sth->fetch(PDO::FETCH_OBJ);

        echo "<h1>" . htmlspecialchars($row->NombreCompleto) . "</h1><br>";
        echo "<h3>Correo: " . htmlspecialchars($row->correo_institucional) . "</h3><br>";
        $nombreFacultad = $row->nombrefacultad ?? 'Facultad no especificada';
        echo "<h3> " . htmlspecialchars($nombreFacultad) . "</h3><br>";

        // Calcular el promedio de calificaciones
        $sthCalificaciones = $con->prepare("
            SELECT AVG(calificacion) as promedio 
            FROM calificaciones 
            WHERE docente_id = :docente_id
        ");
        $sthCalificaciones->bindParam(':docente_id', $id, PDO::PARAM_INT);
        $sthCalificaciones->execute();

        if ($rowCalif = $sthCalificaciones->fetch(PDO::FETCH_OBJ)) {
            $promedio = round($rowCalif->promedio, 2);
            echo "<h3>Calificación Promedio: &#9733; " . $promedio . " / 5</h3><br>";
        } else {
            echo "<p>No hay calificaciones aún.</p>";
        }

        // Manejo de inserción de comentarios
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
            $comentario = htmlspecialchars($_POST['comentario']);
            $usuario_id = $_SESSION['usuario_id'] ?? null; // Verifica que el usuario esté logueado

            if ($usuario_id) {
                $sthInsert = $con->prepare("
                    INSERT INTO comentarios (docente_id, comentario, usuario_id, fecha) 
                    VALUES (:docente_id, :comentario, :usuario_id, NOW())
                ");
                $sthInsert->bindParam(':docente_id', $id, PDO::PARAM_INT);
                $sthInsert->bindParam(':comentario', $comentario, PDO::PARAM_STR);
                $sthInsert->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
                $sthInsert->execute();

                // Redirigir para evitar reenvío
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            } else {
                echo "<p>No puedes comentar si no estás logueado.</p>";
            }
        }

        // Mostrar botones para comentarios y calificaciones
        echo '<div class="botones">';
        echo '<button id="btnComentar" onclick="mostrarModalComentario()">Agregar Comentario</button>';
        echo '<button id="btnCalificar" onclick="mostrarModalCalificacion()">Agregar Calificación</button>';
        echo '</div>';

        // Modal para comentarios
        echo '<div id="modalComentario" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" onclick="cerrarModalComentario()">&times;</span>
                        <h2>Escribe tu comentario</h2>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <textarea name="comentario" id="comentario" rows="4" cols="50"></textarea><br>
                            <div class="enviarycancelarcom">
                                <input type="submit" class="enviarcom" value="Enviar comentario">
                                <button type="button" class="cancelcom" onclick="cerrarModalComentario()">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';

        // Modal para calificación
        echo '<div id="modalCalificacion" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" onclick="cerrarModalCalificacion()">&times;</span>
                        <h2>Califica al Docente</h2>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <label for="calificacion">Calificación (1-5):</label><br>
                            <div class="stars">
                                <input type="radio" id="star5" name="calificacion" value="5" />
                                <label for="star5">&#9733;</label>
                                <input type="radio" id="star4" name="calificacion" value="4" />
                                <label for="star4">&#9733;</label>
                                <input type="radio" id="star3" name="calificacion" value="3" />
                                <label for="star3">&#9733;</label>
                                <input type="radio" id="star2" name="calificacion" value="2" />
                                <label for="star2">&#9733;</label>
                                <input type="radio" id="star1" name="calificacion" value="1" />
                                <label for="star1">&#9733;</label>
                            </div>
                            <br>
                            <input type="submit" value="Enviar calificación">
                            <button type="button" onclick="cerrarModalCalificacion()">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>';

        // Mostrar comentarios
        echo '<br><h4 class="comments">Comentarios</h4><br>';

        $sthComentarios = $con->prepare("
            SELECT c.comentario, c.fecha, u.nombre_completo 
            FROM comentarios c 
            JOIN usuarios u ON c.usuario_id = u.id 
            WHERE c.docente_id = :docente_id 
            ORDER BY c.fecha DESC
        ");
        $sthComentarios->bindParam(':docente_id', $id, PDO::PARAM_INT);
        $sthComentarios->execute();

        while ($comentario = $sthComentarios->fetch(PDO::FETCH_OBJ)) {
            echo "<div class='comentario-box'>
                    <p>" . htmlspecialchars($comentario->comentario) . "</p>
                    <p><strong>Por: " . htmlspecialchars($comentario->nombre_completo) . "</strong></p>
                    <p><em>" . htmlspecialchars($comentario->fecha) . "</em></p>
                  </div>";
        }
    } else {
        echo "<p>Docente no encontrado. Por favor, verifica que el ID del docente es correcto.</p>";
    }
} else {
    echo "<p>No se proporcionó un ID de docente válido.</p>";
}
?>

<script>
    // Mostrar y ocultar el modal para comentarios
    function mostrarModalComentario() {
        document.getElementById("modalComentario").style.display = "block";
    }
    function cerrarModalComentario() {
        document.getElementById("modalComentario").style.display = "none";
    }

    // Mostrar y ocultar el modal para calificación
    function mostrarModalCalificacion() {
        document.getElementById("modalCalificacion").style.display = "block";
    }
    function cerrarModalCalificacion() {
        document.getElementById("modalCalificacion").style.display = "none";
    }
</script>

</body>
</html>
