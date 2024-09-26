<?php
include_once('../connection/conJSON.php');
$sql="SELECT TIMESTAMPDIFF(YEAR, FECHA_COMPRA, CURDATE()) AS ANTIGUEDAD FROM equipoinventario GROUP BY ANTIGUEDAD ORDER BY ANTIGUEDAD ASC";

$ANTIGUEDAD=     getArraySQL($sql);

echo json_encode($ANTIGUEDAD);
?>