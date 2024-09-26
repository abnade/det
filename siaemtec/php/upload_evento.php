 <?php
require_once('connection/conJSON.php');

$ID_SERVICIO_EVENTO=$_GET['ID_SERVICIO_EVENTO'];

$path_temp="../DocsEvento/";
$path="DocsEvento/";
//$path2=  "DocsRequisicion/noViabilidad/";

if (!(empty($_FILES['archivo']['name']))){ // Si existe Archivo en Solicitud a la Administración;
	//establece una conexión con la base de datos.

// archivo temporal (ruta y nombre).
$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));
$nombre=$_FILES['archivo']['name'];
$peso=$_FILES['archivo']['size'];
$tipo=$_FILES['archivo']['type'];
$destino =  $path.$nombre;
$destino_tmp = '../'.$path.$nombre;


copy($_FILES['archivo']['tmp_name'],$destino_tmp);

$sql = "UPDATE servicio_evento SET documento = '$destino' WHERE ID_SERVICIO_EVENTO='$ID_SERVICIO_EVENTO'";

$row=setArraySQL($sql);




	}
	
  $updateGoTo = "../menuSeguimiento_e.html";

  header(sprintf("Location: %s", $updateGoTo));
exit;
?> 