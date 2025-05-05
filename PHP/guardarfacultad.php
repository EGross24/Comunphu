<?php

include 'conexion_be.php';

$nombre_facultad = $_POST['nombrefacultad'];

$query = "INSERT INTO facultades(nombrefacultad) 
          VALUES('$nombre_facultad')";

//verificar que la facultad no se repita en la base de datos
$verificar_facultad =mysqli_query($conexion, "SELECT * FROM facultades WHERE nombrefacultad='$nombre_facultad' ");

if (mysqli_num_rows($verificar_facultad) > 0 ){
    echo '
    <script>
    alert("Esta facultad ya está almacenada en la base de datos.");
    window.location = "../Facultades.php";
    </script>';
    exit();
}


$ejecutar = mysqli_query($conexion, $query);                        

if($ejecutar){
    echo '
        <script>
           alert("¡Facultad Almacenada exitosamente!");
           window.location = "../Facultades.php";
           </script>';}
else{
    echo '
        <script>
           alert("Fallo al almacenar facultad. Inténtelo nuevamente.");
           window.location = "../Facultades.php";
           </script>';}          
           
mysqli_close($conexion);
?>