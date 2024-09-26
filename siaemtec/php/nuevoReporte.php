<?php
include_once('connection/conJSON.php');
date_default_timezone_set('America/Mazatlan');//Mexico_City
$FECHA=date("Y-m-d");//$_POST['FECHA'];
$HORA=date("H:i:s");//$_POST['HORA'];


$AREA_SERVICIO=$_POST['AREA_SERVICIO'];
$EQUIPO=$_POST['EQUIPO'];

$REPORTA=$_POST['REPORTA'];
$EXT=$_POST['EXT'];

$DESCRIPCION_REPORTE=$_POST['DESCRIPCION_REPORTE'];


$ASIGNADO=$_POST['ASIGNADO'];
$RECIBE_REPORTE=$_POST['RECIBE_REPORTE'];


$sql_insert="INSERT INTO reportes(FECHA, HORA, AREA_SERVICIO, EQUIPO, REPORTA, EXT, DESCRIPCION_REPORTE,  ASIGNADO, RECIBE_REPORTE) VALUES ('$FECHA','$HORA', '$AREA_SERVICIO', '$EQUIPO', '$REPORTA', '$EXT', '$DESCRIPCION_REPORTE',  '$ASIGNADO', '$RECIBE_REPORTE')";

$row_insert=setArraySQL($sql_insert);

 echo json_encode($row_insert);


?>