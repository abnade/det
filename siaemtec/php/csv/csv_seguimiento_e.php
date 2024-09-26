<?php
include_once('../connection/conJSON.php');
// filename for export
$array='';

if(isset($_POST['array'])) {
    $array = $_POST['array'];
} else {
    $array = '';
}

$array = str_replace ( "[", '(', $array);
$array = str_replace ( "]", ')', $array); 

$sql = "SELECT orden_servicio.FUERA_SERVICIO AS FUERA_SERVICIO,
        (case orden_servicio.FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA'
		when 'PARCIALMENTE' then 'PARCIALMENTE' else 'FUNCIONA' end) AS EDO_FUNCIONAL_EQUIPO, 			orden_servicio.NOCONTROL, orden_servicio.EQUIPO, orden_servicio.MARCA, orden_servicio.MODELO, orden_servicio.SERIE, orden_servicio.ID_AREA, orden_servicio.AREA_SERVICIO, year(orden_servicio.FECHA_REPORTE) AS ANIO, servicio_evento.ESTADO, servicio_evento.FECHA_SOLICITUD_SIT, servicio_evento.FECHA_SOLICITUD_ADM, servicio_evento.FECHA_AUTORIZACION, servicio_evento.COSTO_MTTO, servicio_evento.NO_SOLICITUD_ADM, servicio_evento.ORDEN_SERVICIO, servicio_evento.COMENTARIOS, servicio_evento.TIPO_SERVICIO_EVENTO, servicio_evento.ID_SERVICIO_EVENTO FROM orden_servicio, servicio_evento WHERE orden_servicio.NO_ORDEN = servicio_evento.ORDEN_SERVICIO AND ID_SERVICIO_EVENTO IN 
".$array;
$data=[];


$inventario=getArraySQL($sql);
$arraykeys=array_keys($inventario[0]);

$field = sizeof($arraykeys);
$data[]=$arraykeys;

$j=1;
foreach($inventario as $equipo){
    
    for($i = 0; $i < $field; $i++) {
    $data[$j][$i]= $equipo[$arraykeys[$i]];
}
    $j=$j+1;
   
}

echo json_encode ($data);

?>