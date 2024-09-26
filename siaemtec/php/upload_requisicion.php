 <?php
require_once('connection/conJSON.php');

$ID_REQUISICION=$_GET['ID_REQUISICION'];

$path_temp="../files/";
$path="files/";
//$path2=  "DocsRequisicion/noViabilidad/";
$d=date("Y.m.d.h.i.s");

if (!(empty($_FILES['archivo']['name']))){ // Si existe Archivo en Solicitud a la Administración;
	//establece una conexión con la base de datos.

// archivo temporal (ruta y nombre).
$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));
$nombre=$_FILES['archivo']['name'];
$peso=$_FILES['archivo']['size'];
$tipo=$_FILES['archivo']['type'];
$destino =  $path.$d.$nombre;
$destino_tmp = '../'.$path.$d.$nombre;


copy($_FILES['archivo']['tmp_name'],$destino_tmp);

$sql = "UPDATE requisiciones SET requisicion = '$destino' WHERE ID_REQUISICION='$ID_REQUISICION' ";

$row=setArraySQL($sql);




	}
	
  $updateGoTo = "../menuSeguimiento_r.html";

  header(sprintf("Location: %s", $updateGoTo));
exit;
?> 