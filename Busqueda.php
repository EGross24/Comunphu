<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está logueado
if (isset($_SESSION['nombre_completo']) && isset($_SESSION['usuario'])) {
    $nombre_usuario = $_SESSION['nombre_completo']; // Obtener el nombre del usuario desde la sesión
    $matricula_usuario = $_SESSION['usuario']; // Obtener la matrícula del usuario desde la sesión
    
} else {
    $nombre_usuario = 'Invitado'; // En caso de que no esté logueado
    $matricula_usuario = '---';  // Matricula no disponible si no está logueado
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunphu</title>
    <link rel="stylesheet" href="css/busqueda.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=mail" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_vert" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
    <!--fontawsome links-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css>">
    <style>
        @import "//netdna.bootstrapcdn.com/font-awesome/3.0/css/font-awesome.css";
        h3 {
            color: white;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }
        svg{
            color: white;
        }
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24
}

        /* Estilo de la tabla y los resultados */
    .results-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        margin-bottom: 50px;
    }

    a{
        text-decoration: none;
    }

    table {
        width: 70%; /* Cambiar el tamaño de la tabla */
        border-collapse: collapse;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 0 auto; /* Centrar la tabla */
    }

    th, td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: white;
        font-size: 18px;
    }

    td {
        background-color: #ffffff;
        font-size: 16px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
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
                </div></li>
            </ul>
        </nav>
    </header>

    
    <div class="busquedafoto">

    </div>
    <br><br>
    <div class="textobusqueda"><p>Utiliza la barra de búsqueda para buscar información sobre los docentes de la Universidad</p></div>    
    <br>
    <!-- Formulario de búsqueda -->
    <div class="buscarcontenedor">
    <form method="post">
        <label for="search"></label>
        <input style="display=flex;lex-direction: column; justify-content: center; align-items: center; width: 600px;border-radius: 30px; height: 50px; border-color: grey; border-width: 0.5px;border-style: solid;text-align: center;font-size: 20px; font-family: 'FontAwesome';" type="text" name="search" id="search" placeholder ="Leonel Savery                                                                                  &#xf002"/>
        <input style="width:75px; height:75px; font-family: arial;font-size:20px; background-color: white;border: 0" type="submit" name="submit" value="Buscar">
    </form></div> 

    <script src="JavaScript/comunphu.js"></script>
</body>

</html>

<?php
// Conexión a la base de datos
try {
    $con = new PDO("mysql:host=localhost; dbname=comunphu_registro_db", 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

// Verificar si el formulario fue enviado
if (isset($_POST["submit"])) {
    // Obtener el valor de búsqueda y eliminar espacios extra
    $str = trim($_POST["search"]);

    // Validar que el campo no esté vacío
    if (!empty($str)) {
    // Preparar la consulta SQL usando LIKE para coincidencias parciales
    $sth = $con->prepare("SELECT * FROM `docentes` WHERE `NombreCompleto` LIKE :nombres");

    // Usar el operador LIKE con el comodín % para buscar coincidencias parciales
    $searchTerm = "%" . $str . "%";
    $sth->bindParam(':nombres', $searchTerm, PDO::PARAM_STR);

    // Establecer el modo de recuperación de datos
    $sth->setFetchMode(PDO::FETCH_OBJ);

    // Ejecutar la consulta
    $sth->execute();

    // Verificar si se encontró un resultado
    if ($row = $sth->fetch()) {
        // Mostrar la tabla centrada
        echo '<div class="results-container">';
        echo "<table>
                <tr>
                    <th>Docentes</th>
                </tr>";
        // Mostrar todos los resultados encontrados
        do {
            echo "<tr>
                    <td><a href='detallee.php?id_docente=" . $row->id_docente . "'>" . htmlspecialchars($row->NombreCompleto) . "</a></td>
                  </tr>";
        } while ($row = $sth->fetch());
        echo "</table>";
        echo '</div>';
    } else {
        echo 'No se encontraron coincidencias para "' . htmlspecialchars($str) . '".';
    }
} else {
    echo "Por favor ingresa un nombre para buscar.";
}
}
?>