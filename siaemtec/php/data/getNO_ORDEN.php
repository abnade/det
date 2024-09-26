<?php
include_once('../connection/conJSON.php');

$ID_ORDEN=$_GET['ID_ORDEN'];

$sql="SELECT NO_ORDEN FROM orden_servicio  WHERE ID_ORDEN_SERVICIO='$ID_ORDEN'";

$orden=    getArraySQL($sql);

echo json_encode($orden);
?>