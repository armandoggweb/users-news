<?php
function conexion(){
    //Los parámetros necesarios para poder establecer la conexión con la base de datos
    $host = "localhost";
    $bd = "M07";
    $user = "root";
    $pass = "";

    $conexion = new mysqli($host, $user, $pass, $bd);

    //Mostramos un mensaje de error si no ha conseguido conectar con la base de datos
    if ($conexion->connect_error) {
        die('Error de Conexión (' . $conexion->connect_errno . ') '
                . $conexion->connect_error);
    }else{
        return $conexion;
    }
}
?>