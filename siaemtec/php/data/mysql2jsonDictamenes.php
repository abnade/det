<?php 
//ini_set('memory_limit','1600M');
$sql = "SELECT dictamenes.ID_DICTAMEN, orden_servicio.NOCONTROL, orden_servicio.NOINVENTARIO, orden_servicio.EQUIPO, orden_servicio.MARCA, orden_servicio.MODELO, orden_servicio.SERIE,equipoinventario.ID_EQUIPO_INVENTARIO, equipoinventario.AREA AS SERVICIO, equipoinventario.SERVICIO AS UBICACION, orden_servicio.NO_ORDEN, dictamenes.NO_DICTAMEN, orden_servicio.FECHA_ATENCION AS FECHA_DICTAMEN, dictamenes.DICTAMEN_TECNICO_DE, dictamenes.ANIOS_USO, dictamenes.DICTAMEN, orden_servicio.ING_REALIZA AS ELABORADO_POR, dictamenes.RECIBE, dictamenes.JEFEDEAREA, dictamenes.EDO_DICTAMEN, dictamenes.VALIDACION FROM orden_servicio, dictamenes, equipoinventario WHERE orden_servicio.NO_ORDEN=dictamenes.NO_ORDEN AND equipoinventario.NO_CONTROL=orden_servicio.NOCONTROL";//SELECT dictamenes.*, orden_servicio.EQUIPO, orden_servicio.NOCONTROL, equipoinventario.AREA AS SERVICIO, equipoinventario.SERVICIO AS UBICACION FROM dictamenes, orden_servicio, equipoinventario WHERE dictamenes.NO_ORDEN = orden_servicio.NO_ORDEN  AND equipoinventario.NO_CONTROL=orden_servicio.NOCONTROL ORDER BY ID_DICTAMEN DESC" ;
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
		
/**************** EDO DICTAMEN *******************/	

  if (($row['EDO_DICTAMEN']== NULL)||($row['EDO_DICTAMEN']== 'EN PROCESO')){
	$row['EDO_DICTAMEN']='<a href="cambiar_estado_dictamen.html?ID_DICTAMEN='.$row['ID_DICTAMEN'].'" class="btn btn-sm btn-warning">'.'EN PROCESO'.'</a>'; }
        elseif($row['EDO_DICTAMEN']== 'CANCELADA') {
	$row['EDO_DICTAMEN']='<a class="btn btn-sm btn-secondary" href="cambiar_estado_dictamen.html?ID_DICTAMEN='.$row['ID_DICTAMEN'].'" >'.$row['EDO_DICTAMEN'].'</a>'; 
			  }
		  else {
	$row['EDO_DICTAMEN']='<a class="btn btn-sm btn-success" href="cambiar_estado_dictamen.html?ID_DICTAMEN='.$row['ID_DICTAMEN'].'" >'.$row['EDO_DICTAMEN'].'</a>'; 
			  }
	
		

/**************** IMPRIMIR *******************/
		if( ($row['VALIDACION']=='0')||($row['VALIDACION']== NULL)) {  
     $row['imprimir']= '<a href="dictamen_pdf.php?NO_DICTAMEN='.$row['NO_DICTAMEN'].'"><img src="img/studio15.png" width="16" height="16" /></a>';} 
	 else { $row['imprimir']='NO DISPONIBLE';}
		
/**************** EDITAR *******************/

 if( ($row['VALIDACION']=='0')||($row['VALIDACION']== NULL)) {  
      
     $row['editar']='<a  href="editarDictamen.html?NO_ORDEN='.$row['NO_ORDEN'].'&ID_EQUIPO_INVENTARIO='.$row['ID_EQUIPO_INVENTARIO'].'&NO_DICTAMEN='.$row['NO_DICTAMEN'].'" CLASS="btn btn-sm btn-outline-info">VER/EDITAR</a>';} else {  $row['editar']='NO DISPONIBLE'; }
	 

/**************** VER *******************/


if( ($row['VALIDACION']!='0') && ($row['VALIDACION']!== NULL)) { 
     $row['ver']= '<a href="'. $row['VALIDACION'].'
	"> <img src="img/pdf.png" width="16" height="16" /></a>'; } else {
		$row['ver']='NO DISPONIBLE';
		}

/************* pdf ****************/    

$row['pdf']='<a href="ValidarDictamen.php?ID_DICTAMEN='.$row['ID_DICTAMEN'].'"><img src="img/attachment.png" width="16" height="16" /></a>';

 
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