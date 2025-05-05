<?php
// Conectar a la base de datos
include 'PHP/conexion_be.php';

// Obtener las facultades para poblar el dropdown
$departamentos = mysqli_query($conexion, "SELECT id, nombre FROM departamentos_escuelas WHERE nombre LIKE '%Departamento%'");
$escuelas = mysqli_query($conexion, "SELECT id, nombre FROM departamentos_escuelas WHERE nombre LIKE '%Escuela%'");
$carrera = mysqli_query($conexion, "SELECT id, nombre FROM carreras");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Asignatura - Administración COMUNPHU</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=mail" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_vert" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
    <!--fontawsome links-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css>">
    <style>
        h1 {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;
            text-align: center;
        }

        select {
            display: block;
            width: 300px;
            margin-bottom: 10px;
            margin-bottom: 35px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #8f8c8c;
            background-color: #f9f9f9;
            padding: 12px 20px 12px;
            box-sizing: border-box;
            border: 2px solid #ccc;
        }

        #contenedor-addmaestro {
            display: flex;
            justify-content: center;
            text-align: center;
            align-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0 auto;
            width: 100%;
            max-width: 900px;
            padding: 20px;
            height: 420px;
            border-radius: 20px;
            border: 10px #555;
            border-style: solid;

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
        <div class="subheader">
            <svg id="redirect-home" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff"
                    d="M48 256a208 208 0 1 1 416 0A208 208 0 1 1 48 256zm464 0A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM217.4 376.9c4.2 4.5 10.1 7.1 16.3 7.1c12.3 0 22.3-10 22.3-22.3l0-57.7 96 0c17.7 0 32-14.3 32-32l0-32c0-17.7-14.3-32-32-32l-96 0 0-57.7c0-12.3-10-22.3-22.3-22.3c-6.2 0-12.1 2.6-16.3 7.1L117.5 242.2c-3.5 3.8-5.5 8.7-5.5 13.8s2 10.1 5.5 13.8l99.9 107.1z" />
            </svg>
            <p>Asignaturas</p>
        </div>
    </header>
    <br><br><br><br>
    <h1>Añadir Nueva Asignatura</h1>
    <section id="contenedor-addmaestro">
        <div class="subcontenedor-addmaestro">
            <form id="formreg" action="PHP/registro_asignatura_be.php" method="POST">
                <div id="divideform">
                    <div class="formleft">
                        <label for="codigo_asignatura">Código</label>
                        <input type="text" id="codigo" name="codigo" placeholder="⚙️    ej: INF-275" required
                            pattern="^[a-z]{3}\-d{3}$" title="Código INF-275"><br>
                        <label for="nombre_asignatura">Nombre de la Asignatura</label>
                        <input type="text" id="nombre_asignatura" name="nombre_asignatura"
                            placeholder="📃    ej: Ingeniería de Software II" required><br>
                        <label for="carrera">Carrera</label>
                        <select name="carrera" id="carrera">
                            <option value="" disabled selected>Seleccione una carrera (si aplica)</option>
                            <?php
                            while ($fila = mysqli_fetch_assoc($carrera)) {
                                echo "<option value='{$fila['id']}'>{$fila['nombre']}</option>";
                            }
                            ?>
                        </select>
                    </div><br>
                    <div class="formright">
                        <label for="departamento">Departamento</label>
                        <select name="departamento" id="departamento">
                            <option value="" disabled selected>Seleccione un Departamento (si aplica)</option>
                            <?php
                            while ($fila = mysqli_fetch_assoc($departamentos)) {
                                echo "<option value='{$fila['id']}'>{$fila['nombre']}</option>";
                            }
                            ?>
                        </select>
                        <label for="escuela">Escuela</label>
                        <select name="escuela" id="escuela">
                            <option value="" disabled selected>Seleccione una Escuela (si aplica)</option>
                            <?php
                            while ($fila = mysqli_fetch_assoc($escuelas)) {
                                echo "<option value='{$fila['id']}'>{$fila['nombre']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div><br><br>
                <div class="wrap">
                    <button type="submit">Añadir</button>
                </div><br>
            </form>
        </div>
    </section>


    <!-- volver al homepage del admin -->
    <script>
        document.getElementById('redirect-home').addEventListener('click', function () {
            window.location.href = 'InicioAdmin.php'; // Cambia 'index.php' por la ruta a tu página de inicio
        });
    </script>
</body>

</html>