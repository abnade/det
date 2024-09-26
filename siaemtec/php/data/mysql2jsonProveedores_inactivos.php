<?php 
include_once('../connection/conJSON.php');
//ini_set('memory_limit','1600M');
//$sql = "SELECT * FROM proveedores WHERE ESTADO='ACTIVO' ORDER BY PROVEEDOR  ASC " ;	
$a='user';
$b='phone';
$c='mail';

$sql = "SELECT ID_PROVEEDOR, PROVEEDOR, MARCAS, EQUIPOS, CONCAT('<b>Contacto Venta: </b>','<span data-feather=".$a."></span>' ,COALESCE(CONTACTO1,''), ',<span data-feather=".$b."></span>',COALESCE(TELEFONO1,' '), ',<span data-feather=".$c."></span>',COALESCE(EMAIL1, ' ') , '</br><b>Contacto Servicio: </b>', '<span data-feather=".$a."></span>', COALESCE(CONTACTO2,''), ',<span data-feather=".$b."></span>', COALESCE(TELEFONO2,' '), ',<span data-feather=".$c."></span>', COALESCE(EMAIL2, ' ') , '</br><b>Contacto Contratos: </b>', '<span data-feather=".$a."></span>', COALESCE(CONTACTO3,''), ', <span data-feather=".$b."></span>', COALESCE(TELEFONO3,' '), ', <span data-feather=".$c."></span>', COALESCE(EMAIL3, ' ')) AS CONTACTO FROM proveedores WHERE ESTADO!='ACTIVO' ORDER BY PROVEEDOR ASC" ;	
        $myArray = getArraySQL($sql);
		$número_filas = count($myArray);
        echo  '{"data":'. json_encode($myArray).'}';
		/*echo  ',"queryRecordCount":'. $número_filas;
		echo  ',"totalRecordCount":'. $número_filas. '}';*/
?>