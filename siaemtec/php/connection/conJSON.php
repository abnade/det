<?php

//$sql = "SELECT * FROM datos";
function connectDB(){
	
        $server ="localhost";//;"192.168.13.81"
        $user = "root";
        $pass = "";
        $bd = "siaem";

    $conexion = mysqli_connect($server, $user, $pass,$bd);

        if($conexion){
           // echo 'La conexion de la base de datos se ha hecho satisfactoriamente';
        }else{
            // echo 'Ha sucedido un error inesperado en la conexion de la base de datos';
        }

    return $conexion;
}

function disconnectDB($conexion){

    $close = mysqli_close($conexion);

        if($close){
            //echo 'La desconexion de la base de datos se ha hecho satisfactoriamente';
        }else{
            //echo 'Ha sucedido un error inexperado en la desconexion de la base de datos';
        }   

    //echo $close;
    return $close;
}

function getArraySQL($sql){
//Creamos la conexión con la función anterior
    $conexion = connectDB();
   // mysql_query("SET NAMES 'UTF8'"); 
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

function setArraySQL($sql){
//Creamos la conexión con la función anterior
    $conexion = connectDB();
    //mysql_query("SET NAMES 'UTF8'"); 
    //generamos la consulta
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
    //$result = mysqli_query($conexion, $sql);
    if(!$result = mysqli_query($conexion, $sql)) die(); //si la conexión cancelar programa
    //echo 'Se guarda la información';
    //echo $result;
    disconnectDB($conexion); 
    
    return $result; //devolvemos el array
    
}

function updateArraySQL($sql){
//Creamos la conexión con la función anterior
    $conexion = connectDB();
    //mysql_query("SET NAMES 'UTF8'"); 
    //generamos la consulta
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
    if(!$result = mysqli_query($conexion, $sql)) die(); //si la conexión cancelar programa
    disconnectDB($conexion); //desconectamos la base de datos
    return $result; //devolvemos el array
}

function deleteArraySQL($sql){
//Creamos la conexión con la función anterior
    $conexion = connectDB();
    //mysql_query("SET NAMES 'UTF8'"); 
    //generamos la consulta
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
    if(!$result = mysqli_query($conexion, $sql)) die(); //si la conexión cancelar programa
    disconnectDB($conexion); //desconectamos la base de datos
    return $result; //devolvemos el array
}



?>