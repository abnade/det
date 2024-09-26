
<?php require_once('../connection/conJSON.php');
$ID_PROVEEDOR=$_GET['ID_PROVEEDOR'];

$sql = "SELECT * FROM proveedores WHERE ID_PROVEEDOR= '$ID_PROVEEDOR'";

$myArray = getArraySQL($sql);
$número_filas = count($myArray);
echo json_encode($myArray);

?> 
