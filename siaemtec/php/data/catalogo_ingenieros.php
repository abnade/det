<?php

include_once('../connection/conJSON.php');

       $sql="SELECT * FROM usuarios WHERE ALTA_BAJA=1 ORDER BY APELLIDOS ASC ";
        $myArray = getArraySQL($sql);
		$número_filas = count($myArray);
        echo json_encode($myArray);
        //echo  '{"data":'. json_encode($myArray).'}';

?>