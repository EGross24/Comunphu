<?php

include 'conexion_be.php';

$matricula = $_POST['matricula'];
$nombre_completo = $_POST['nombre_completo'];
$correo_institucional = $_POST['correo_institucional'];
$contraseña = $_POST['contraseña'];

//encriptar password
// $contraseña = hash('Sha512', $contraseña);

$query = "INSERT INTO usuarios(matricula, nombre_completo, correo_institucional, contraseña) 
          VALUES('$matricula', '$nombre_completo', '$correo_institucional', '$contraseña')";

//verificar que el correo no se repita en la base de datos
$verificar_correo =mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo_institucional='$correo_institucional' ");

if (mysqli_num_rows($verificar_correo) > 0 ){
    echo '
    <script>
    alert("Este correo ya está registrado, intente con otro diferente.");
    window.location = "../Index.php";
    </script>';
    exit();
}

// Verificar que la matricula no se repita en la base de datos
$verificar_matricula = mysqli_query($conexion, "SELECT * FROM usuarios WHERE matricula='$matricula' ");

if (mysqli_num_rows($verificar_matricula) > 0 ){
    echo '
    <script>
    alert("Esta matricula ya está registrada, intente con otra diferente.");
    window.location = "../Index.php";
    </script>';
    exit();
}

$ejecutar = mysqli_query($conexion, $query);                        

if($ejecutar){
    echo '
        <script>
           alert("¡Usuario almacenado exitosamente!");
           window.location = "../Index.php";
           </script>';}
else{
    echo '
        <script>
           alert("Fallo al almacenar usuario. Inténtelo nuevamente.");
           window.location = "../Index.php";
           </script>';}          
           
mysqli_close($conexion);
?>