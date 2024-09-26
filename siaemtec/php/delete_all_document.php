<?php
include_once('connection/conJSON.php');
$id=$_POST['ID_DOCUMENTO'];
// hacer consulta para saber la ruta y nombre del archivo 
$sql="SELECT * FROM documentos WHERE ID_DOCUMENTO='$id'";
$row=getArraySQL($sql);
$filename=$row[0]['PATH'];
$sql_delete="DELETE FROM documentos WHERE ID_DOCUMENTO='$id'";
$result=deleteArraySQL($sql_delete);
//unlink($filename);

echo json_encode($result);
?>