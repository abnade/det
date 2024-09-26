<?php

include_once('connection/conJSON.php');

$idreporte=$_GET["idreporte"];
$val=$_GET["val"];
if (isset($_GET['atendio'])) {
$atendio=$_GET["atendio"];}else{
    $atendio="";
}


$sql = "UPDATE reportes SET ATENDIDO='$val', ATENDIO='$atendio' WHERE ID_REPORTE='$idreporte'";

$row_insert=setArraySQL($sql);
echo json_encode($row_insert);

?>