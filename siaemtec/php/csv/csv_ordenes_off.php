<?php
include_once('../connection/conJSON.php');

function separa($var){
	

$variable[0]=" ";
$variable[1]=" ";

if ( strpos($var,";")===FALSE){
	
	}
	else{
$div=explode(";",$var);
$variable[0]=$div[0];
$variable[1]=$div[1];
	}
return $variable;
	
	}

$db_record = 'orden_servicio';

// filename for export
$csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';

$conexion = connectDB();
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
   

$csv_export = '';
// query to get data from database

$sql="SELECT orden_servicio.NO_ORDEN, orden_servicio.ESTADO, orden_servicio.TRANSITO_POR, orden_servicio.NOCONTROL, orden_servicio.NOINVENTARIO,  orden_servicio.EQUIPO,   orden_servicio.MARCA, orden_servicio.MODELO,  orden_servicio.SERIE,  inventariovw1.SERVICIO AS SERVICIO, inventariovw1.AREA AS UBICACION, orden_servicio.ACCESORIOS_ADICIONALES, orden_servicio.FECHA_REPORTE,  orden_servicio.HORA_REPORTE, orden_servicio.NOMBRE_SOLICITANTE, orden_servicio.EXTENSION, orden_servicio.FALLA_REPORTE, orden_servicio.DESCRIPCION_REPORTE , orden_servicio.ING_RECIBE, orden_servicio.FECHA_SERVICIO, orden_servicio.HORA, orden_servicio.DETALLE_SERVICIO,case orden_servicio.FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA' when 'PARCIALMENTE' then 'PARCIALMENTE' else 'NO DISPONIBLE' end as EDO_FUNCIONAL_EQUIPO, orden_servicio.DESCRIPCION_SERVICIO, orden_servicio.TIPO_EXTERNO, orden_servicio.ING_REALIZA, orden_servicio.ING_EXTERNO, orden_servicio.EMPRESA, orden_servicio.FALLA_ENCONTRADA, orden_servicio.OTRA_FALLA, orden_servicio.REPARACION_REALIZADA, orden_servicio.HORAS_EMPLEADAS, orden_servicio.COMENTARIOS, orden_servicio.REFACCIONES, orden_servicio.FECHA_ENTREGA, orden_servicio.HORA_ENTREGA, orden_servicio.ING_SUPERVISA, orden_servicio.ING_ENTREGA, orden_servicio.NOTA_IMPORTANTE, orden_servicio.NOMBRE_RECIBE, orden_servicio.FECHA_ATENCION, orden_servicio.HORA_ATENCION, orden_servicio.INSTRUMENTOS FROM orden_servicio, inventariovw1 WHERE orden_servicio.ID_EQUIPO = inventariovw1.ID_EQUIPO_INVENTARIO ORDER BY orden_servicio.NO_ORDEN DESC"; 

$query = mysqli_query($conexion, $sql);
$field = mysqli_num_fields($query);
// create line with field names
for($i = 0; $i < $field; $i++) {
   //$csv_export.= '"'.mysqli_field_name($query,$i).'",';
    
    $fieldName = mysqli_fetch_field_direct($query, $i)->name;
    $csv_export.= '"'.$fieldName.'",';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable
while($row = mysqli_fetch_array($query)) {
  // create line with field values
  for($i = 0; $i < $field; $i++) {
   /* $csv_export.= '"'.$row[mysql_field_name($query,$i)].'";';*/
  
   	 $fieldName = mysqli_fetch_field_direct($query, $i)->name;
	//$row_s=  str_replace("r", ' ', $row[mysql_field_name($query,$i)]);   	 $fieldName
	//$desc = str_replace("\n", " ", $row[mysqli_field_name($query,$i)]);
      $desc = str_replace("\n", " ", $row[$fieldName]);
    $desc = str_replace("\r", " ", $desc);  
    $csv_export.= '"'.$desc.'",';}
  
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