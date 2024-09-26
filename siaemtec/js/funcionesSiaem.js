// JavaScript Document
function servicioI_E(value) // Funcion que deshabilita el Campo del Nombre de Ingeniero 
//Externo en caso de ser un servicio Interno

{
	if(value=='NO')
	{
	document.getElementById('ING_EXTERNO').value="    NO APLICA";
	document.getElementById('ING_EXTERNO').style.color = "#ff0000";
	document.getElementById('ING_EXTERNO').readOnly= true;
	
	document.getElementById('EMPRESA').value="    NO APLICA";
	document.getElementById('EMPRESA').style.color = "#ff0000";
	document.getElementById('EMPRESA').readOnly= true;
	
	
	
	}
	//disabled-siaem
	else {
	document.getElementById('ING_EXTERNO').value="";
	document.getElementById('ING_EXTERNO').style.color = "black";
	document.getElementById('ING_EXTERNO').readOnly=false;
	document.getElementById('ING_EXTERNO').className="" ;	
	document.getElementById('EMPRESA').value="";
	document.getElementById('EMPRESA').style.color = "black";
	document.getElementById('EMPRESA').readOnly=false;
	document.getElementById('EMPRESA').className="" ;	
    document.getElementById("ING_REALIZA").options[18].selected = 'selected';
		
		
		
		}
	
	
	
	
	
	
	}
	
	
	function consultaInventario() // Funcion que deshabilita el Campo del Nombre de Ingeniero 
//Externo en caso de ser un servicio Interno
{
//	alert('hola')
window.open("consutaInventario.php", "popupId", "location=no,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=700,height=500");
	
	}
	
	
	///////////
	function consultaInventario1() // Funcion que deshabilita el Campo del Nombre de Ingeniero 
//Externo en caso de ser un servicio Interno
{
	document.getElementById("tabla_equipo").style.display='inline';
	window.open("consutaInventario_off.php", "popupId", "location=no,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=700,height=500")
//	alert('hola')
//window.open("consutaInventario_off.php", "popupId", "location=no,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=700,height=500");
	
	}
	
	
	///////////
	function consultaInventario1_off() // Funcion que deshabilita el Campo del Nombre de Ingeniero 
//Externo en caso de ser un servicio Interno
{
	document.getElementById("tabla_equipo").style.display='inline';
	window.open("consutaInventario_off.php", "popupId", "location=no,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=700,height=500")
//	alert('hola')
//window.open("consutaInventario_off.php", "popupId", "location=no,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=700,height=500");
	
	}
	
	
	/////////////
	
	
	 function insertarInventario(idequipo,equipo,nocontrol,noinventario,marca,modelo,serie,idarea,area,ext) {
/*
 window.opener.document.getElementById('ID_EQUIPO').value=idequipo;
 window.opener.document.getElementById('EQUIPO').value=equipo;
 window.opener.document.getElementById('NOCONTROL').value=nocontrol;
 window.opener.document.getElementById('NOINVENTARIO').value=noinventario;
 window.opener.document.getElementById('MARCA').value=marca;
 window.opener.document.getElementById('MODELO').value=modelo;
 window.opener.document.getElementById('SERIE').value=serie;
 window.opener.document.getElementById('ID_AREA').value=idarea;
 window.opener.document.getElementById('AREA_SERVICIO').value=area;
 window.opener.document.getElementById('EXTENSION').value=ext;
 window.opener.document.getElementById("ABIERTA").disabled= false;
 window.opener.document.getElementById("TRANSITO").disabled= false;*/
	   
 this.window.close();
 }
 
  function insertarInventario_off(idequipo,equipo,nocontrol,noinventario,marca,modelo,serie,idarea,area,servicio, ext) {
/*
 window.opener.document.getElementById('ID_EQUIPO').value=idequipo;
 window.opener.document.getElementById('EQUIPO').value=equipo;
 window.opener.document.getElementById('NOCONTROL').value=nocontrol;
 window.opener.document.getElementById('NOINVENTARIO').value=noinventario;
 window.opener.document.getElementById('MARCA').value=marca;
 window.opener.document.getElementById('MODELO').value=modelo;
 window.opener.document.getElementById('SERIE').value=serie;
 window.opener.document.getElementById('ID_AREA').value=idarea;
 window.opener.document.getElementById('AREA_SERVICIO').value=area;
 window.opener.document.getElementById('UBICACION').value=servicio;
 window.opener.document.getElementById('EXTENSION').value=ext;
 */
 // Estoy aqui
/* window.opener.document.getElementById("ABIERTA").disabled= false;
 window.opener.document.getElementById("TRANSITO").disabled= false;
 window.opener.document.getElementById("ESTADO").value="CERRADA";
	   
 this.window.close();*/
 }
 
 
 function uncheck(id)
 {
	
	 document.getElementById(id).checked = false; 
	  }
	  
	   function changeIcon(id)
 {
	
//alert('Hola')
	  document.getElementById(id).src='images/iconDevice2.png';
	  document.getElementById(id).src='images/iconDevice2.png';
	  }
 function verificarEstado(val)
 {

	if (val=='CERRADA'){
		document.getElementById('tabla_servicio').style.display='inline' 
		document.getElementById("REFACCIONES").required= true;
		document.getElementById("FECHA_SERVICIO").required= true; 
		document.getElementById("TIPO_EXTERNO").required= true;
		document.getElementById("DETALLE_SERVICIO").required= true;
		document.getElementById("ING_REALIZA").required= true;
	 }
	
	else{
	document.getElementById('tabla_servicio').style.display='none';
	document.getElementById("REFACCIONES").required= false;
	document.getElementById("FECHA_SERVICIO").required= false;
	document.getElementById("TIPO_EXTERNO").required= false; 
    document.getElementById("DETALLE_SERVICIO").required= false;
	document.getElementById("ING_REALIZA").required=false;	//document.getElementById('css3-tabstrip-0-1').disabled=false;
	
	  }
   }
   
   function reflect(id,value)
   {
	   
	   document.getElementById(id).value= value; 
 }
 // --------------------- FUNCION EN AJAX PARA INICIAR ORDEN DE SERVICIO----------//
 
 
function sesionOrden(ID_ORDEN_SERVICIO,NO_ORDEN)

 {  //alert(ID_ORDEN_SERVICIO+''+NO_ORDEN)
 		
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.open("GET","sesionOrden.php?ID_ORDEN_SERVICIO="+ID_ORDEN_SERVICIO+'&NO_ORDEN='+NO_ORDEN,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()
	
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
   {
	<!--document.getElementById("pacienteSel").innerHTML= 'usted a seleccionado el FOLIO'+ FOLIO;-->
	
	//location.href= pagina; 

    }
  }
  
}
 
//**************INSERTAR REPORTE***************////

 function insertarReporte(DATOS_REPORTE)
 //ID_REPORTE,FECHA,HORA,AREA_SERVICIO,EQUIPO,REPORTA, EXT,FALLA) 
{
	// alert(DATOS_REPORTE);
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.open("GET","sesionDATOS_REPORTE.php?DATOS_REPORTE="+DATOS_REPORTE,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()
	
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
   {
	<!--document.getElementById("pacienteSel").innerHTML= 'usted a seleccionado el FOLIO'+ FOLIO;-->
	
	//location.href= pagina; 

    }
  }
	   

 } 
 
 function dictamen(val) // Funcion para enviar y llenar el formulario de dictamen
   {
	  // alert(value)  
	  var value= val.search('DICTAMEN TECNICO');
	   if (value !=-1)
	    { // BANDERA EN DICTAMEN PARA ENVIAR AL FORMULARIO DE DICTAMEN EN VEZ DE MENU PRINCIPAL  
		document.getElementById('Dictamen').value='Activo';
		}

	}
 // --------------------- FUNCION EN AJAX PARA INICIAR ORDEN DE SERVICIO----------//
 
 
function sesionEquipo(ID_EQUIPO) {  
 	
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.open("GET","sesionEquipo.php?ID_EQUIPO="+ID_EQUIPO,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()
	
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
   {
	<!--document.getElementById("pacienteSel").innerHTML= 'usted a seleccionado el FOLIO'+ FOLIO;-->
	
	//location.href= pagina; 

    }
  }
  
}
function reporteAtendido(idreporte,val){

	
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.open("GET","atendioReporte.php?idreporte="+idreporte+'&val='+val,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()
	
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
   {
	<!--document.getElementById("pacienteSel").innerHTML= 'usted a seleccionado el FOLIO'+ FOLIO;-->
	
	//location.href= pagina; 

    }
  }
	
	
	
}


function enterado(idreporte){

	
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.open("GET","enteradoReporte.php?idreporte="+idreporte,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()
	
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
   {
	

    }
  }
	
	
	
}


function  reportes(tipo){
	
	
	if (tipo=='hoy'){
	document.getElementById('reportes_hoy').style.display='inline';
	document.getElementById('reportes_pasados').style.display='none';
	
	
	}
	else if(tipo=='pasados'){
		
	document.getElementById('reportes_hoy').style.display='none';
	document.getElementById('reportes_pasados').style.display='inline';
	
	}
	
}


function consultaInstrumentos() // Funcion que deshabilita el Campo del Nombre de Ingeniero 
//Externo en caso de ser un servicio Interno
{
//	alert('hola')
window.open("InstrumentosCalibracion.php", "popupId", "location=no,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=700,height=500");
	
	}
	
	 function insertarIC(instrumentos) {

 window.opener.document.getElementById('INSTRUMENTOS').value=instrumentos;

	   
 this.window.close();
 }
 