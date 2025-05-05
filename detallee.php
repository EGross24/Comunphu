<?php
include 'PHP/verificar_sesion.php';

// Conexión a la base de datos
try {
    $con = new PDO("mysql:host=localhost; dbname=comunphu_registro_db", 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

// Procesar comentarios y calificaciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comentario']) && isset($_GET['id_docente'])) {
        $comentario = htmlspecialchars($_POST['comentario']);
        $docente_id = $_GET['id_docente'];

        $sql = "INSERT INTO comentarios (docente_id, comentario, usuario_id, fecha) 
                VALUES (:docente_id, :comentario, :usuario_id, NOW())";
        $sth = $con->prepare($sql);
        $sth->bindParam(':docente_id', $docente_id, PDO::PARAM_INT);
        $sth->bindParam(':comentario', $comentario, PDO::PARAM_STR);
        $sth->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $sth->execute();

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    if (isset($_POST['calificacion']) && isset($_GET['id_docente'])) {
        $calificacion = (int) $_POST['calificacion'];
        $docente_id = $_GET['id_docente'];

        $sql = "INSERT INTO calificaciones (docente_id, calificacion, usuario_id, fecha) 
                VALUES (:docente_id, :calificacion, :usuario_id, NOW())";
        $sth = $con->prepare($sql);
        $sth->bindParam(':docente_id', $docente_id, PDO::PARAM_INT);
        $sth->bindParam(':calificacion', $calificacion, PDO::PARAM_INT);
        $sth->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $sth->execute();

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

// Mostrar información del docente
if (isset($_GET['id_docente'])) {
    $docente_id = $_GET['id_docente'];

    $sql = "
        SELECT d.*, f.nombrefacultad 
        FROM docentes d 
        LEFT JOIN facultades f ON d.id_facultad = f.id 
        WHERE d.id_docente = :id_docente
    ";
    $sth = $con->prepare($sql);
    $sth->bindParam(':id_docente', $docente_id, PDO::PARAM_INT);
    $sth->execute();

    if ($sth->rowCount() > 0) {
        $docente = $sth->fetch(PDO::FETCH_OBJ);
    } else {
        echo "<p>Docente no encontrado.</p>";
        exit();
    }
}

// Obtener comentarios
$sql = "
    SELECT c.comentario, c.fecha, u.nombre_completo 
    FROM comentarios c 
    JOIN usuarios u ON c.usuario_id = u.id 
    WHERE c.docente_id = :docente_id 
    ORDER BY c.fecha DESC
";
$sth = $con->prepare($sql);
$sth->bindParam(':docente_id', $docente_id, PDO::PARAM_INT);
$sth->execute();
$comentarios = $sth->fetchAll(PDO::FETCH_OBJ);


//Calcular el promedio de las calificaciones
$sql = "
    SELECT AVG(calificacion) as promedio 
    FROM calificaciones 
    WHERE docente_id = :docente_id
";
$sth = $con->prepare($sql);
$sth->bindParam(':docente_id', $docente_id, PDO::PARAM_INT);
$sth->execute();
$result = $sth->fetch(PDO::FETCH_OBJ);
$promedio_calificaciones = $result->promedio ? round($result->promedio, 2) : 'No hay calificaciones aún';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Docente</title>
    <link rel="stylesheet" href="css/busqueda.css" />
    <link rel="stylesheet" href="css/detalle.css" />
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
    </header><br><br><br><br><br><br><br><br>
    <div style="text-align: center;" class="imagencontainer">
        <img class="imagendocente" src="fotos y videos comunphu/nopicture.jpg">
    </div>
    <h1 class="namedocente">
        <?php echo htmlspecialchars($docente->NombreCompleto); ?>
    </h1><br>
    <p class="infodocente">Correo Institucional:
        <?php echo htmlspecialchars($docente->correo_institucional); ?>
    </p><br>
    <p class="infodocente">
        <?php echo htmlspecialchars($docente->nombrefacultad); ?>
    </p><br>
    <div class="promedio"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green"
            class="bi bi-star-fill" viewBox="0 0 16 16">
            <path
                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
        </svg>
        <p>
            <?php echo htmlspecialchars( $promedio_calificaciones); ?>
        </p>
    </div>

    <br><br>

    <div class="contenedorcomentarioycalificacion">

        <!-- Botón que abre el modal -->
        <button id="modalcalificacion">Calificar</button>

        <!-- Modal de Calificación (oculto al inicio) -->
        <div class="modalcalificacion2" id="calificacionmodal">
            <div class="modalcontenidoc">
                <h3 >Selecciona una calificación</h3><br>
                <form method="POST">
                    <div class="stars" style="text-align:center;">
                        <input type="radio" id="star5c" name="calificacion" value="1" required />
                        <label for="star5c">&#9733;</label>
                        <input type="radio" id="star4c" name="calificacion" value="2" />
                        <label for="star4c">&#9733;</label>
                        <input type="radio" id="star3c" name="calificacion" value="3" />
                        <label for="star3c">&#9733;</label>
                        <input type="radio" id="star2c" name="calificacion" value="4" />
                        <label for="star2c">&#9733;</label>
                        <input type="radio" id="star1c" name="calificacion" value="5" />
                        <label for="star1c">&#9733;</label>
                    </div><br>
                    <div class="modal-buttonsc">
                        <button type="button" id="cancelarcalificacion">Cancelar</button>
                        <button type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>

        <br><br>

        <button id="modalbcomentario">Agregar Comentario</button>

        <div class="modalcomentario2" id="commentmodal">
            <div class="modalcontenido">
                <h3>Escribe tu comentario</h3>
                <form method="POST">
                    <textarea name="comentario" rows="4" cols="50" required placeholder="Escribe algo..."></textarea>
                    <div class="modalbuttons">
                        <button type="submit" id="botonenviar">Enviar</button>
                </form>
                <button id="botoncancelar">Cancelar</button>
            </div>
        </div>
    </div>
    </div>
</div>





    <br>
    <br>

    <h3 class="comentarioss">Comentarios</h3>
    <hr>
    <?php foreach ($comentarios as $comentario): ?>
    <div class="comentariocontenido">
        <p>
            <?php echo htmlspecialchars($comentario->comentario); ?>
        </p>
        <p class="usuario">Por:
            <?php echo htmlspecialchars($comentario->nombre_completo); ?>
        </p>
        <p class="fecha" >
            <?php echo htmlspecialchars($comentario->fecha); ?>
        </p>
    </div>
    <?php endforeach; ?>

</body>
<script src="JavaScript/comunphu.js"></script>

</html>