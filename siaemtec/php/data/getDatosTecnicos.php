<?php
include_once('../connection/conJSON.php');

$ID_EQUIPO=$_GET['ID_EQUIPO'];

$sql="SELECT * FROM catalogo_equipos   WHERE ID_EQUIPO='$ID_EQUIPO'";

$equipo= getArraySQL($sql);

echo json_encode($equipo);
?>