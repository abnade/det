<?php 																												
$sql="SELECT ID_EQUIPO_INVENTARIO,(certificado(NO_CONTROL)+constancia(NO_CONTROL) + musuario(NO_CONTROL) + mservicio(NO_CONTROL)) AS docst , NO_CONTROL, ID_EQUIPO, EQUIPO, MARCA, MODELO, SERIE, NO_INVENTARIO, SERVICIO, AREA AS UBICACION, CUERPO, EXTENSION, ID_PROVEEDOR, PROVEEDOR, FECHA_DE_INSTALACION, ESTADO, PROPIEDAD, PRECIO, FECHA_CREACION, GARANTIA, COMPRA_POR, CONVENIO_EVENTO, PARTIDA, NOTAS, YEAR(CURDATE())-YEAR(FECHA_COMPRA) AS ANTIGUEDAD, FECHA_COMPRA, VIDA_UTIL, FECHA_BAJA, NO_ORDEN, ESTADO_FUNCIONAL AS EDO_ORDEN, case FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA' when 'PARCIALMENTE' then 'PARCIALMENTE' else 'NO DISPONIBLE' end as EDO_FUNCIONAL_EQUIPO, case FUERA_SERVICIO when 'SI' then '1' when 'NO' then '2' when 'PARCIALMENTE' then '3' else '0' end as EDO_F FROM inventariovw1 WHERE ESTADO !='ACTIVO' ORDER BY `docst` DESC ";

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


// COLOCANDO IMAGENES 

switch ($row['EDO_FUNCIONAL_EQUIPO']) {
    case 'NO FUNCIONA':
        $img="img/error_16.png";// No Funciona	
        break;
    case 'PARCIALMENTE':
       $img="img/warning_16.png";// Transito
        break;
    default:
       $img="img/done_16.png";
} 
if($row['NO_ORDEN']=== NULL){$row['NO_ORDEN']
= 'SIN ORDENES'; } 


$row['EDO_FUNCIONAL_EQUIPO']='<img src="'.$img.'" /> <br/>
<div style="font-size:10px; font-weight:bold;">'.$row['NO_ORDEN'].'</div>';

if($row['docst']==0){ 
$row['consultar']='<a href="consultarDocumentos.html?ID_EQUIPO_INVENTARIO='.$row['ID_EQUIPO_INVENTARIO'].'" class="btn btn-sm btn-outline-secondary">sin documentos</a>';
}
else if(($row['docst']>=1)&&($row['docst']<=3)){$row['consultar']='<a href="consultarDocumentos.html?ID_EQUIPO_INVENTARIO='.$row['ID_EQUIPO_INVENTARIO'].'" class="btn btn-sm btn-outline-warning">Documentos parciales</a>';}
    else if($row['docst']>=4){$row['consultar']='<a href="consultarDocumentos.html?ID_EQUIPO_INVENTARIO='.$row['ID_EQUIPO_INVENTARIO'].'" class="btn btn-sm btn-outline-success">Documentos completos</a>';}

$row['VER_EDITAR']='<a href="modificarEquipoHistorico.html?idEquipo='.$row['ID_EQUIPO_INVENTARIO'].'" class="btn btn-sm btn-outline-info">VER/EDITAR</a>';


		$rawdata[ ]= $row ;

    }

    disconnectDB($conexion); //desconectamos la base de datos

    return $rawdata; //devolvemos el array
}

        $myArray = getArraySQL($sql);
		$total = count($myArray);
        echo  '{"data":'. json_encode($myArray).',"total":'.$total.'}';

?>