<?php 
ini_set('memory_limit','1600M');
include ('../connection/conJSON.php');
$sql = "SELECT orden_servicio.NO_ORDEN, CONCAT('<a id= ',orden_servicio.ESTADO, '  class=',orden_servicio.ESTADO,''
,' >',orden_servicio.ESTADO,'</a>') AS ESTADO, orden_servicio.NOCONTROL, orden_servicio.EQUIPO, orden_servicio.SERIE, areasinventario.SERVICIO AS UBICACION, areasinventario.AREA AS SERVICIO, orden_servicio.FALLA_REPORTE, orden_servicio.DETALLE_SERVICIO, orden_servicio.ING_RECIBE FROM orden_servicio, equipoinventario, areasinventario WHERE orden_servicio.ID_EQUIPO = equipoinventario.ID_EQUIPO_INVENTARIO and equipoinventario. ID_AREA=areasinventario. ID_AREA";
  



        $myArray = getArraySQL($sql);
		$número_filas = count($myArray);
        echo  '{"data":'. json_encode($myArray).'}';
		/*echo  ',"queryRecordCount":'. $número_filas;
		echo  ',"totalRecordCount":'. $número_filas. '}';*/
?>