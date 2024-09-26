<?php
include_once('connection/conJSON.php');
$ID_DOCUMENTO=$_POST['ID_DOCUMENTO'];


// archivo temporal (ruta y nombre).
$binario_nombre_temporal=$_FILES['PATH']['tmp_name'] ;

// leer del archvio temporal .. el binario subido.
// "rb" para Windows .. Linux parece q con "r" sobra ...
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

// Obtener del array FILES (superglobal) los datos del binario .. nombre, tabamo y tipo.
$nombre=$_FILES['PATH']['name'];
$peso=$_FILES['PATH']['size'];
$tipo=$_FILES['PATH']['type'];
$destino =  "../documentos/".$TIPO_DOCUMENTO."/".$nombre;


copy($binario_nombre_temporal,$destino);
//
$hostname_connection = "localhost";
$database_connection = "siaem";
$username_connection = "root";
$password_connection = "";
$conexion = mysqli_connect($hostname_connection, $username_connection, $password_connection, $database_connection) or trigger_error(mysqli_error(),E_USER_ERROR); 



    $sql="UPDATE documentos SET PATH='$destino'  WHERE ID_DOCUMENTO='$ID_DOCUMENTO'";

    $response= updateArraySQL($sql);

    echo json_encode($response);

?>