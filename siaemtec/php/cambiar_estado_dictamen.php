<?php require_once('connection/conJSON.php');

$ID_DICTAMEN=$_POST['ID_DICTAMEN'];
$EDO_DICTAMEN=$_POST['EDO_DICTAMEN'];
$sql="UPDATE dictamenes SET EDO_DICTAMEN='$EDO_DICTAMEN' WHERE ID_DICTAMEN='$ID_DICTAMEN'";
    
$row=setArraySQL($sql);

echo json_encode($row);