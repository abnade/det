<?php
include_once('../connection/conJSON.php');



$sql="SELECT * FROM catalogo_subdirecciones order by direccion";

$ccostos=     getArraySQL($sql);

echo json_encode($ccostos);
?>