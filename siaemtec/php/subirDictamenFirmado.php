 <?php
include_once('connection/conJSON.php');


$ID_DICTAMEN=$_GET['ID_DICTAMEN'];


// archivo temporal (ruta y nombre).
$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;

// leer del archvio temporal .. el binario subido.
// "rb" para Windows .. Linux parece q con "r" sobra ...
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

// Obtener del array FILES (superglobal) los datos del binario .. nombre, tabamo y tipo.
$nombre=$_FILES['archivo']['name'];
$peso=$_FILES['archivo']['size'];
$tipo=$_FILES['archivo']['type'];
$destino_tmp =  "../Dictamenes/".$nombre;
$destino =  "Dictamenes/".$nombre;
/*header("location: ValidarDictamen.php?proceso=fichero_Valido");*/
copy($binario_nombre_temporal,$destino_tmp);
    
$sql = "UPDATE dictamenes SET VALIDACION='$destino' WHERE ID_DICTAMEN='$ID_DICTAMEN'";
    
$row_validacion=setArraySQL($sql);
  // si ha ido todo bien
    header("location: ../menuDictamenes.html");  // si ha ido todo bien*/

exit;



?> 