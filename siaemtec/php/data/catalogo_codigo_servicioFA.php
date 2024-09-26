<?php

include_once('../connection/conJSON.php');

       $sql="SELECT * FROM catalogo_codigo_servicio  WHERE TIPO_CODIGO='FA' order by DESCRIPCION ASC";
        $myArray = getArraySQL($sql);
		$número_filas = count($myArray);
        echo json_encode($myArray);
        //echo  '{"data":'. json_encode($myArray).'}';

?>