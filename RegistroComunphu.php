<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro comunphu</title>
    <link rel="stylesheet" href="css/inicioyregistro.css">
</head>
<body>
    <br><br><br>
    <section id="contenedorPrincipalreg">
        <img class="logoreg" src="fotos y videos comunphu/logoregistro.png" alt="logoreg"><br>
        <div class="contenedorregistro">
            <form id="formreg" action="PHP/registro_usuario_be.php" method="POST">
                <div id="divideform">    
                    <div class="formleft">
                        <label for="matricula">Matrícula</label>
                        <input type="text" id="matricula" name="matricula" placeholder="ej: er23-0430" required pattern="^[a-z]{2}\d{2}-\d{4}$" title="Matrícula er23-0430"><br>
                        <label for="nombre_completo">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre_completo" placeholder="ej: Emily Mariel Rosario Gross" required>
                    </div><br>
                    <div class="formright">  
                        <label for="correo_institucional">Correo Institucional</label>  
                        <input type="email" id="email" name="correo_institucional" placeholder="er23-0430@unphu.edu.do" required><br>
                        <label for="contraseña">Contraseña</label>     
                        <input type="password" id="contraseña" name="contraseña" placeholder="......." required>
                    </div>
                </div><br><br>
                <div class="wrap">
                    <button type="submit">Registrarse</button>
                </div><br><br>
            </form>
        </div>
    </section><br><br><br>
</body>
</html>