<?php
// filename for export
$db_record = 'requisiciones';
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
$query = mysql_query("SELECT * FROM requisiciones_vw2 ORDER BY ID_REQUISICION DESC");

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