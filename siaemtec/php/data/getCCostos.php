<?php
include_once('../connection/conJSON.php');



$sql="SELECT CENTRO_COSTOS FROM catalogo_centro_costos";

$ccostos=     getArraySQL($sql);

echo json_encode($ccostos);
?>