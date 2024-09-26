<?php 
//ini_set('memory_limit','1600M');
$sql = "SELECT *, CONCAT(FECHA,' ',HORA) AS FECHA_HORA,TIMESTAMPDIFF(MINUTE,CONCAT(FECHA,' ',HORA), NOW()) as DIF_MIN, ATENDIDO FROM reportes ORDER BY FECHA AND HORA DESC" ;
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

		//  + { "data": "ID_AREA" } + 
        $id=$row['ID_REPORTE'];
        $atn=$row['ATENDIO'];
        if($row['ATENDIDO']==1){
            $clase='info';
             $row['ESTADO']='<a href="#" id="desatender"  data-bs-toggle="modal" data-bs-target="#myModal2" class="btn-'.$clase.' btn btn-sm" style="color:#fff">'.$id.'</a>'.'<sub>ATN. '.$atn.'</sub>';
        }else{
             
            if(($row['DIF_MIN'])<45){
            $estado='verde';
            $clase='success';
        }
            else if((($row['DIF_MIN'])<90)&(($row['DIF_MIN'])>46)){ $estado='amarillo'; 
                                                                    $clase='warning';
                                                                  
                                                                  
                                                                  }   
            else{ $estado='rojo';
            $clase='danger';}
            $row['ESTADO']='<a href="#" id="atender"  data-bs-toggle="modal" data-bs-target="#myModal" class="btn-'.$clase.' btn btn-sm" >'.$id.'</a>'; 
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