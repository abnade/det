<?php
include_once('connection/conJSON.php');
//error_reporting(E_ALL);

$NO_ORDEN=$_POST['NO_ORDEN'];
//$NOCONTROL=$_POST['NOCONTROL'];
$DICTAMEN_TECNICO_DE=$_POST['DICTAMEN_TECNICO_DE'];
$ID_EQUIPO_INVENTARIO=$_POST['ID_EQUIPO_INVENTARIO'];
$ACCESORIOS_ADICIONALES=$_POST['ACCESORIOS_ADICIONALES'];
$ANIOS_USO=$_POST['ANTIGUEDAD'];
$FECHA_DICTAMEN=$_POST['FECHA_DICTAMEN'];
$ELABORADO_POR=$_POST['ELABORADO_POR'];
$JEFEDEAREA=$_POST['JEFEDEAREA'];
$subdirector=$_POST['subdirector'];
$DICTAMEN=$_POST['DICTAMEN'];

$sql_orden="SELECT ID_ORDEN_SERVICIO FROM orden_servicio WHERE NO_ORDEN='$NO_ORDEN'";
$orden=getArraySQL($sql_orden);
$ID_ORDEN=$orden[0]['ID_ORDEN_SERVICIO'];

$pre='IB'.date('y');
$query_dictamen = "SELECT COUNT(*) AS TOTAL FROM dictamenes WHERE NO_DICTAMEN LIKE '%$pre%'";

$dictamen = getArraySQL($query_dictamen);
$totalRows_dictamen = $dictamen[0]['TOTAL'];
$No_dictamen=$totalRows_dictamen+1;
if($No_dictamen<10){$pre='IB'.date('y').'00';}
elseif ($No_dictamen>=10 && $No_dictamen<100){$pre='IB'.date('y').'0';}
elseif ($No_dictamen>=100 && $No_dictamen<1000){$pre='IB'.date('y').'';}


$NO_DICTAMEN=$pre.$No_dictamen;
/*Verificar si existe el numero de dictamen*/
$sql_ds="SELECT COUNT(*) AS TOTAL FROM dictamenes WHERE NO_DICTAMEN='$NO_DICTAMEN'";

$dictamenes=getArraySQL($sql_ds);

while($dictamenes[0]['TOTAL']!=0){
    $No_dictamen=$No_dictamen+1;
    $NO_DICTAMEN=$pre.$No_dictamen;
    $sql_ds="SELECT COUNT(*) AS TOTAL FROM dictamenes WHERE NO_DICTAMEN='$NO_DICTAMEN'";
    $dictamenes=getArraySQL($sql_ds);
}

/*Verificar si el equipo esta en dictamen*/
$sql_d="SELECT ESTADO FROM equipoinventario WHERE ID_EQUIPO_INVENTARIO='$ID_EQUIPO_INVENTARIO'";
$d=getArraySQL($sql_d);
$edo=$d[0]['ESTADO'];
/**/
/*if($edo=="DICTAMEN"){ }else{*/
/*Si no esta en dictamen hacer dictamen*/

if($DICTAMEN_TECNICO_DE=='EQUIPO'):
    
    $set_dictamen="UPDATE equipoinventario SET ESTADO='DICTAMEN' WHERE ID_EQUIPO_INVENTARIO='$ID_EQUIPO_INVENTARIO'";
     $s_d=updateArraySQL($set_dictamen);

    /*elseif($DICTAMEN_TECNICO_DE=='EQUIPO SINIESTRADO'):
    
    $set_dictamen="UPDATE equipoinventario SET ESTADO='DICTAMEN' WHERE ID_EQUIPO_INVENTARIO='$ID_EQUIPO_INVENTARIO'";
      $s_d=updateArraySQL($set_dictamen);*/
else:
    $set_dictamen="UPDATE equipoinventario SET ESTADO='ACTIVO' WHERE ID_EQUIPO_INVENTARIO='$ID_EQUIPO_INVENTARIO'";
      $s_d=updateArraySQL($set_dictamen);
endif;

$sql="INSERT INTO dictamenes (NO_DICTAMEN, FECHA_DICTAMEN,ID_ORDEN, NO_ORDEN, DICTAMEN_TECNICO_DE, ANIOS_USO, DICTAMEN, ELABORADO_POR, JEFEDEAREA, subdirector) VALUES ('$NO_DICTAMEN', '$FECHA_DICTAMEN','$ID_ORDEN','$NO_ORDEN', '$DICTAMEN_TECNICO_DE', '$ANIOS_USO', '$DICTAMEN', '$ELABORADO_POR', '$JEFEDEAREA', '$subdirector')";

    $row_insert=setArraySQL($sql);
   // echo $sql;
//}
echo ('NO_DICTAMEN='.$NO_DICTAMEN.'&NO_ORDEN='.$NO_ORDEN);
?>