<?php

include_once('../connection/conJSON.php');

       $sql="SELECT * FROM catalogo_equipos ORDER BY EQUIPO ASC";
        $myArray = getArraySQL($sql);
		$número_filas = count($myArray);
        echo json_encode($myArray);
        //echo  '{"data":'. json_encode($myArray).'}';

?>