<?php 
//ini_set('memory_limit','1600M');
$sql= "SELECT catalogo_instrumentos_calibarcion.* , certificados_icalibracion.RUTA FROM catalogo_instrumentos_calibarcion RIGHT JOIN  certificados_icalibracion on catalogo_instrumentos_calibarcion.ID_CATALOGO_IC=certificados_icalibracion.ID_ICALIBRACION";
//$sql = "SELECT * FROM catalogo_instrumentos_calibarcion ORDER BY INSTRUMENTO ASC" ;
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
      
	 $row['DOC']='<a href="'. $row['RUTA'].'" class="btn btn-sm btn-outline-info">VER</a>';	
		  $row['EDITAR']='<a href="editarICalibracion.php?ID_CATALOGO_IC='. $row['ID_CATALOGO_IC'].'" class="btn btn-sm btn-outline-info">VER/EDITAR</a>';
    $row['SUBIR']='<a href="Subir_CertificadoIC.php?ID_CATALOGO_IC='. $row['ID_CATALOGO_IC'].'" class="btn btn-sm btn-outline-info">SUBIR/SUSTITUIR</a>';
	
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