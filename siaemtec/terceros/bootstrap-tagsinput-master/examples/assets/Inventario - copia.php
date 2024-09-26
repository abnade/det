<?php 
$sql = "SELECT ID_EQUIPO_INVENTARIO as value, NO_CONTROL as text FROM equipoinventario WHERE ESTADO='ACTIVO'" ;//ejemplo frutería: SELECT id_fruta,nombre_fruta,cantidad FROM tabla_fruta; ID_DICTAMEN_FACTIBILIDAD																													


function connectDB(){

        $server = "localhost";
        $user = "root";
        $pass = "";
        $bd = "siaem_240122";

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


		$rawdata[ ]= $row ;

    }

    disconnectDB($conexion); //desconectamos la base de datos

    return $rawdata; //devolvemos el array
}

        $myArray = getArraySQL($sql);
		$total = count($myArray);
        echo   json_encode($myArray);
		/*echo  ',"queryRecordCount":'. $número_filas;
		echo  ',"totalRecordCount":'. $número_filas. '}';*/
?>