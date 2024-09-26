<?php

include_once('connection/conJSON.php');

$idreporte=$_GET["idreporte"];
$val=$_GET["val"];


$sql = "UPDATE reportes SET ATENDIDO='$val' WHERE ID_REPORTE='$idreporte'";

$row_insert=setArraySQL($sql);
echo json_encode($row_insert);

?>