<?php
// filename for export
$db_record = 'equipoinventario';
$csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';
// database variables
$hostname = "localhost";
$user = "root";
$password = "laura";
$database = "siaem_240122";
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
$query = mysql_query("SELECT ID_EQUIPO_INVENTARIO, NO_CONTROL, ID_EQUIPO, EQUIPO, MARCA, MODELO, SERIE,  NO_INVENTARIO, SERVICIO, AREA AS UBICACION, CUERPO, EXTENSION, ID_PROVEEDOR, PROVEEDOR, FECHA_DE_INSTALACION, ESTADO, PROPIEDAD, PRECIO, FECHA_CREACION, GARANTIA, COMPRA_POR, CONVENIO_EVENTO, PARTIDA, NOTAS, YEAR(CURDATE())-YEAR(FECHA_COMPRA) AS ANTIGUEDAD, FECHA_COMPRA, VIDA_UTIL, FECHA_BAJA, NO_ORDEN, ESTADO_FUNCIONAL AS EDO_ORDEN, case FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA' when 'PARCIALMENTE' then 'PARCIALMENTE' else 'NO DISPONIBLE' end as EDO_FUNCIONAL_EQUIPO FROM inventariovw1  WHERE ESTADO ='ACTIVO' ORDER BY ID_EQUIPO_INVENTARIO DESC ");

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