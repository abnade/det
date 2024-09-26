<?php 
require_once('../connection/conJSON.php'); 

$sql ="SELECT equipoinventario.ID_EQUIPO_INVENTARIO,equipoinventario.NO_CONTROL, equipoinventario.EQUIPO, equipoinventario.MODELO, equipoinventario.SERIE, equipoinventario.MARCA, equipoinventario.NO_INVENTARIO, equipoinventario.ESTADO, areasinventario.AREA AS UBICACION, areasinventario.SERVICIO, catalogo_subdirecciones.subdireccion FROM equipoinventario, areasinventario, catalogo_subdirecciones WHERE equipoinventario.ID_AREA = areasinventario.ID_AREA AND areasinventario.catalogo_subdireccion_id =catalogo_subdirecciones.id"; /*"SELECT ID_EQUIPO_INVENTARIO, NO_CONTROL, ID_EQUIPO, EQUIPO, MARCA, MODELO, SERIE,  NO_INVENTARIO, SERVICIO, AREA AS UBICACION, CUERPO, EXTENSION, ID_PROVEEDOR, PROVEEDOR, FECHA_DE_INSTALACION, ESTADO, PROPIEDAD, PRECIO, FECHA_CREACION, GARANTIA, COMPRA_POR, CONVENIO_EVENTO, PARTIDA, NOTAS, YEAR(CURDATE())-YEAR(FECHA_COMPRA) AS ANTIGUEDAD, FECHA_COMPRA, VIDA_UTIL, FECHA_BAJA, NO_ORDEN, ESTADO_FUNCIONAL, CONCAT('<a id= ',ESTADO_FUNCIONAL, '  class=',ESTADO_FUNCIONAL,''
,' >',ESTADO_FUNCIONAL,'</a>') AS EDO_ORDEN, case FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA' when 'PARCIALMENTE' then 'PARCIALMENTE' else 'NO DISPONIBLE' end as EDO_FUNCIONAL_EQUIPO, case FUERA_SERVICIO when 'SI' then '1' when 'NO' then '2' when 'PARCIALMENTE' then '3' else '0' end as EDO_F FROM inventariovw1   ORDER BY ID_EQUIPO_INVENTARIO DESC " ;*/

$myarray=getArraySQL($sql);

echo '{"data":'.json_encode($myarray).'}';