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

$sql="SELECT  ID_AREA, SERVICIO, AREA AS UBICACION, CUERPO, CODIGO_SERVICIO AS CODIGO, CODIGO_AREA AS CENTROCOSTOS, EXTENSION, RESPONSABLE FROM areasinventario WHERE ID_AREA IN ".$array."ORDER BY ID_AREA DESC";
// query to get data from database
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