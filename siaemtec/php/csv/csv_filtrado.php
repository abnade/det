<?php
 set_time_limit('600');
 //ini_set('memory_limit', '-1');
$array='';

if(isset($_POST['array'])) {
    $array = $_POST['array'];
} else {
    $array = '';
}

 $array = str_replace ( "[", '(', $array);
 $array = str_replace ( "]", ')', $array);
 //$array = explode(",", $array);

 $sqlquery="SELECT orden_servicio.NO_ORDEN, orden_servicio.ESTADO, orden_servicio.TRANSITO_POR, orden_servicio.NOCONTROL, orden_servicio.NOINVENTARIO,  orden_servicio.EQUIPO,   orden_servicio.MARCA, orden_servicio.MODELO,  orden_servicio.SERIE,  inventariovw1.SERVICIO AS SERVICIO, inventariovw1.AREA AS UBICACION, orden_servicio.ACCESORIOS_ADICIONALES, orden_servicio.FECHA_REPORTE,  orden_servicio.HORA_REPORTE, orden_servicio.NOMBRE_SOLICITANTE, orden_servicio.EXTENSION, orden_servicio.FALLA_REPORTE, orden_servicio.DESCRIPCION_REPORTE , orden_servicio.ING_RECIBE, orden_servicio.FECHA_SERVICIO, orden_servicio.HORA, orden_servicio.DETALLE_SERVICIO,case orden_servicio.FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA' when 'PARCIALMENTE' then 'PARCIALMENTE' else 'NO DISPONIBLE' end as EDO_FUNCIONAL_EQUIPO, orden_servicio.DESCRIPCION_SERVICIO, orden_servicio.TIPO_EXTERNO, orden_servicio.ING_REALIZA, orden_servicio.ING_EXTERNO, orden_servicio.EMPRESA, orden_servicio.FALLA_ENCONTRADA, orden_servicio.OTRA_FALLA, orden_servicio.REPARACION_REALIZADA, orden_servicio.HORAS_EMPLEADAS, orden_servicio.COMENTARIOS, orden_servicio.REFACCIONES, orden_servicio.FECHA_ENTREGA, orden_servicio.HORA_ENTREGA, orden_servicio.ING_SUPERVISA, orden_servicio.ING_ENTREGA, orden_servicio.NOTA_IMPORTANTE, orden_servicio.NOMBRE_RECIBE, orden_servicio.FECHA_ATENCION, orden_servicio.HORA_ATENCION, orden_servicio.INSTRUMENTOS FROM orden_servicio, inventariovw1 WHERE orden_servicio.ID_EQUIPO = inventariovw1.ID_EQUIPO_INVENTARIO AND orden_servicio.NO_ORDEN IN ".$array." ORDER BY orden_servicio.NO_ORDEN DESC";
//echo ($query);


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



// database record to be exported 
$db_record = 'orden_servicio';
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// filename for export
$csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';
// database variables
$hostname = "localhost";
$user = "root";
$password = "";
$database = "siaem";
// Database connecten voor alle services
$con=mysqli_connect($hostname, $user, $password)
or die('Could not connect: ' . mysqli_error());

mysqli_set_charset($con, "utf8"); //formato de datos utf8
mysqli_select_db($con,$database)
or die ('Could not select database ' . mysqli_error());
// create empty variable to be filled with export data
$csv_export = '';
// query to get data from database
$query = mysqli_query($con,$sqlquery);

$rawdata = array(); //creamos un array


$rawdata[0]=array('NO_ORDEN'=>'NO_ORDEN','ESTADO'=>'ESTADO', 'TRANSITO_POR'=>'TRANSITO_POR', 'NOCONTROL'=>'NOCONTROL', 'NOINVENTARIO'=>'NOINVENTARIO',  'EQUIPO'=>'EQUIPO',   'MARCA'=>'MARCA', 'MODELO'=>'MODELO',  'SERIE'=>'SERIE',  'SERVICIO'=>'SERVICIO','UBICACION'=>'UBICACION', 'ACCESORIOS_ADICIONALES'=>'ACCESORIOS_ADICIONALES', 'FECHA_REPORTE'=>'FECHA_REPORTE',  'HORA_REPORTE'=>'HORA_REPORTE', 'NOMBRE_SOLICITANTE'=>'NOMBRE_SOLICITANTE', 'EXTENSION'=>'EXTENSION', 'FALLA_REPORTE'=>'FALLA_REPORTE', 'DESCRIPCION_REPORTE' =>'DESCRIPCION_REPORTE', 'ING_RECIBE'=>'ING_RECIBE', 'FECHA_SERVICIO'=>'FECHA_SERVICIO', 'HORA'=>'HORA', 'DETALLE_SERVICIO'=>'DETALLE_SERVICIO', 'EDO_FUNCIONAL_EQUIPO'=>'EDO_FUNCIONAL_EQUIPO', 'DESCRIPCION_SERVICIO'=>'DESCRIPCION_SERVICIO', 'TIPO_EXTERNO'=>'TIPO_EXTERNO', 'ING_REALIZA'=>'ING_REALIZA', 'ING_EXTERNO'=>'ING_EXTERNO', 'EMPRESA'=>'EMPRESA', 'FALLA_ENCONTRADA'=>'FALLA_ENCONTRADA', 'OTRA_FALLA'=>'OTRA_FALLA', 'REPARACION_REALIZADA'=>'REPARACION_REALIZADA', 'HORAS_EMPLEADAS'=>'HORAS_EMPLEADAS', 'COMENTARIOS'=>'COMENTARIOS', 'REFACCIONES'=>'REFACCIONES', 'FECHA_ENTREGA'=>'FECHA_ENTREGA', 'HORA_ENTREGA'=>'HORA_ENTREGA', 'ING_SUPERVISA'=>'ING_SUPERVISA', 'ING_ENTREGA'=>'ING_ENTREGA', 'NOTA_IMPORTANTE'=>'NOTA_IMPORTANTE', 'NOMBRE_RECIBE'=>'NOMBRE_RECIBE', 'FECHA_ATENCION'=>'FECHA_ATENCION', 'HORA_ATENCION'=>'HORA_ATENCION', 'INSTRUMENTOS'=>'INSTRUMENTOS');
$i=1;

 while($row = mysqli_fetch_assoc($query))// mysqli_fetch_array($result))
    {
		$rawdata[$i]= $row;
        $i++;
    }

  //$close = mysqli_close($con);

 echo   json_encode($rawdata); 


echo($csv_export);


?>