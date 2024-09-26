<?php 
require_once('../connection/conJSON.php'); 

$sql = "SELECT * FROM catalogo_instrumentos_calibarcion" ;

$myarray=getArraySQL($sql);

echo '{"data":'.json_encode($myarray).'}';