<?php

include_once('connection/conJSON.php');

$ID_PROVEEDOR=$_GET["ID_PROVEEDOR"];



$sql = "UPDATE proveedores SET ESTADO='ACTIVO' WHERE ID_PROVEEDOR='$ID_PROVEEDOR'";

$row_insert=setArraySQL($sql);
echo json_encode($row_insert);

?>