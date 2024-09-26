<?php
include_once('../connection/conJSON.php');

$ID_AREA=$_GET['IDAREA'];

$sql="SELECT * FROM areasinventario  WHERE ID_AREA='$ID_AREA'";

$equipo=     getArraySQL($sql);

echo json_encode($equipo);
?>