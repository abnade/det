<?php
include_once('../connection/conJSON.php');

$NO_ORDEN=$_GET['NO_ORDEN'];

$sql="SELECT * FROM orden_servicio  WHERE NO_ORDEN='$NO_ORDEN'";

$orden=     getArraySQL($sql);

echo json_encode($orden);
?>