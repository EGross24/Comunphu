<?php
include 'verificar_sesion.php';

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Docente</title>
</head>
<body>
    <h1>Detalle del Docente</h1>
    <h2><?php echo htmlspecialchars($docente->NombreCompleto); ?></h2>
    <p>Correo: <?php echo htmlspecialchars($docente->correo_institucional); ?></p>
    <p>Facultad: <?php echo htmlspecialchars($docente->nombrefacultad); ?></p>

    <h3>Agregar Comentario</h3>
    <form method="POST">
        <textarea name="comentario" rows="4" cols="50" required></textarea><br>
        <button type="submit">Comentar</button>
    </form>

    <h3>Calificar Docente</h3>
    <form method="POST">
        <label>
            <input type="radio" name="calificacion" value="1" required> 1
        </label>
        <label>
            <input type="radio" name="calificacion" value="2"> 2
        </label>
        <label>
            <input type="radio" name="calificacion" value="3"> 3
        </label>
        <label>
            <input type="radio" name="calificacion" value="4"> 4
        </label>
        <label>
            <input type="radio" name="calificacion" value="5"> 5
        </label><br>
        <button type="submit">Calificar</button>
    </form>

    <h3>Comentarios</h3>
    <?php foreach ($comentarios as $comentario): ?>
        <div>
            <p><?php echo htmlspecialchars($comentario->comentario); ?></p>
            <p>Por: <?php echo htmlspecialchars($comentario->nombre_completo); ?></p>
            <p>Fecha: <?php echo htmlspecialchars($comentario->fecha); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>

