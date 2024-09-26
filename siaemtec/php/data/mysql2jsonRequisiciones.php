<?php 
//ini_set('memory_limit','1600M');
$sql = "select requisiciones.ID_REQUISICION,
        (case orden_servicio.FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA'
		when 'PARCIALMENTE' then 'PARCIALMENTE' else 'FUNCIONA' end) AS EDO_FUNCIONAL_EQUIPO,
		orden_servicio.NOCONTROL AS NOCONTROL,orden_servicio.EQUIPO AS EQUIPO,orden_servicio.MARCA 
		AS MARCA,orden_servicio.MODELO AS MODELO,orden_servicio.SERIE AS SERIE,
        IF (requisiciones.ORDEN_SERVICIO='NA' , year(requisiciones.FECHA_SOLICITUD_ALMACEN),
		year(orden_servicio.FECHA_ATENCION)) AS ANIO, equipoinventario.AREA AS UBICACION,  equipoinventario.SERVICIO AS SERVICIO,
		requisiciones.ORDEN_SERVICIO AS ORDEN_SERVICIO,
		requisiciones.REQUISICION_POR AS REQUISICION_POR, requisiciones.EDO_REQUISICION AS EDO_REQUISICION,
		requisiciones.FECHA_SOLICITUD_ALMACEN AS FECHA_SOLICITUD_ALMACEN,requisiciones.FECHA_SUMINISTRO AS FECHA_SUMINISTRO,
		requisiciones.NUM_F AS NUM_F,requisiciones.requisicion AS requisicion,requisiciones.TIPO_SEGUIMIENTO AS TIPO_SEGUIMIENTO,
		requisiciones.COMENTARIOS AS COMENTARIOS,requisiciones.REALIZO AS REALIZO from orden_servicio RIGHT join equipoinventario 
		ON orden_servicio.ID_EQUIPO = equipoinventario.ID_EQUIPO_INVENTARIO	
		RIGHT join requisiciones on orden_servicio.NO_ORDEN = requisiciones.ORDEN_SERVICIO WHERE requisiciones.EDO_REQUISICION !='DUPLICADO' ORDER BY requisiciones.ID_REQUISICION DESC";
 ;//ejemplo frutería: SELECT id_fruta,nombre_fruta,cantidad FROM tabla_fruta; ID_DICTAMEN_FACTIBILIDAD																													


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

/*

$row['VER_EDITAR']='<a href="editarOrdenesServicio.php?NO_ORDEN='.$row['NO_ORDEN'].'" >ver</a>';

$row['COPIAR']='<img src="'.$img.'" /> <br/>
<div style="font-size:10px; font-weight:bold;">'.$row['NO_ORDEN'].'</div>';

$row['IMPRIMIR']='<a href="menuDocumentos.php?ID_EQUIPO_INVENTARIO='. $row['NO_ORDENO'].'" > ver</a>';*/



// FIN DE COLOCAR IMAGENES <?php echo $row_seguimiento['']?
		$id=$row['ID_REQUISICION'];
		
        $row['VER']='<a href="editarRequisicion.php?ID_REQUISICION='.$id.'" class="btn btn-sm btn-outline-info">VER/EDITAR</a>';
		if ($row['requisicion']!= NULL){
			$row['PDF']= '<a href="'.$row['requisicion'] .'" class="btn btn-sm btn-outline-info">descargar</a>';//<a href="'.$row['requisicion'];
	// '" > descarga </a> ';
			
			
			}
		else{
		$row['PDF']='no disponible';
		
	
	 }
	 	if($row['ORDEN_SERVICIO']=='NA'){
		  $row['EDO_FUNCIONAL_EQUIPO']='NA';
		  $row['NOCONTROL']='NA';
		  $row['EQUIPO']='NA';
		  $row['MARCA']='NA';
		  $row['MODELO']='NA';
		  $row['SERIE']='NA';
	  }
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