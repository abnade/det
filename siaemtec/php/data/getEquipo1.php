<?php
include_once('../connection/conJSON.php');

$ID_EQUIPO_INVENTARIO=$_GET['ID_EQUIPO_INVENTARIO'];

$sql="SELECT inventario_areasvw2.ID_EQUIPO_INVENTARIO, inventario_areasvw2.NO_CONTROL, inventario_areasvw2.ID_EQUIPO, inventario_areasvw2.ID_AREA, inventario_areasvw2.EQUIPO, inventario_areasvw2.MARCA, inventario_areasvw2.MODELO, inventario_areasvw2.SERIE,  inventario_areasvw2.NO_INVENTARIO, inventario_areasvw2.SERVICIO, inventario_areasvw2.AREA AS UBICACION FROM inventario_areasvw2 WHERE ID_EQUIPO_INVENTARIO='$ID_EQUIPO_INVENTARIO'";

$equipo=     getArraySQL($sql);

echo json_encode($equipo);
?>