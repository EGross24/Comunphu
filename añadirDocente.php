<?php
// Conectar a la base de datos
include 'PHP/conexion_be.php';

// Obtener las facultades para poblar el dropdown
$facultades = mysqli_query($conexion, "SELECT id, nombrefacultad FROM facultades");
$asignaturas = mysqli_query($conexion, "SELECT id_asignatura, nombre_asignatura FROM asignaturas");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Añadir Docente - Administración COMUNPHU</title>
    <style>
        h1 {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;
            text-align: center;
        }
        select{
    display: block;
    width: 300px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #8f8c8c;
    background-color: #f9f9f9;
    padding: 12px 20px 12px;
    box-sizing: border-box;
    border: 2px solid #ccc;
        }
        .formleft{
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    width: 350px;
    margin-right: 1px;
    padding: 20px;
    padding-left: 70px;
    
}
input[type=email] {
    display: block;
    width: 320px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-family: Arial, Helvetica, sans-serif;
    color: #8f8c8c;
    background-color:#f9f9f9 ;
    padding: 12px 20px 12px 40px;
    box-sizing: border-box;
    border: 2px solid #ccc;
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
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="black">
                            <path
                                d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z" />
                        </svg>
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
            <p>Docentes</p>
        </div>
    </header>
    <br><br><br><br><br>
    <h1>Añadir Nuevo Docente</h1>
    <section id="contenedor-addmaestro1">
        <div class="subcontenedor-addmaestro">
            <form id="formreg" action="PHP/registrarDocente.php" method="POST">
                <div id="divideform">
                    <div class="formleft">
                        <label for="codigod">Código</label>
                        <input type="text" id="codigod" name="codigod" placeholder="⚙️    ej: rl1234" required
                            pattern="^[a-z]{2}\d{4}$" title="Código rl1234">
                        <label for="nombre_completo">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre_completo"
                            placeholder="🗒️    ej: Rafael Leonardo Martínez Jorge" required>
                       
                    </div><br>
                    <div class="formright"><br>
                    <label for="correo_institucional">Correo Institucional</label>
                        <input type="email" id="email" name="correo_institucional" placeholder="✉️    ej: rl1234@unphu.edu.do"
                            required><br>
                        <label for="facultad">Facultad</label>
                        <select name="facultad" id="facultad" required>
                            <option value="" disabled selected>Seleccione una Facultad</option>
                            <?php
                            while ($fila = mysqli_fetch_assoc($facultades)) {
                                echo "<option value='{$fila['id']}'>{$fila['nombrefacultad']}</option>";
                            }
                            ?>
                        </select><br>
                    </div><br><br>
                </div>
                <div class="wrap">
                    <button type="submit">Añadir</button>
                </div><br>
            </form>
        </div>
    </section>
    <script>
        document.getElementById('redirect-home').addEventListener('click', function () {
            window.location.href = 'docentesadmin.php';
        });
    </script>
</body>

</html>