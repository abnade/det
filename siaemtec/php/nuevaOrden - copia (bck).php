<?php
include_once('connection/conJSON.php');
error_reporting(E_ALL);
    
$ESTADO=$_POST['ESTADO'];
$TRANSITO_POR=$_POST['TRANSITO_POR'];
$ID_EQUIPO=$_POST['ID_EQUIPO'];
$NOCONTROL=$_POST['NOCONTROL'];
$NOINVENTARIO=$_POST['NOINVENTARIO'];
$EQUIPO=$_POST['EQUIPO'];
$MARCA=$_POST['MARCA'];
$MODELO=$_POST['MODELO'];
$SERIE=$_POST['SERIE'];
$ID_AREA=$_POST['ID_AREA'];

$ACCESORIOS_ADICIONALES=$_POST['ACCESORIOS_ADICIONALES'];
$ID_REPORTE=$_POST['ID_REPORTE'];
$FECHA_REPORTE=$_POST['FECHA_REPORTE'];
$HORA_REPORTE=$_POST['HORA_REPORTE'];
$NOMBRE_SOLICITANTE=$_POST['NOMBRE_SOLICITANTE'];

$EXTENSION=$_POST['EXTENSION'];

$FALLA_REPORTE=$_POST['FALLA_REPORTE'];
$DESCRIPCION_REPORTE=$_POST['DESCRIPCION_REPORTE'];

$ID_ING_RECIBE=$_POST['ING_RECIBE'];
$sql_ing_recibe="SELECT CONCAT(APELLIDOS, ' ', NOMBRES) as nombre FROM usuarios WHERE ID_USUARIOS='$ID_ING_RECIBE'";

$ing_recibe=getArraySQL($sql_ing_recibe);

if(count($ing_recibe)==0){ $ING_RECIBE=' ';}
else{$ING_RECIBE=$ing_recibe[0]['nombre'];}



$FECHA_SERVICIO=$_POST['FECHA_SERVICIO'];
$HORA=$_POST['HORA'];


if(isset($_POST['DETALLE_SERVICIO'])){

$DETALLE_SERVICIO=$_POST['DETALLE_SERVICIO'];
}else{
    $DETALLE_SERVICIO="NO APLICA";
}



$FUERA_SERVICIO=$_POST['FUERA_SERVICIO'];

$TIPO_EXTERNO=$_POST['TIPO_EXTERNO'];

$ID_ING_REALIZA=$_POST['ING_REALIZA'];

$sql_ing_realiza="SELECT CONCAT(APELLIDOS,' ', NOMBRES) as nombre FROM usuarios WHERE ID_USUARIOS='$ID_ING_REALIZA'";
$ing_realiza=getArraySQL($sql_ing_realiza);

if(count($ing_realiza)==0){ $ING_REALIZA=' ';}
else{$ING_REALIZA=$ing_realiza[0]['nombre'];}



$ING_EXTERNO=$_POST['ING_EXTERNO'];


if(isset($_POST['EMPRESA'])){
 $EMPRESA=$_POST['EMPRESA'];
}else{
    $EMPRESA="NO APLICA";
}

$FALLA_ENCONTRADA=$_POST['FALLA_ENCONTRADA'];

if(isset($_POST['OTRA_FALLA'])){
$OTRA_FALLA=$_POST['OTRA_FALLA'];
}else{
    $OTRA_FALLA="";
}

$REPARACION_REALIZADA=$_POST['REPARACION_REALIZADA'];
$HORAS_EMPLEADAS=$_POST['HORAS_EMPLEADAS'];
$COMENTARIOS=$_POST['COMENTARIOS'];
$REFACCIONES=$_POST['REFACCIONES'];
$FECHA_ENTREGA=$_POST['FECHA_ENTREGA'];
$HORA_ENTREGA=$_POST['HORA_ENTREGA'];

$ID_ING_SUPERVISA=$_POST['ING_SUPERVISA'];

$sql_ing_supervisa="SELECT CONCAT(APELLIDOS, ' ', NOMBRES) as nombre FROM usuarios WHERE ID_USUARIOS='$ID_ING_SUPERVISA'";
$ing_supervisa=getArraySQL($sql_ing_supervisa);

if(count($ing_supervisa)==0){ $ING_SUPERVISA=' ';}
else{$ING_SUPERVISA=$ing_supervisa[0]['nombre'];}

$ID_ING_ENTREGA=$_POST['ING_ENTREGA'];

$sql_ing_entrega="SELECT CONCAT(APELLIDOS,' ', NOMBRES) as nombre FROM usuarios WHERE ID_USUARIOS='$ID_ING_ENTREGA'";
$ing_entrega=getArraySQL($sql_ing_entrega);

if(count($ing_entrega)==0){ $ING_ENTREGA=' ';}
else{$ING_ENTREGA=$ing_entrega[0]['nombre'];}

$NOTA_IMPORTANTE=$_POST['NOTA_IMPORTANTE'];
$NOMBRE_RECIBE=$_POST['NOMBRE_RECIBE'];
$FECHA_ATENCION=$_POST['FECHA_ATENCION'];
$HORA_ATENCION=$_POST['HORA_ATENCION'];
$INSTRUMENTOS= $_POST['INSTRUMENTOS'];
 

 // Código para evitar duplicados en transito
  $transitoSQL="SELECT COUNT(*) AS TOTAL FROM orden_servicio WHERE NOCONTROL='$NOCONTROL' AND ESTADO='TRANSITO'";
  $transito=getArraySQL($transitoSQL);
//echo $transito[0]['TOTAL'];	
	//mysql_select_db($database_connection, $connection);
///***********CÓDIGO PARA VERIFICAR EVITAR DUPLICADOS***********///////
if($transito[0]['TOTAL']>=1 && $ESTADO=='TRANSITO'){
   $insertGoTo="Error1.php"; 
}else{ 
$pre='IB'.date('y');
$query_orden = "SELECT * FROM orden_servicio WHERE NO_ORDEN LIKE '%$pre%'";

$orden = getArraySQL($query_orden);
$totalRows_orden = count($orden);


/*-- --*/
$No_Orden=$totalRows_orden+1;
if($No_Orden<10){$pre='IB'.date('y').'00000';}
elseif ($No_Orden>=10 && $No_Orden<100){$pre='IB'.date('y').'0000';}
elseif ($No_Orden>=100 && $No_Orden<1000){$pre='IB'.date('y').'000';}
elseif ($No_Orden>=1000 && $No_Orden<10000){$pre='IB'.date('y').'00';}
elseif ($No_Orden>=10000 && $No_Orden<100000){$pre='IB'.date('y').'0';}
elseif ($No_Orden>=100000 && $No_Orden<1000000){$pre='IB'.date('y').'-';}

$NO_ORDEN=$pre.$No_Orden;

$query_orden = "SELECT * FROM orden_servicio WHERE NO_ORDEN='$NO_ORDEN'";
$orden =getArraySQL($query_orden);
$totalRows_orden = count($orden);	

while ($totalRows_orden!=0):

$No_Orden=$No_Orden+1;	
$NO_ORDEN=$pre.$No_Orden;
$query_orden = "SELECT * FROM orden_servicio WHERE NO_ORDEN='$NO_ORDEN'";
$orden = getArraySQL($query_orden);
$totalRows_orden = count($orden);

if ($totalRows_orden=0){ break;}	

endwhile;
    
/*------   Ingresar orden de servicio -----*/

$sqlOrden="INSERT INTO orden_servicio ( NO_ORDEN, ESTADO, TRANSITO_POR, ID_EQUIPO, NOCONTROL, NOINVENTARIO, EQUIPO, MARCA, MODELO, SERIE, ID_AREA, ACCESORIOS_ADICIONALES, ID_REPORTE, FECHA_REPORTE, HORA_REPORTE, NOMBRE_SOLICITANTE, EXTENSION, FALLA_REPORTE, DESCRIPCION_REPORTE, ID_ING_RECIBE, ING_RECIBE, FECHA_SERVICIO, HORA, DETALLE_SERVICIO, FUERA_SERVICIO, TIPO_EXTERNO, ID_ING_REALIZA,ING_REALIZA,ING_EXTERNO , EMPRESA, FALLA_ENCONTRADA, OTRA_FALLA, REPARACION_REALIZADA, HORAS_EMPLEADAS, COMENTARIOS, REFACCIONES, FECHA_ENTREGA, HORA_ENTREGA, ID_ING_SUPERVISA,ING_SUPERVISA, ID_ING_ENTREGA, ING_ENTREGA, NOTA_IMPORTANTE, NOMBRE_RECIBE, FECHA_ATENCION, HORA_ATENCION,INSTRUMENTOS) VALUES ('$NO_ORDEN', '$ESTADO', '$TRANSITO_POR', '$ID_EQUIPO', '$NOCONTROL', '$NOINVENTARIO', '$EQUIPO','$MARCA', '$MODELO', '$SERIE', '$ID_AREA', '$ACCESORIOS_ADICIONALES','$ID_REPORTE', '$FECHA_REPORTE', '$HORA_REPORTE', '$NOMBRE_SOLICITANTE', '$EXTENSION','$FALLA_REPORTE', '$DESCRIPCION_REPORTE','$ID_ING_RECIBE' ,'$ING_RECIBE', '$FECHA_SERVICIO', '$HORA','$DETALLE_SERVICIO', '$FUERA_SERVICIO','$TIPO_EXTERNO','$ID_ING_REALIZA' ,'$ING_REALIZA','$ING_EXTERNO', '$EMPRESA', '$FALLA_ENCONTRADA', '$OTRA_FALLA', '$REPARACION_REALIZADA', '$HORAS_EMPLEADAS', '$COMENTARIOS', '$REFACCIONES', '$FECHA_ENTREGA', '$HORA_ENTREGA','$ID_ING_SUPERVISA', '$ING_SUPERVISA','$ID_ING_ENTREGA' ,'$ING_ENTREGA', '$NOTA_IMPORTANTE', '$NOMBRE_RECIBE', '$FECHA_ATENCION', '$HORA_ATENCION','$INSTRUMENTOS')";


$rowOrden=setArraySQL($sqlOrden);


/*insertar requisicion o servicio por evento*/

if($ESTADO=='TRANSITO' && $TRANSITO_POR=='SERVICIO POR EVENTO'){
	/**/
	$insertSQLS = "INSERT INTO servicio_evento (ORDEN_SERVICIO) VALUES ('$NO_ORDEN')";
	
	$servicio_evento = setArraySQL($insertSQLS);
		
	
		}
else if($ESTADO=='TRANSITO' && $TRANSITO_POR=='REQUISICION'){
	$insertSQLR = "INSERT INTO requisiciones (ORDEN_SERVICIO) VALUES ('$NO_ORDEN')";

	$requisicion = setArraySQL($insertSQLR);
		}   


if ($DETALLE_SERVICIO == "DICTAMEN TECNICO") 
{
	// Verificar que no existan dictamenes con esta Orden

	
	
	$query_dictamen = "SELECT COUNT(*) AS TOTAL FROM dictamenes WHERE NO_ORDEN='$NO_ORDEN'";
		$dictamen = getArraySQL($query_dictamen);
	
		$totalRows_dictamen = $dictamen[0]['TOTAL'];
    
  /*	if($totalRows_dictamen==0){*/
      
        $EQUIPO=$_POST['EQUIPO'];
        $IDEQUIPO=$_POST['ID_EQUIPO'];
        $insertGoTo = "nuevoDictamen.html?NO_ORDEN=".$NO_ORDEN."&ID_EQUIPO_INVENTARIO=".$IDEQUIPO."&EQUIPO=".$EQUIPO;	/*}
 	 else{ // No hacer nada 
         $insertGoTo = "yatieneundictamenOrdenpdf.php?NO_ORDEN=".$NO_ORDEN;
  }*/
	
	} 

 else {
/*Sucede si Dictamen es igual a nulo*/
  $insertGoTo ="Ordenpdf.php?NO_ORDEN=".$NO_ORDEN;
  
  }  
    }	// fin del if 1

echo ($insertGoTo);
    
?>