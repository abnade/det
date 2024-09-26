<?php
include_once('connection/conJSON.php');

$total=$_POST['total'];

$ID_EQUIPO_INVENTARIO=$_POST['IDEQUIPO'];

$sql_equipo="SELECT * FROM equipoinventario WHERE ID_EQUIPO_INVENTARIO='$ID_EQUIPO_INVENTARIO'";

$row_equipo=getArraySQL($sql_equipo);

$ID_EQUIPO=$row_equipo[0]['ID_EQUIPO']; 

$EQUIPO=$row_equipo[0]['EQUIPO'];
$MODELO=$row_equipo[0]['MODELO'];
$MARCA=$row_equipo[0]['MARCA'];
$NO_INVENTARIO=$row_equipo[0]['NO_INVENTARIO'];
$ID_AREA=$row_equipo[0]['ID_AREA'];
$AREA=$row_equipo[0]['AREA'];
$SERVICIO=$row_equipo[0]['SERVICIO'];
$CUERPO=$row_equipo[0]['CUERPO'];
$ID_PROVEEDOR=$row_equipo[0]['ID_PROVEEDOR'];
$PROVEEDOR=$row_equipo[0]['PROVEEDOR'];
$FECHA_DE_INSTALACION=$row_equipo[0]['FECHA_DE_INSTALACION'];
$ESTADO=$row_equipo[0]['ESTADO'];
$PROPIEDAD=$row_equipo[0]['PROPIEDAD'];
$PRECIO=$row_equipo[0]['PRECIO'];
$FECHA_CREACION=$row_equipo[0]['FECHA_CREACION'];
$APARTIRDE=$row_equipo[0]['APARTIRDE'];
$GARANTIA=$row_equipo[0]['GARANTIA'];
$COMPRA_POR=$row_equipo[0]['COMPRA_POR'];
$CONVENIO_EVENTO=$row_equipo[0]['CONVENIO_EVENTO']; 
$PARTIDA=$row_equipo[0]['PARTIDA']; 
$NOTAS=$row_equipo[0]['NOTAS'];
$FECHA_COMPRA=$row_equipo[0]['FECHA_COMPRA'];
$VIDA_UTIL=$row_equipo[0]['VIDA_UTIL'];




for ($i = 1; $i <= $total; $i++) {
    $CONTROL=$_POST['CONTROL_'.$i];
    $SERIE=$_POST['SERIE_'.$i];
    
   $sql_insert="INSERT INTO equipoinventario(NO_CONTROL, ID_EQUIPO, EQUIPO, MODELO, SERIE, MARCA, NO_INVENTARIO, ID_AREA, AREA, SERVICIO, CUERPO,ID_PROVEEDOR, PROVEEDOR, FECHA_DE_INSTALACION, ESTADO, PROPIEDAD, PRECIO, FECHA_CREACION, APARTIRDE, GARANTIA, COMPRA_POR, CONVENIO_EVENTO, PARTIDA, NOTAS, FECHA_COMPRA, VIDA_UTIL) VALUES ('$CONTROL', '$ID_EQUIPO', '$EQUIPO','$MODELO', '$SERIE', '$MARCA', '$NO_INVENTARIO', '$ID_AREA', '$AREA', '$SERVICIO', '$CUERPO','$ID_PROVEEDOR', '$PROVEEDOR', '$FECHA_DE_INSTALACION', '$ESTADO', '$PROPIEDAD', '$PRECIO', '$FECHA_CREACION','$APARTIRDE', '$GARANTIA', '$COMPRA_POR', '$CONVENIO_EVENTO', '$PARTIDA', '$NOTAS', '$FECHA_COMPRA', '$VIDA_UTIL')";

     $row_insert=setArraySQL($sql_insert);
     

}



 echo json_encode($row_insert);


?>