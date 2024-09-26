<?php
include_once('connection/conJSON.php');
$id=$_POST['ID_DOCUMENTO'];
$no_control=json_decode($_POST['EQUIPOSnoc'],true);
$sql="SELECT * FROM documentos WHERE ID_DOCUMENTO='$id'";
$row=getArraySQL($sql);
$old_control=$row[0]['EQUIPOSnoc'];
$old_control=explode(',',$old_control);
    foreach($no_control as $noc){
        $new_array=array_diff($old_control,[$noc['text']]);
        $old_control=$new_array;
}
$old_control=implode(",",$old_control);
$sql_delete="UPDATE documentos SET EQUIPOSnoc='$old_control' WHERE ID_DOCUMENTO='$id'";
$result=updateArraySQL($sql_delete);
echo json_encode($result);

?>