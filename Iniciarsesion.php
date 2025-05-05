<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion Comunphu</title>
    <link rel="stylesheet" href="css/iniciosesion.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=person" />
    <style>
        .material-symbols-outlined {
          font-variation-settings:
          'FILL' 0,
          'wght' 400,
          'GRAD' 0,
          'opsz' 24
        }
    </style>
</head>
<body>
    <div class="accesogeneral">
        <h1></h1>
      </div>
      
      <div class="split right">
        <div class="centered">
            <div id="formularioinicio"><br>
                <img src="fotos y videos comunphu/logo2.png" alt="logo" id="logoform"><br>
                <div class="main">
                <form action="PHP/login_usuario_be.php" method="POST">
                    <label for="matricula">Matrícula</label>
                    <input type="text" id="matricula" name="matricula" placeholder="ej: er23-0430" required><br>
                    <label for="contraseña">Contraseña</label>     
                    <input type="password" id="contraseña" name="contraseña" placeholder="......." required>
                <div class="wrap">
                    <button type="submit">
                        Acceder
                    </button></div>
                    
                </div>
                </div>
                </form>
                <?php
// Iniciar la sesión al inicio del archivo PHP
session_start();

// Conectar a la base de datos
try {
    $con = new PDO("mysql:host=localhost; dbname=comunphu_registro_db", 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

// Verificar si se envió el formulario de login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['correo_institucional']) && isset($_POST['contraseña'])) {
    $correo_institucional = $_POST['correo_institucional'];
    $contraseña = $_POST['contraseña'];

    // Consultar si el usuario existe
    $sth = $con->prepare("SELECT * FROM usuarios WHERE matricula = :correo_institucional");
    $sth->bindParam(':correo_institucional', $correo_institucional);
    $sth->execute();
    $usuario = $sth->fetch(PDO::FETCH_ASSOC);

    // Verificar la contraseña
    if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        // Iniciar la sesión y guardar el nombre del usuario
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['matricula'] = $usuario['matricula'];
        $_SESSION['nombre_completo'] = $usuario['nombre_completo'];  // Asegúrate de que este campo esté en tu tabla de usuarios
        $_SESSION['correo_institucional'] = $usuario['correo_institucional'];
        
        // Redirigir a la página de inicio o dashboard
        header('Location: InicioComunphu.php');
        exit();
    } else {
        echo "Correo o contraseña incorrectos";
    }
}
?>

        <script src="JavaScript/comunphu.js"></script>
</body>
</html>