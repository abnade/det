<?php

include ('../../php/conn/conJSON.php');



$PHYSICIAN_idPHYSICIAN=$_POST['PHYSICIAN_idPHYSICIAN'];
$PATIENT_idPATIENT=$_POST['PATIENT_idPATIENT'];

$imgBase64=$PHYSICIAN_idPHYSICIAN.'ID_PHYSICIAN'.$_POST['imgBase64'];

$sql="UPDATE patient SET PATIENTsignature='$imgBase64' WHERE idPATIENT='$PATIENT_idPATIENT'";

$myArray = updateArraySQL($sql);

echo json_encode($myArray); 

//echo $imgBase64;
?>