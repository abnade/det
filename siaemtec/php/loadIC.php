 <?php
require_once('connection/conJSON.php');
error_reporting(E_ALL);
//Primero, arranca el bloque PHP y checkea si el archivo tiene nombre.  Si no fue asi, te remite de nuevo al formulario de inserción:
// No se comprueba aqui si se ha subido correctamente.
if (isset($_GET['ID_CATALOGO_IC'])){
$ID_CATALOGO_IC=$_GET['ID_CATALOGO_IC'];
}

if (empty($_FILES['archivo']['name'])){
header("location: ../Subir_CertificadoIC.php?proceso=falta_indicar_fichero"); //o como se llame el formulario ..
exit;
}



// archivo temporal (ruta y nombre).
$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;

// leer del archvio temporal .. el binario subido.
// "rb" para Windows .. Linux parece q con "r" sobra ...
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

// Obtener del array FILES (superglobal) los datos del binario .. nombre, tabamo y tipo.
$nombre=$_FILES['archivo']['name'];
$peso=$_FILES['archivo']['size'];
$tipo=$_FILES['archivo']['type'];
$destino_tmp =  "../DocsICalibracion/".$nombre;
$destino =  "DocsICalibracion/".$nombre;

if($tipo=='application/pdf'){

/*header("location: ValidarDictamen.php?proceso=fichero_Valido");*/
copy($_FILES['archivo']['tmp_name'],$destino_tmp);
$sql = "UPDATE certificados_icalibracion SET  RUTA='$destino' WHERE
ID_ICALIBRACION='$ID_CATALOGO_IC'";
    
$row=setArraySQL($sql);
    
header("location: ../menuICalibracion.html");  // si ha ido todo bien
exit;
}

else{
header("location: ../Subir_CertificadoIC.php?proceso=El_fichero_no_es_valido");
}
//insertamos los datos en la BD.

exit;
?> 