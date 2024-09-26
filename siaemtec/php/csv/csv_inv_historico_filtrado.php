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


$data=[];

$sql="SELECT ID_EQUIPO_INVENTARIO, NO_CONTROL, ID_EQUIPO, EQUIPO, MARCA, MODELO, SERIE, NO_INVENTARIO, SERVICIO, AREA AS UBICACION, CUERPO, EXTENSION, ID_PROVEEDOR, PROVEEDOR, FECHA_DE_INSTALACION, ESTADO, PROPIEDAD, PRECIO, FECHA_CREACION, GARANTIA, COMPRA_POR, CONVENIO_EVENTO, PARTIDA, NOTAS, FECHA_COMPRA, VIDA_UTIL, FECHA_BAJA, ESTADO_FUNCIONAL AS EDO_ORDEN, case FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA' when 'PARCIALMENTE' then 'PARCIALMENTE' else 'NO DISPONIBLE' end as EDO_FUNCIONAL_EQUIPO FROM inventariovw1 where ESTADO !='ACTIVO' AND NO_CONTROL IN ".$array." ORDER BY ID_EQUIPO_INVENTARIO DESC";
// query to get data from database


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