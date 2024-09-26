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

$sql = "select requisiciones.ID_REQUISICION,
        (case orden_servicio.FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA'
		when 'PARCIALMENTE' then 'PARCIALMENTE' else 'FUNCIONA' end) AS EDO_FUNCIONAL_EQUIPO,
		orden_servicio.NOCONTROL AS NOCONTROL,orden_servicio.EQUIPO AS EQUIPO,orden_servicio.MARCA 
		AS MARCA,orden_servicio.MODELO AS MODELO,orden_servicio.SERIE AS SERIE,
		year(orden_servicio.FECHA_ATENCION) AS ANIO, equipoinventario.AREA AS SERVICIO,  equipoinventario.SERVICIO AS UBICACION,
		requisiciones.ORDEN_SERVICIO AS ORDEN_SERVICIO,
		requisiciones.REQUISICION_POR AS REQUISICION_POR, requisiciones.EDO_REQUISICION AS EDO_REQUISICION,
		requisiciones.FECHA_SOLICITUD_ALMACEN AS FECHA_SOLICITUD_ALMACEN,requisiciones.FECHA_SUMINISTRO AS FECHA_SUMINISTRO,
		requisiciones.NUM_F AS NUM_F,requisiciones.requisicion AS requisicion,requisiciones.TIPO_SEGUIMIENTO AS TIPO_SEGUIMIENTO,
		requisiciones.COMENTARIOS AS COMENTARIOS,requisiciones.REALIZO AS REALIZO from orden_servicio RIGHT join equipoinventario ON orden_servicio.ID_EQUIPO = equipoinventario.ID_EQUIPO_INVENTARIO		RIGHT join requisiciones on orden_servicio.NO_ORDEN = requisiciones.ORDEN_SERVICIO WHERE requisiciones.EDO_REQUISICION !='DUPLICADO' AND requisiciones.ID_REQUISICION IN 
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