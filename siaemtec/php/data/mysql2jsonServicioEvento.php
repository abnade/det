<?php 
//ini_set('memory_limit','1600M');
$sql = "SELECT orden_servicio.FUERA_SERVICIO AS FUERA_SERVICIO,
        (case orden_servicio.FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA'
		when 'PARCIALMENTE' then 'PARCIALMENTE' else 'FUNCIONA' end) AS EDO_FUNCIONAL_EQUIPO, 			orden_servicio.NOCONTROL, orden_servicio.EQUIPO, orden_servicio.MARCA, orden_servicio.MODELO, orden_servicio.SERIE, orden_servicio.ID_AREA, orden_servicio.AREA_SERVICIO, year(orden_servicio.FECHA_REPORTE) AS ANIO, servicio_evento.ESTADO,servicio_evento.documento, servicio_evento.FECHA_SOLICITUD_SIT, servicio_evento.FECHA_SOLICITUD_ADM, servicio_evento.FECHA_AUTORIZACION, servicio_evento.COSTO_MTTO, servicio_evento.NO_SOLICITUD_ADM, servicio_evento.ORDEN_SERVICIO, servicio_evento.COMENTARIOS, servicio_evento.TIPO_SERVICIO_EVENTO, servicio_evento.ID_SERVICIO_EVENTO FROM orden_servicio, servicio_evento WHERE orden_servicio.NO_ORDEN = servicio_evento.ORDEN_SERVICIO" ;//ejemplo frutería: SELECT id_fruta,nombre_fruta,cantidad FROM tabla_fruta; ID_DICTAMEN_FACTIBILIDAD																													


function connectDB(){

        $server = "localhost";
        $user = "root";
        $pass = "";
        $bd = "siaem";

    $conexion = mysqli_connect($server, $user, $pass,$bd);

        if($conexion){
            //echo 'La conexion de la base de datos se ha hecho satisfactoriamente';
        }else{
           // echo 'Ha sucedido un error inexperado en la conexion de la base de datos';
        }

    return $conexion;
}

function disconnectDB($conexion){

    $close = mysqli_close($conexion);

        if($close){
        //    echo 'La desconexion de la base de datos se ha hecho satisfactoriamente';
        }else{
        //    echo 'Ha sucedido un error inexperado en la desconexion de la base de datos';
        }   

    return $close;
}

function getArraySQL($sql){
    //Creamos la conexión con la función anterior
    $conexion = connectDB();

    //generamos la consulta

     mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if(!$result = mysqli_query($conexion, $sql)) die(); //si la conexión cancelar programa

    $rawdata = array(); //creamos un array

    //guardamos en un array multidimensional todos los datos de la consulta


    while($row = mysqli_fetch_assoc($result))// mysqli_fetch_array($result))
    {





// FIN DE COLOCAR IMAGENES <?php echo $row_seguimiento['']?
		$id=$row['ID_SERVICIO_EVENTO'];
        
        if(!empty($row['documento'])){
            $row['DOC']='<a href="'.$row['documento'].'" class="btn btn-sm btn-outline-info"> Descargar</a>';
           
        }else {
             $row['DOC']= 'NO DISPONIBLE';
        }
        
		
        $row['VER']='<a href="editarServicioEvento.php?ID_SERVICIO_EVENTO='.$id.'" class="btn btn-sm btn-outline-info">VER/EDTAR</a>';
		/*if ($row['requisicion']!= NULL){
			$row['PDF']= '<a href="'.$row['requisicion'] .'">descargar</a>';//<a href="'.$row['requisicion'];
	// '" > descarga </a> ';
			
			
			}
		else{
		$row['PDF']='no disponible';
		
	
	 }*/
	 	
		$rawdata[ ]= $row ;

    }
      

    disconnectDB($conexion); //desconectamos la base de datos

    return $rawdata; //devolvemos el array
}

        $myArray = getArraySQL($sql);
		$número_filas = count($myArray);
        echo  '{"data":'. json_encode($myArray).'}';
		/*echo  ',"queryRecordCount":'. $número_filas;
		echo  ',"totalRecordCount":'. $número_filas. '}';*/
?>