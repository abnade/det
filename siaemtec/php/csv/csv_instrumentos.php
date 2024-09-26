<?php
include_once('../connection/conJSON.php');
// filename for export
$db_record = 'instrumentos';
$csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';

$csv_export = '';
// query to get data from database
$sql = "SELECT catalogo_instrumentos_calibarcion.* , certificados_icalibracion.RUTA FROM catalogo_instrumentos_calibarcion RIGHT JOIN  certificados_icalibracion on catalogo_instrumentos_calibarcion.ID_CATALOGO_IC=certificados_icalibracion.ID_ICALIBRACION";

$dictamen=getArraySQL($sql);
$arraykeys=array_keys( $dictamen[0]);

//print_r($arraykeys);

$field = sizeof($arraykeys);
// create line with field names
for($i = 0; $i < $field; $i++) {
  $csv_export.= '"'.$arraykeys[$i].'",';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';

foreach($dictamen as $equipo){
    
    for($i = 0; $i < $field; $i++) {
  $csv_export.= '"'.$equipo[$arraykeys[$i]].'",';
}
    
    $csv_export.= '
     ';
}

$csv_export=mb_convert_encoding($csv_export, 'UTF-16LE', 'UTF-8');

// Export the data and prompt a csv file for download
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header("Content-type: text/x-csv");
header("Content-type: text/csv");
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
?>