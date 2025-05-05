<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=mail" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_vert" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css>">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=mail" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_vert" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
    <title>Inicio Admin - COMUNPHU</title>
    <style>
        h3 {
            color: white;
            font-size: 20px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
        }

        header {
            width: 100%;
            position: sticky;
            height: 150px;
        }

        nav {
            background-color: #f9f9f9;
            width: 100%;
            height: 50%;
            display: flex;
            justify-content: space-around;
            align-items: center;

        }

        .navbar ul {
            list-style: none;
            display: flex;
            justify-content: space-between;
            gap: 100px;
            font-size: 150%;
            font-weight: 300;
            margin: 50px 20px 0 0;
            height: 10vh;
            font-family: Arial, Helvetica, sans-serif;

        }

        .navbar a {
            text-decoration: none;
            color: white;
        }

        .contenedor-logo {
            display: flex;
            flex-direction: row;
        }

        .adminlogo {
            width: 60%;
            margin-bottom: 20px;
            width: 400px;
            height: 100px;
            justify-content: left;
            align-items: start;
        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }

        .mailhello {
            display: flex;
            justify-content: space-evenly;
            gap: 10px;
        }

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
    <header class="header">
        <nav class="navbar">
            <ul>
                <li>
                    <div class="contenedor-logo">
                        <img src="fotos y videos comunphu/adminlogo.png" alt="adminlogo" class="adminlogo">
                    </div>
                </li>
                <li>
                    <div class="mailhello">
                        <a href="PHP/logout.php" onclick="return confirm('¿Seguro que deseas cerrar sesión?');">
                            <svg style="color: black;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
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
        </nav><br><br><br>
        <hr>
    </header>

    <div id="funciones">
        <a href="comentariosadmin.php">
            <div class="comentarios"><img class="functionsmall" src="fotos y videos comunphu/comentariosrev.png"></div>
        </a>
        <a href="usuariosadmin.php">
            <div class="usuarios"><img class="functionsmall" src="fotos y videos comunphu/usuarios.png"></div>
        </a>
        <a href="docentesadmin.php">
            <div class="docentes"><img class="functionsmall" src="fotos y videos comunphu/docentes.png"></div>
        </a>
        <a href="Facultades.php">
            <div class="facultades"><img class="functionsmall" src="fotos y videos comunphu/facultades.png"></div>
        </a>
    </div>
    <div id="funciones2">
        <a href="dep-escuelas.php">
            <div class="dep-escuelas"><img class="functionsmall" src="fotos y videos comunphu/escuelas.png"></div>
        </a>
        <a href="Carreras.php">
            <div class="carreras"><img class="functionsmall" src="fotos y videos comunphu/carreras.png"></div>
        </a>
        <a href="asignaturasAdmin.php">
            <div class="asignaturas"><img class="functionsmall" src="fotos y videos comunphu/asignaturas.png"></div>
        </a>
    </div>
    </div>


</body>

</html>