<?php
include_once('../connection/conJSON.php');

$ID_EQUIPO_INVENTARIO=$_GET['ID_EQUIPO_INVENTARIO'];

$sql="SELECT inventariovw1.ID_EQUIPO_INVENTARIO, inventariovw1.NO_CONTROL, inventariovw1.ID_EQUIPO, inventariovw1.EQUIPO, inventariovw1.MARCA, inventariovw1.MODELO, inventariovw1.SERIE,  inventariovw1.NO_INVENTARIO, inventariovw1.SERVICIO, inventariovw1.AREA AS UBICACION, inventariovw1.CUERPO, inventariovw1.EXTENSION,YEAR(CURDATE())-YEAR(inventariovw1.FECHA_COMPRA) AS ANTIGUEDAD, inventariovw1.ID_PROVEEDOR, inventariovw1.PROVEEDOR, inventariovw1.FECHA_DE_INSTALACION, inventariovw1.ESTADO, inventariovw1.PROPIEDAD, inventariovw1.PRECIO, inventariovw1.FECHA_CREACION, inventariovw1.APARTIRDE, inventariovw1.GARANTIA, inventariovw1.COMPRA_POR, inventariovw1.CONVENIO_EVENTO, inventariovw1.PARTIDA,inventariovw1.OBSOLESCENCIA,inventariovw1.catalogo_subdireccion_id ,inventariovw1.NOTAS, YEAR(CURDATE())-YEAR(inventariovw1.FECHA_COMPRA) AS ANTIGUEDAD, inventariovw1.FECHA_COMPRA, inventariovw1.VIDA_UTIL, inventariovw1.FECHA_BAJA, inventariovw1.NO_ORDEN, inventariovw1.ESTADO_FUNCIONAL AS EDO_ORDEN, case inventariovw1.FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA' when 'PARCIALMENTE' then 'PARCIALMENTE' else 'NO DISPONIBLE' end as EDO_FUNCIONAL_EQUIPO FROM inventariovw1   WHERE ID_EQUIPO_INVENTARIO='$ID_EQUIPO_INVENTARIO'";

$equipo=     getArraySQL($sql);

echo json_encode($equipo);
?>