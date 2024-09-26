<?php
// filename for export
$db_record = 'equipoinventario';
$csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';
// database variables
$hostname = "localhost";
$user = "root";
$password = "";
$database = "siaem";
// Database connecten voor alle services
mysql_connect($hostname, $user, $password)
or die('Could not connect: ' . mysql_error());
					
mysql_select_db($database)
or die ('Could not select database ' . mysql_error());
// create empty variable to be filled with export data
$csv_export = '';

if(isset($_GET['query'])) 
{
	
$query1=$_GET['query'];
//echo $query1;
	
$query = mysql_query($query1);	

//echo $query;
	}
/* vars for export */
// database record to be exported
else {
$db_record = 'equipoinventario';
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// query to get data from database
$query = mysql_query("select `inventario_areasvw1`.`ID_EQUIPO_INVENTARIO` AS `ID_EQUIPO_INVENTARIO`,`inventario_areasvw1`.`NO_CONTROL` AS `NO_CONTROL`,`inventario_areasvw1`.`ID_EQUIPO` AS `ID_EQUIPO`,`inventario_areasvw1`.`EQUIPO` AS `EQUIPO`,`inventario_areasvw1`.`MODELO` AS `MODELO`,`inventario_areasvw1`.`SERIE` AS `SERIE`,`inventario_areasvw1`.`MARCA` AS `MARCA`,`inventario_areasvw1`.`NO_INVENTARIO` AS `NO_INVENTARIO`,`inventario_areasvw1`.`SERVICIO` AS `SERVICIO`,`inventario_areasvw1`.`AREA` AS `AREA`,`inventario_areasvw1`.`CUERPO` AS `CUERPO`,`inventario_areasvw1`.`EXTENSION` AS `EXTENSION`,`inventario_areasvw1`.`ID_PROVEEDOR` AS `ID_PROVEEDOR`,`inventario_areasvw1`.`PROVEEDOR` AS `PROVEEDOR`,`inventario_areasvw1`.`FECHA_DE_INSTALACION` AS `FECHA_DE_INSTALACION`,`inventario_areasvw1`.`ESTADO` AS `ESTADO`,`inventario_areasvw1`.`PROPIEDAD` AS `PROPIEDAD`,`inventario_areasvw1`.`PRECIO` AS `PRECIO`,`inventario_areasvw1`.`FECHA_CREACION` AS `FECHA_CREACION`,`inventario_areasvw1`.`GARANTIA` AS `GARANTIA`,`inventario_areasvw1`.`COMPRA_POR` AS `COMPRA_POR`,`inventario_areasvw1`.`CONVENIO_EVENTO` AS `CONVENIO_EVENTO`,`inventario_areasvw1`.`PARTIDA` AS `PARTIDA`,`inventario_areasvw1`.`NOTAS` AS `NOTAS`,`inventario_areasvw1`.`FECHA_COMPRA` AS `FECHA_COMPRA`,`inventario_areasvw1`.`VIDA_UTIL` AS `VIDA_UTIL`,`inventario_areasvw1`.`FECHA_BAJA` AS `FECHA_BAJA`,`ib_seguimentovw`.`NO_ORDEN` AS `NO_ORDEN`,`ib_seguimentovw`.`ESTADO` AS `ESTADO_FUNCIONAL`,`ib_seguimentovw`.`NOCONTROL` AS `NOCONTROL`,`ib_seguimentovw`.`FUERA_SERVICIO` AS `FUERA_SERVICIO` from (`siaem`.`inventario_areasvw1` left join `siaem`.`ib_seguimentovw` on((`inventario_areasvw1`.`NO_CONTROL` = `ib_seguimentovw`.`NOCONTROL`)))");
/*SELECT ID_EQUIPO_INVENTARIO,	NO_CONTROL,	ID_EQUIPO,	EQUIPO,	MODELO,	SERIE,	MARCA,	NO_INVENTARIO,	SERVICIO,	AREA,	CUERPO,	EXTENSION,	ID_PROVEEDOR,	PROVEEDOR,	FECHA_DE_INSTALACION,	ESTADO,	PROPIEDAD, PRECIO,	FECHA_CREACION,	GARANTIA,	COMPRA_POR,	CONVENIO_EVENTO,	PARTIDA	NOTAS,	FECHA_COMPRA,	VIDA_UTIL,	FECHA_BAJA,	MAX(NO_ORDEN) AS ULTIMA_ORDEN,	edo_f, 	case fs
        when 'SI' then 'NO FUNCIONA'
        when 'NO' then 'FUNCIONA'
		when 'PARCIALMENTE' then 'PARCIALMENTE'
		when 'NULL' then 'NO DISPONIBLE'
    end as EDO_FUNCIONAL_EQUIPO FROM inventariovw WHERE ESTADO ='ACTIVO' ORDER BY ID_EQUIPO_INVENTARIO DESC*/

}
$field = mysql_num_fields($query);
// create line with field names
for($i = 0; $i < $field; $i++) {
  $csv_export.= '"'.mysql_field_name($query,$i).'",';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable
while($row = mysql_fetch_array($query)) {
  // create line with field values
  for($i = 0; $i < $field; $i++) {
   /* $csv_export.= '"'.$row[mysql_field_name($query,$i)].'";';*/
    $csv_export.= '"'.$row[mysql_field_name($query,$i)].'",';
	
  }	
  $csv_export.= '
';	
}
// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-type: text/csv");
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
?>