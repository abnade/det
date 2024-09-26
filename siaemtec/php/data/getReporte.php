<?php
include_once('../connection/conJSON.php');

$ID_REPORTE=$_GET['ID_REPORTE'];

$sql="SELECT * FROM reportes  WHERE ID_REPORTE='$ID_REPORTE'";

$equipo=     getArraySQL($sql);

echo json_encode($equipo);
?>