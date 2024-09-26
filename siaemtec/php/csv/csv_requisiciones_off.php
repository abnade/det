<?php
// filename for export
$db_record = 'requisicione';
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

//if(isset($_GET['query'])) 
//{
	
//$query1=$_GET['query'];
//echo $query1;
	
//$query = mysql_query($query1);	

//echo $query;
//	}
/* vars for export */
// database record to be exported
//else {
$db_record = 'requisicione';
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// query to get data from database
mysql_query("SET NAMES utf8");	

$query = mysql_query("select requisiciones.ID_REQUISICION,
        (case orden_servicio.FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA'
		when 'PARCIALMENTE' then 'PARCIALMENTE' else 'FUNCIONA' end) AS EDO_FUNCIONAL_EQUIPO,
		orden_servicio.NOCONTROL AS NOCONTROL,orden_servicio.EQUIPO AS EQUIPO,orden_servicio.MARCA 
		AS MARCA,orden_servicio.MODELO AS MODELO,orden_servicio.SERIE AS SERIE,
		year(orden_servicio.FECHA_ATENCION) AS ANIO, equipoinventario.AREA AS SERVICIO,  equipoinventario.SERVICIO AS UBICACION,
		requisiciones.ORDEN_SERVICIO AS ORDEN_SERVICIO,
		requisiciones.REQUISICION_POR AS REQUISICION_POR, requisiciones.EDO_REQUISICION AS EDO_REQUISICION,
		requisiciones.FECHA_SOLICITUD_ALMACEN AS FECHA_SOLICITUD_ALMACEN,requisiciones.FECHA_SUMINISTRO AS FECHA_SUMINISTRO,
		requisiciones.NUM_F AS NUM_F,requisiciones.requisicion AS requisicion,requisiciones.TIPO_SEGUIMIENTO AS TIPO_SEGUIMIENTO,
		requisiciones.COMENTARIOS AS COMENTARIOS,requisiciones.REALIZO AS REALIZO from orden_servicio RIGHT join equipoinventario ON orden_servicio.ID_EQUIPO = equipoinventario.ID_EQUIPO_INVENTARIO		RIGHT join requisiciones on orden_servicio.NO_ORDEN = requisiciones.ORDEN_SERVICIO WHERE requisiciones.EDO_REQUISICION !='DUPLICADO'
");

//}/
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
// loop through database query and fill export variable
while($row = mysql_fetch_array($query)) {
  // create line with field values
  for($i = 0; $i < $field; $i++) {
  /* $csv_export.= '"'.$row[mysql_field_name($query,$i)].'";';*/
     $csv_export.=(string) '"'.preg_replace($patron, $sustituto,$row[mysql_field_name($query,$i)]).'",';
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