<?php
include_once('../connection/conJSON.php');

$NO_CONTROL=$_GET['NO_CONTROL'];

$sql="SELECT * from documentos WHERE EQUIPOSnoc like '%$NO_CONTROL%'";

$equipo=     getArraySQL($sql);

echo json_encode($equipo);
?>