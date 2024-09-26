<?php 
$TIPO_DOCUMENTO=$_POST['TIPO_DOCUMENTO'];
$EQUIPOSid = $_POST['EQUIPOSid'];
$EQUIPOSrow= explode(',',$EQUIPOSid);
$EQUIPOSnoc= $_POST['EQUIPOSnoc'];
$EQUIPOSnoc= json_decode($EQUIPOSnoc); 
$EQUIPOSnoc= array_column($EQUIPOSnoc,'text');
$EQUIPOSnoc= implode(",", $EQUIPOSnoc);


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

//
$sql = "INSERT INTO documentos (PATH, TIPO, EQUIPOSnoc,EQUIPOS) VALUES ('$destino','$TIPO_DOCUMENTO','$EQUIPOSnoc','$EQUIPOSid')";
$res=mysqli_query($conexion,$sql) or die("No se pudo insertar los datos en la base de datos.");

$id=mysqli_insert_id($conexion);

$values=array();
$row= array();

foreach ($EQUIPOSrow as $valor) {
    
array_push($row,$valor,$id, $TIPO_DOCUMENTO);
    $values[ ]= $row ;
    $row=[];
    
}

//echo json_encode($values);

$sql_aceptacion="INSERT INTO equipo_has_documento(EQUIPO_IDEQUIPO,DOCUMENTO_IDDOCUMENTO,TIPO) VALUES";

foreach ($values as $val){
    $sql_aceptacion.="(".$val[0].','.$val[1].','.$val[2]."),";
    
}

    $sql_aceptacion= trim($sql_aceptacion, ',');

$res=mysqli_query($conexion,$sql_aceptacion) or die("No se pudo insertar los datos en la base de datos.");
// si ha ido todo bien*/
/*exit;*/

echo json_encode($res); 
?>