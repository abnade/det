<?php 

$ID_EQUIPO=$_GET['ID_EQUIPO_INVENTARIO'];

ini_set('memory_limit','1600M');

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

		$rawdata[ ]= $row ;

    }

    disconnectDB($conexion); //desconectamos la base de datos

    return $rawdata; //devolvemos el array
}

$sql = "SELECT orden_servicio.NO_ORDEN, CONCAT('<a id= ',orden_servicio.ESTADO, '  class=',orden_servicio.ESTADO,''
,' >',orden_servicio.ESTADO,'</a>') AS ESTADO, orden_servicio.NOCONTROL, orden_servicio.EQUIPO, orden_servicio.SERIE, orden_servicio.MODELO, areasinventario.SERVICIO AS UBICACION, orden_servicio.FECHA_SERVICIO, orden_servicio.TIPO_EXTERNO, orden_servicio.ING_REALIZA,orden_servicio.ING_SUPERVISA, orden_servicio.REFACCIONES,areasinventario.AREA AS SERVICIO, orden_servicio.FALLA_REPORTE, orden_servicio.DETALLE_SERVICIO,orden_servicio.COMENTARIOS , orden_servicio.ING_RECIBE, orden_servicio.ING_EXTERNO, equipoinventario.PROVEEDOR FROM orden_servicio, equipoinventario, areasinventario WHERE orden_servicio.ID_EQUIPO = equipoinventario.ID_EQUIPO_INVENTARIO and equipoinventario.ID_AREA=areasinventario.ID_AREA AND equipoinventario.ID_EQUIPO_INVENTARIO='$ID_EQUIPO'";
  

//{ "data": "FECHA_SERVICIO" },{ "data": "DETALLE_SERVICIO" },{ "data": "TIPO_EXTERNO" },{ "data": "ING_REALIZA" },{ "data": "DESCRIPCION_SERVICIO" },{ "data": "REFACCIONES" },

        $myArray = getArraySQL($sql);
		$número_filas = count($myArray);
        echo  '{"data":'. json_encode($myArray).'}';
		/*echo  ',"queryRecordCount":'. $número_filas;
		echo  ',"totalRecordCount":'. $número_filas. '}';*/
?>