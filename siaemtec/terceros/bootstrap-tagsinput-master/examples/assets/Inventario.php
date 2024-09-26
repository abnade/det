<?php 
$tipo=$_GET['tipo'];

switch($tipo){
 
    case 'Certificado de Aceptación':
        /*case tipo=Certificado de Aceptación*/

$sql = "SELECT ID_EQUIPO_INVENTARIO as value, NO_CONTROL as text FROM equipoinventario WHERE ESTADO='ACTIVO' and certificado(NO_CONTROL)=0";
break;
/*case tipo=Manual de usuario*/
         case 'Manual de usuario':

$sql = "SELECT ID_EQUIPO_INVENTARIO as value, NO_CONTROL as text FROM equipoinventario WHERE ESTADO='ACTIVO' and musuario(NO_CONTROL)=0";
break;

/*case tipo=Manual de servicio*/
         case 'Manual de servicio':

$sql = "SELECT ID_EQUIPO_INVENTARIO as value, NO_CONTROL as text FROM equipoinventario WHERE ESTADO='ACTIVO' and mservicio(NO_CONTROL)=0";

/*case tipo=Constancia de instalacion y puesta en marcha de equipo nuevo*/
         case 'Constancia de instalacion y puesta en marcha de equipo nuevo':
$sql = "SELECT ID_EQUIPO_INVENTARIO as value, NO_CONTROL as text FROM equipoinventario WHERE ESTADO='ACTIVO' and constancia(NO_CONTROL)=0";
break;
        
         default :
$sql=  "SELECT ID_EQUIPO_INVENTARIO as value, NO_CONTROL as text FROM equipoinventario WHERE ESTADO='ACTIVO'";
        
/*case tipo=null*/

break;        
        
}

								

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

        $myArray = getArraySQL($sql);
		$total = count($myArray);
        echo   json_encode($myArray);
		/*echo  ',"queryRecordCount":'. $número_filas;
		echo  ',"totalRecordCount":'. $número_filas. '}';*/
?>