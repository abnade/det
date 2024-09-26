
<?php require_once('../connection/conJSON.php');

 ?>
<?php
// get the q parameter from URL
$DP=$_GET["DP"];//Demostracion permanente
$ID_EQUIPO= $_GET["ID_EQUIPO"];
$ID_AREA= $_GET["ID_AREA"];
/* datos de clave del equipo*/
$connection=connectDB();
mysql_select_db($database_connection,);
$q_kequipo="SELECT CLAVE_EQUIPO FROM catalogo_equipos WHERE ID_EQUIPO='$ID_EQUIPO' ";
$kequipo=mysqli_query($connection,$q_kequipo);
$row_kequipo= mysqli_fetch_assoc($kequipo);
/* datos de clave del area*/

$q_areas="SELECT CODIGO_SERVICIO , CODIGO_AREA FROM areasinventario WHERE ID_AREA='$ID_AREA' ";
$areas=mysql_query($connection, $q_areas);
$row_areas=mysqli_fetch_assoc($areas);
if($DP=='DP-')
{
$CODIGO=$DP.$row_areas["CODIGO_SERVICIO"].'-'.$row_kequipo["CLAVE_EQUIPO"];}
else{
$CODIGO=$DP.$row_areas["CODIGO_AREA"].'-'.$row_areas["CODIGO_SERVICIO"].'-'.$row_kequipo["CLAVE_EQUIPO"];	
	}

$query_equipo = "SELECT * FROM equipoinventario WHERE NO_CONTROL LIKE '%$CODIGO%' ORDER BY NO_CONTROL DESC LIMIT 1"; // SELECT * FROM `equipoinventario` WHERE `NO_CONTROL` LIKE '%OR-QUI-FNLA%' ORDER BY `NO_CONTROL` DESC LIMIT 1

$equipo = mysqli_query($connection,$query_equipo) ;
$row_equipo = mysql_fetch_assoc($equipo);
$totalRows_equipo = mysqli_num_rows($equipo);

if ($totalRows_equipo==0){
$n=1	;
	}
else{
	$frag=explode("-",$row_equipo['NO_CONTROL']);
	
	$n=(int)$frag[3]+1;
//$n=$totalRows_equipo+1;
}

if ($n<10){
$n='0'.$n;	
}
return $CODIGO.'-'.$n;
//echo '<input name="NO_CONTROL" id="NO_CONTROL" type="text"'. 'value="'.$CODIGO.'-'.$n. '" size="32"  readonly="readonly" class="disabled-siaem"/>';

?> 
