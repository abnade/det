<?php
include_once('connection/conJSON.php');


$EQUIPO=$_POST['EQUIPO'];
$CODIGO_RIESGO=$_POST['CODIGO_RIESGO'];

$CLAVE_EQUIPO=$_POST['CLAVE_EQUIPO'];
$NIVEL_MTTO=$_POST['NIVEL_MTTO'];	


$sql_insert="INSERT INTO catalogo_equipos(EQUIPO, CODIGO_RIESGO, CLAVE_EQUIPO, NIVEL_MTTO) VALUES ('$EQUIPO', '$CODIGO_RIESGO', '$CLAVE_EQUIPO','$NIVEL_MTTO')";

$row_insert=setArraySQL($sql_insert);

 echo json_encode($row_insert);


?>