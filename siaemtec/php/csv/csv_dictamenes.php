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
// query to get data from database
$sql = "SELECT orden_servicio.NOCONTROL, orden_servicio.NOINVENTARIO, orden_servicio.EQUIPO, orden_servicio.MARCA, orden_servicio.MODELO, orden_servicio.SERIE, equipoinventario.AREA AS SERVICIO, equipoinventario.SERVICIO AS UBICACION, orden_servicio.NO_ORDEN, dictamenes.NO_DICTAMEN, orden_servicio.FECHA_ATENCION AS FECHA_DICTAMEN, dictamenes.DICTAMEN_TECNICO_DE, dictamenes.ANIOS_USO, dictamenes.DICTAMEN, orden_servicio.ING_REALIZA AS ELABORADO_POR, dictamenes.RECIBE, dictamenes.JEFEDEAREA, dictamenes.EDO_DICTAMEN FROM orden_servicio, dictamenes, equipoinventario WHERE orden_servicio.NO_ORDEN=dictamenes.NO_ORDEN AND equipoinventario.NO_CONTROL=orden_servicio.NOCONTROL AND dictamenes.ID_DICTAMEN IN ".$array." ORDER BY `orden_servicio`.`FECHA_ATENCION` ASC";

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