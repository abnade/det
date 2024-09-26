<?php
include_once('../connection/conJSON.php');

$ID_EQUIPO=$_GET['NO_CONTROL'];

$sql="SELECT  NO_CONTROL, YEAR(CURDATE())-YEAR(FECHA_COMPRA) AS ANTIGUEDAD, SERVICIO, AREA, CUERPO, SERIE, MARCA, MODELO  FROM inventariovw1  WHERE NO_CONTROL='$NO_CONTROL'";

$anios=     getArraySQL($sql);

echo json_encode($anios);
?>