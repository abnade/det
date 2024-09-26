<?php

include_once('../connection/conJSON.php');

$ID_AREA=$_GET['ID_AREA'];       
$sql="SELECT * FROM areasinventario WHERE ID_AREA='$ID_AREA'";
        $myArray = getArraySQL($sql);
	
        echo json_encode($myArray);
        //echo  '{"data":'. json_encode($myArray).'}';

?>