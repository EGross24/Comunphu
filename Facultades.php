<?php
session_start();
include 'PHP/conexion_be.php'; // Conexión a la base de datos

// Consultar datos para los dropdowns
$departamentos_escuelas = mysqli_query($conexion, "SELECT id, nombre FROM departamentos_escuelas");
$carreras = mysqli_query($conexion, "SELECT id, nombre FROM carreras");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Facultad</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
        <style>
        h1{
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;
            text-align: center;
        }
    input[type=text] {
    display: block;
    width: 100%;
    width: 1000px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    border-radius: 5px;
    color: #8f8c8c;
    background-image: url('');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
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
                <li><div class="contenedor-logo">
                    <img src="fotos y videos comunphu/adminlogo.png" alt="adminlogo" class="adminlogo"></div></li>
                <li><div class="mailhello">
                <a href="PHP/logout.php" onclick="return confirm('¿Seguro que deseas cerrar sesión?');">
                            <svg style="color: black;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                                <path fill-rule="evenodd"
                                    d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                            </svg>
                        </a>
                </div></li>
            </ul>
        </nav><br><br><br>
        <div class="subheader">
        <svg id="redirect-home" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M48 256a208 208 0 1 1 416 0A208 208 0 1 1 48 256zm464 0A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM217.4 376.9c4.2 4.5 10.1 7.1 16.3 7.1c12.3 0 22.3-10 22.3-22.3l0-57.7 96 0c17.7 0 32-14.3 32-32l0-32c0-17.7-14.3-32-32-32l-96 0 0-57.7c0-12.3-10-22.3-22.3-22.3c-6.2 0-12.1 2.6-16.3 7.1L117.5 242.2c-3.5 3.8-5.5 8.7-5.5 13.8s2 10.1 5.5 13.8l99.9 107.1z"/></svg>
        <p>Facultades</p>
        </div></header>    
        <br><br><br><br><br>
    <h1>Agregar Nueva Facultad</h1>

    <section id="contenedorPrincipaladd">
    <form action="PHP/guardarfacultad.php" method="POST">
        <!-- Nombre de la Facultad -->
        <label for="nombrefacultad">Nombre de la Facultad:</label>
        <input type="text" name="nombrefacultad" id="nombrefacultad" required placeholder="&#x1F4DC    ej: Facultad de Ciencias y Tecnología">

    <br><br>
    <div class="wrap">
        <button type="submit">Añadir</button></div>
    </form></section>
    
    <script>
        document.getElementById('redirect-home').addEventListener('click', function() {
            window.location.href = 'inicioadmin.php'; // Cambia 'index.php' por la ruta a tu página de inicio
        });
    </script>
</body>
</html>
