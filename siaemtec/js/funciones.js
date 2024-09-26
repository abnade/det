
var CODIGO_SERVICIO='';
var CODIGO_AREA='';
var ABREVIACION_EQUIPO=''

function getAreaData(AreaData)/*getAreaData(ID_AREA,CODIGO_DEPARTAMENT,CODIGO_AREA)*/

//['ID_AREA']. '/'.['AREA'].'/'.['SERVICIO']. '/'.['CUERPO'].'/'.['CODIGO_AREA'].'/'.['CODIGO_SERVICIO']?>


{
	
	
	
	var myArray = AreaData.split('^/');
	
		document.getElementById('ID_AREA').value=myArray[0];
		document.getElementById('SERVICIO').value=myArray[1];
		document.getElementById('AREA').value=myArray[2];
		document.getElementById('CUERPO').value=myArray[3];

		CODIGO_AREA=myArray[4];
	    CODIGO_SERVICIO=myArray[5];
 }
function getDeviceData(DevData)/*getDeviceData(ID_EQUIPO,EQUIPO,CLAVE_EQUIPO)*/

{
	if(document.getElementById("DEMOSTRACION").checked){
	DP='DP-';
	}
	else{
	DP='';	
		}
	
	var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		}
	}
    DevData= document.getElementById('select2').value;
	var myArray = DevData.split(',');
	
		document.getElementById('ID_EQUIPO').value=myArray[0];/*ID_Equipo*/
		document.getElementById('EQUIPO').value=myArray[1];/*EQUIPO*/
		    
		ID_AREA=document.getElementById('ID_AREA').value;
		ID_EQUIPO= document.getElementById('ID_EQUIPO').value
		
	
    xmlhttp.open("GET","getDeviceData.php?ID_EQUIPO="+ID_EQUIPO+'&ID_AREA='+ ID_AREA+'&DP='+DP,true);
    xmlhttp.send()	
		
		document.getElementById('submit').style.display='inline'
		
	

 } 
 
function getProveedorData(id)
{
	
		/*var myArray = id.split('^/');
		document.getElementById('ID_PROVEEDOR').value=myArray[0];/*ID_Equipo*/
		/*document.getElementById('PROVEEDOR').value=myArray[1];/*EQUIPO*/
		

 } 
 
 function getLimitantes(val)/* Funcion para verificar los check box activos y colocarlos en un array */
{
 var Limitantes
 	
		
 } 
 
 function Ocultar(id)
 {
	 alert(id)
	 document.getElementById(id).style.visibility = 'hidden';
 }
 
 
function calGarantia(val){
	alert (val)
	
	/*switch(val) {
    case 'INSTALACION':
        {fecha=document.getElementById('FECHA_DE_INSTALACION').value;
	
	//
	anios_g=+document.getElementById("ANIOSGARANTIA").value;
	
	fecha_i=fecha.split("-");
	g=+fecha_i[0]+ anios_g;
	garantia=g+'-'+fecha_i[1]+'-'+fecha_i[2];
	
	document.getElementById('GARANTIA').value=garantia;
	//Llena la vida útil
	instalacion=instalacion.split("-");
	v=+instalacion[0]+5;
	vida_util=v+'-'+instalacion[1]+'-'+instalacion[2];
	document.getElementById('VIDA_UTIL').value=vida_util;
	document.getElementById('v_util').innerHTML=instalacion[2]+'/'+ instalacion[1]+'/'+v;}
        break;
    case 'RECEPCION':
	
	{fecha=document.getElementById('FECHA_RECEPCION').value;
	
	//
	anios_g=+document.getElementById("ANIOSGARANTIA").value;
	fecha_i=fecha.split("-");
	g=+fecha_i[0]+anios_g;
	garantia=g+'-'+fecha_i[1]+'-'+fecha_i[2];
	
	document.getElementById('GARANTIA').value=garantia;
	//Llena la vida útil
	instalacion=instalacion.split("-");
	v=+instalacion[0]+5;
	vida_util=v+'-'+instalacion[1]+'-'+instalacion[2];
	document.getElementById('VIDA_UTIL').value=vida_util;
	document.getElementById('v_util').innerHTML=instalacion[2]+'/'+ instalacion[1]+'/'+v;
        //code block
        break;}
    default:
	alert ('Ingresa valores requeridos')
       // code block
}*/
	
}
 
 
