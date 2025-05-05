<?php

if(isset($_SESSION['usuario'])){
    header("Location: InicioComunphu.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Comunphu</title>
    <link rel="stylesheet" href="css/inicioyregistro.css" />
</head>
<body><br><br><br><br><br>
    <section id="contenedorPrincipal">
        <img class="logo1" src="fotos y videos comunphu/inicioletras.png" alt="logo1">
        <a href="Iniciarsesion.php"> <button type="button">Iniciar Sesión</button></a>
        <br><br>
        <a href="RegistroComunphu.php"> <button type="button">Registro</button></a>
    </section><br><br><br>

</body>
</html>
