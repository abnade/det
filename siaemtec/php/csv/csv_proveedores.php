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

$sql="SELECT ID_PROVEEDOR, PROVEEDOR, MARCAS, EQUIPOS, DIRECCION,ESTADO_REPUBLICA, CONTACTO1 AS CONTACTO_VENTA, TELEFONO1 AS TEL_VENTA, EMAIL1 AS EMAIL_VENTA, CONTACTO2 AS CONTACTO_SERVICIO, TELEFONO2 AS TEL_SERVICIO, EMAIL2 AS EMAIL_SERVICIO, CONTACTO3 AS CONTACTO_CONTRATOS, TELEFONO3 AS TEL_CONTRATOS, EMAIL3 AS EMAIL_CONTRATOS FROM proveedores WHERE ESTADO='ACTIVO' AND ID_PROVEEDOR IN ".$array. " ORDER BY PROVEEDOR ASC";
// query to get data from database
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