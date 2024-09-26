<?php 
 $USER_EMAIL =$_POST['user'];
 $USER_PASSWORD  = $_POST['pass'];


include_once('connection/conJSON.php');
include_once('cookies/cookies.php');

    
$sql="SELECT * FROM usuarios WHERE CORREO='$USER_EMAIL' AND PASSWORD='$USER_PASSWORD'";



        $myArray = getArraySQL($sql);
 
        
		$numero_filas = count($myArray);

        $login_result["pass"]="";
        $login_result["rol"]="";
       
        

        if($numero_filas>0){
            
            $login_result["pass"]="true";
          /*  $login_result["rol"]=$myArray[0]["PHYSICIANrol"];
            $login_result["token"]="";*/
            $login_result["iduser"]= $myArray[0]["ID_USUARIOS"];
            $login_result["username"]= $myArray[0]["NOMBRES"].' '.$myArray[0]["APELLIDOS"];
           /* $login_result["center"]= $myArray[0]["PHYSICIANcenter"];*/
            makingCookies($login_result);

            
                echo json_encode($login_result);
            }else{
                echo json_encode('false');
            }
        //echo  '{"data":'. json_encode($myArray).'}';
		//echo  'queryRecordCount'. $número_filas;
		//echo  ',"totalRecordCount":'. $número_filas. '}';*/

?>