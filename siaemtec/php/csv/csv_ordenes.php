<?php
/* vars for export */
// database record to be exported
$db_record = 'orden_servicio';
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// filename for export
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
// query to get data from database
$query = mysql_query("SELECT * FROM ".$db_record." ".$where);
//$query = mysql_query("SELECT orden_servicio.NO_ORDEN, orden_servicio.ESTADO, orden_servicio.NOCONTROL, orden_servicio.EQUIPO, orden_servicio.SERIE,  equipoinventario.SERVICIO, equipoinventario.AREA AS UBICACION, orden_servicio.FALLA_REPORTE, orden_servicio.DETALLE_SERVICIO, orden_servicio.ING_RECIBE FROM orden_servicio, equipoinventario WHERE orden_servicio.ID_EQUIPO = equipoinventario.ID_EQUIPO_INVENTARIO ORDER BY orden_servicio.NO_ORDEN DESC");
$field = mysql_num_fields($query);
// create line with field names
for($i = 0; $i < $field; $i++) {
  $csv_export.= '"'.mysql_field_name($query,$i).'",';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable

$patron= array();
	  $patron[0]='/,/';
	  $patron[1]='/;/';
	  $patron[2]='/ , /';
	  $patron[3]='/ ; /';
	  //$patron[4]='\r\n';
	  $patron[4]='/\r\n+|\r+|\n+|\t+/i';
	 // $patron[5]='\r';
	        $sustituto= array();
      $sustituto[0]=' ';
      $sustituto[1]=' ';
	  $sustituto[2]=' ';
      $sustituto[3]=' ';
	  $sustituto[4]=' ';
while($row = mysql_fetch_array($query)) {
  // create line with field values
  for($i = 0; $i < $field; $i++) {
   /* $csv_export.= '"'.$row[mysql_field_name($query,$i)].'";';*/
   $csv_export.= '"'.preg_replace($patron, $sustituto,$row[mysql_field_name($query,$i)]).'",';
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