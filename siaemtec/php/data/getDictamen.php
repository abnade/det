
<?php require_once('../connection/conJSON.php');
$NO_DICTAMEN=$_GET['NO_DICTAMEN'];

$sql = "SELECT * FROM dictamenes WHERE NO_DICTAMEN= '$NO_DICTAMEN'";

$myArray = getArraySQL($sql);
$número_filas = count($myArray);
echo json_encode($myArray);

?> 
