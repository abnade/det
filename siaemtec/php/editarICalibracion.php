<?php require_once('php/connection/conJSON.php'); ?>
<?php
//initialize the session
if(isset($_GET['ID_CATALOGO_IC'])) {
   $ID_CATALOGO_IC=$_GET['ID_CATALOGO_IC'];
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    
    $CONTROL=$_POST['CONTROL'];
    $INSTRUMENTO=$_POST['INSTRUMENTO'];
    $MARCA=$_POST['MARCA'];
    $MODELO=$_POST['MODELO'];
    $SERIE=$_POST['SERIE'];
    $VIGENCIA=$_POST['VIGENCIA'];
    $CERTIFICADO=$_POST['CERTIFICADO'];
    $DOC=$_POST['DOC'];
$ID_CATALOGO_IC=$_POST['ID_CATALOGO_IC'];
    
    
    
    
  $updateSQL ="UPDATE catalogo_instrumentos_calibarcion SET CONTROL='$CONTROL', INSTRUMENTO='$INSTRUMENTO', MARCA='$MARCA', MODELO='$MODELO', SERIE='$SERIE', VIGENCIA='$VIGENCIA', CERTIFICADO=' $CERTIFICADO', DOC='$DOC' WHERE ID_CATALOGO_IC='$ID_CATALOGO_IC'";

  
  $updateGoTo = "menuICalibracion.html";
 
  header(sprintf("Location: %s", $updateGoTo));
}


$query_instrumentosCalibracion = "SELECT * FROM catalogo_instrumentos_calibarcion where ID_CATALOGO_IC='$ID_CATALOGO_IC'";

$row_instrumentosCalibracion=getArraySQL($query_instrumentosCalibracion);
//$row_instrumentosCalibracion = mysql_fetch_assoc($instrumentosCalibracion);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
<link rel="stylesheet" href="css/ddt.css" />   
<title>Editar Instrumento de Calibracion</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline" style="visibility:hidden">
      <td nowrap="nowrap" align="right">ID_CATALOGO_IC:</td>
      <td><?php echo $row_instrumentosCalibracion[0]['ID_CATALOGO_IC']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">CONTROL:</td>
      <td><input type="text" name="CONTROL" value="<?php echo $row_instrumentosCalibracion[0]['CONTROL']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">INSTRUMENTO:</td>
      <td><input type="text" name="INSTRUMENTO" value="<?php echo $row_instrumentosCalibracion[0]['INSTRUMENTO']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">MARCA:</td>
      <td><input type="text" name="MARCA" value="<?php echo $row_instrumentosCalibracion[0]['MARCA']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">MODELO:</td>
      <td><input type="text" name="MODELO" value="<?php echo $row_instrumentosCalibracion[0]['MODELO']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SERIE:</td>
      <td><input type="text" name="SERIE" value="<?php echo $row_instrumentosCalibracion[0]['SERIE']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">VIGENCIA:</td>
      <td><input type="date" name="VIGENCIA" value="<?php echo $row_instrumentosCalibracion[0]['VIGENCIA']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">CERTIFICADO:</td>
      <td><input type="text" name="CERTIFICADO" value="<?php echo $row_instrumentosCalibracion[0]['CERTIFICADO'] ?>" size="32" /></td>
    </tr>
    <tr valign="baseline" style="visibility:hidden">
      <td nowrap="nowrap" align="right">DOC:</td>
      <td><input type="text" name="DOC" value="<?php echo $row_instrumentosCalibracion[0]['DOC']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><input type="button" value="Cancelar" onclick="window.location.href='menuICalibracion.php'" class="boton boton-secundario"/></td>
      <td><input type="submit" value="Actualizar"  class="boton boton-primario"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="ID_CATALOGO_IC" value="<?php echo $row_instrumentosCalibracion[0]['ID_CATALOGO_IC']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>

