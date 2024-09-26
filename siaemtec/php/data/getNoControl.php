
<?php require_once('../connection/conJSON.php');

 ?>
<?php
// get the q parameter from URL
$DP=$_GET["DP"];//Demostracion permanente
$ID_EQUIPO= $_GET["ID_EQUIPO"];
$ID_AREA= $_GET["ID_UBICACION"];
/* datos de clave del equipo*/
$connection=connectDB();

$q_kequipo="SELECT CLAVE_EQUIPO FROM catalogo_equipos WHERE ID_EQUIPO='$ID_EQUIPO' ";

$row_kequipo= getArraySQL($q_kequipo);
/* datos de clave del area*/

$q_areas="SELECT CODIGO_SERVICIO , CODIGO_AREA FROM areasinventario WHERE ID_AREA='$ID_AREA' ";

$row_areas=getArraySQL($q_areas);
if($DP=='DP-')
{
$CODIGO=$DP.$row_areas[0]["CODIGO_SERVICIO"].'-'.$row_kequipo[0]["CLAVE_EQUIPO"];}
else{
$CODIGO=$DP.$row_areas[0]["CODIGO_AREA"].'-'.$row_areas[0]["CODIGO_SERVICIO"].'-'.$row_kequipo[0]["CLAVE_EQUIPO"];	
	}

$query_equipo = "SELECT * FROM equipoinventario WHERE NO_CONTROL LIKE '%$CODIGO%' ORDER BY NO_CONTROL DESC LIMIT 1"; // SELECT * FROM `equipoinventario` WHERE `NO_CONTROL` LIKE '%OR-QUI-FNLA%' ORDER BY `NO_CONTROL` DESC LIMIT 1


$row_equipo = getArraySQL($query_equipo);
$totalRows_equipo = count($row_equipo);

if ($totalRows_equipo==0){
$n=1	;
	}
else{
	$frag=explode("-",$row_equipo[0]['NO_CONTROL']);
	
	$n=(int)$frag[3]+1;
//$n=$totalRows_equipo+1;
}

if ($n<10){
$n='0'.$n;	
}
//return $CODIGO.'-'.$n;
echo $CODIGO.'-'.$n;
//echo '<input name="NO_CONTROL" id="NO_CONTROL" type="text"'. 'value="'.$CODIGO.'-'.$n. '" size="32"  readonly="readonly" class="disabled-siaem"/>';

?> 
