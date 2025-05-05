<?php
session_start();

include 'PHP/conexion_be.php'; // Conexión a la base de datos

// Obtener usuarios que no son administradores
$sql = "SELECT id, matricula, nombre_completo, correo_institucional FROM usuarios WHERE rol != 'admin'";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .reporte {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            width: 300px;
            height: 50px;
            background-color: rgb(13, 70, 112);
            border-radius: 25px;
            font-weight: bold;
            color: white;
            font-family: Arial, Helvetica, sans-serif;
            margin-left: 40px;
            margin-right: 20px;

        }

        .reporte p {
            margin-top: 15px;
            font-size: 20px;
        }

        .reporte svg {
            margin-top: 10px;
            width: 30px;
            height: 30px;
            font-family: 'FontAwesome';
        }

        .contenedor-central {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            /* Asegurarse de que ocupe todo el ancho disponible */
        }

        table {
            border-collapse: collapse;
            width: 80%;
            font-family: Arial, Helvetica, sans-serif;
            /* Ajusta según necesites */
            margin: 20px auto;
            /* Centra horizontalmente */
            text-align: center;
            /* Centra el contenido de las celdas */
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            /* Asegura que el texto esté centrado */
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .btn-volver {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            /* Centra horizontalmente */
        }

        .btn-volver:hover {
            background-color: #45a049;
        }

        h1 {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;
            text-align: center;
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
            <p>Usuarios</p>
        </div>
    </header>
    <br><br><br><br>
    <h1>Usuarios Registrados</h1><br>
    <div class="contenedor-central">
    <a href="PHP/generar_reporte_txt.php" class="reporte">  
    <div class="reporte">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                <path
                    d="M320-240h320v-80H320v80Zm0-160h320v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z" />
            </svg>
            <p>Descargar Reporte</p>
        </div></a> <br><br>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Nombre Completo</th>
                    <th>Correo Institucional</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['matricula']; ?></td>
                        <td><?php echo $usuario['nombre_completo']; ?></td>
                        <td><?php echo $usuario['correo_institucional']; ?></td>
                        <td>
                            <form action="PHP/eliminar_usuario.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id']; ?>">
                                <button type="submit"
                                    onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</button>
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="InicioAdmin.php" class="btn-volver">Volver al Panel</a>
    </div>
    <script>
        document.getElementById('redirect-home').addEventListener('click', function () {
            window.location.href = 'InicioAdmin.php'; // Cambia 'index.php' por la ruta a tu página de inicio
        });
    </script>
</body>

</html>