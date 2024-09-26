<?php

include_once('../connection/conJSON.php');

       $sql="SELECT * FROM areasinventario ORDER BY SERVICIO ASC";
        $myArray = getArraySQL($sql);
		$número_filas = count($myArray);
        echo json_encode($myArray);
        //echo  '{"data":'. json_encode($myArray).'}';

?>