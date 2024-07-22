function clearcookies()
{

}

/********************************************RELOJ ONLINE ***************************/
function checkTime(i)
{
	if (i<10) 
	  {i="0" + i;}
	  return i;
}
function startTime()
{ 
	var today=new Date();
	var h=today.getHours();
	var m=today.getMinutes();
	var s=today.getSeconds();
	var d= checkTime(today.getDate());
	var me= checkTime(today.getMonth()+1);
	var y= today.getFullYear();
	
	// add a zero in front of numbers<10
	m=checkTime(m);
	s=checkTime(s);
	document.getElementById('online_clock').innerHTML = d+"-"+me+"-"+y+" "+h+":"+m+":"+s;
	t=setTimeout('startTime()',500);
}

function hacerTiempo(tiempo)
{
	for (var k=0;k < tiempo; k++)
	{ 
		;
	}
}

/******************************************** FUNCIONES DE RUT ***************************/
 
function esDigito(c)
{
	var test= "" + c;
	if (test == "0" || test == "1" || test == "2" || test == "3" || test == "4" || test == "5" || test == "6" || test == "7" || test == "8" || test == "9")
	{
		return true;
	}
	return false;
}
function esDigitoVerificadorValido(c)
{
	var test= "" + c;
	if (test == "0" || test == "1" || test == "2" || test == "3" || test == "4" || test == "5" || test == "6" || test == "7" || test == "8" || test == "9" || test == "k" || test == "K")
	{
		return true;
	}
	//alert ("DÌgito verificador inv·lido");
	return false;
}
function esRutValido(s)
{
	var test = "" + s;
	for (var k=0;k < test.length; k++)
	{
		var c=test.substring(k,k+1);
		if (esDigito(c)==false)
		{
			//alert ("Rut inv·lido");
			return false;
		}
	}
	return true;
}
function calculaDigitoVerificador(rut)
{
	var test = "" + rut;
	var total=0;
	var i=2;
	for (var k=test.length;k > 0; k--)
	{
		var c=test.substring(k-1,k);
		if (i==8)
		{
			i=2;
		}
		total+=parseInt(c)*i
		i++;
	}
	if ((11-(total-(Math.floor(total/11)*11)))==11){
		return 0;
	}
	else{
		return (11-(total-(Math.floor(total/11)*11)));
	}
}
function revisaRut(rut,dv)
{ 
	if(isNumber(rut)==false)
	{		
		return false;
	}
	if (esRutValido(rut)==false)
		return false;
	if (esDigitoVerificadorValido(dv)==false)
		return false;
	if (calculaDigitoVerificador(rut)==10)
	{
		var test=""+dv;
		if ((test != "K")&&(test != "k"))
		{
			//alert ("Rut inv·lido");
			return false;
		}
	}
	else 
	{
		if (calculaDigitoVerificador(rut)!=dv)
		{
			//alert ("Rut inv·lido");
			return false;
		}
	} 
	return true;	
}

function setDV(input_name)
{
	var input_rut = input_name+'_rut';
	var input_dv  = input_name+'_dv';
	
	var rut_object = searchElement(input_rut);
	var dv_object  = searchElement(input_dv);
	
	if(rut_object.value != '')
	{		
		if(esRutValido(rut_object.value)==true)
		{
			var dv = calculaDigitoVerificador(rut_object.value);
			dv_object.value = dv;
		}
		else
		{
			alert('Debe Ingresar rut v·lido');
		}
	}
}
 

/********************************************LIMPIEZA INICIAL PARA EVITAR QUE SE VEA LINK ***************************/
function hidestatus()
{
	window.status=''
	return true
}
if (document.layers)
	document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT );
document.onmouseover=hidestatus;
document.onmouseout=hidestatus;
/******************************************************************************************************************************/
function invString(message1)
{
	var message2="";

	for (count = message1.length; count >= 0; count--)
		message2 += message1.substring(count,count-1);
  
  return message2;
}
/****************************************INVERTIR FORMATO FECHA*****************************************/
function invDate(dateInfo)
{
	var formato = 1;
	return invFecha(formato,dateInfo);
}

/* Validacin de fecha mayor by Mauricio Escobar

Este script y otros muchos pueden descarse on-line de forma gratuita en El Cdigo: www.elcodigo.com

Formato de la fecha
 1 = DD/MM/YYYY
 2 = MM/DD/YYYY   
 3 = YYYY/MM/DD
 4 = YYYY/DD/MM

    invierta una fecha dada retornando en formato YYYYMMDD  
	dFecIni = Fecha a invertir 
	nTipFormat = Formato en que biene la fecha
             1 = DD/MM/YYYY
             2 = MM/DD/YYYY   
             3 = YYYY/MM/DD
             4 = YYYY/DD/MM
*/
function invFecha(nTipFormat,dFecIni)
{
	var separador = "-";
   var dFecIni = dFecIni.replace(/-/g,"/");               // reemplaza el - por /   
   
   // primera division fecha
   var nPosUno = ponCero(dFecIni.substr(0,dFecIni.indexOf("/")));
   // 2 divicion fecha
   var nPosDos = ponCero(dFecIni.substr(parseInt(dFecIni.indexOf("/")) + 1,parseInt(dFecIni.lastIndexOf("/")) - parseInt(dFecIni.indexOf("/")) - 1));
   // 3 divicion fecha
   var nPosTres = ponCero(dFecIni.substr(parseInt(dFecIni.lastIndexOf("/")) + 1));

   switch(nTipFormat)
   {
      case 1 :   //   DD/MM/YYYY
         dReturnFecha = nPosTres + separador + nPosDos + separador + nPosUno;
         break;

      case 2 :   //   MM/DD/YYYY
         dReturnFecha = nPosTres + separador + nPosUno + separador +nPosDos;
         break;

      case 3 :   //   YYYY/MM/DD
         dReturnFecha = nPosUno + separador + nPosDos + separador +nPosTres;
         break;
   
      case 4 :   //   YYYY/DD/MM
         dReturnFecha = nPosUno + separador + nPosTres +separador +nPosDos;
         break;
   }
   
   return dReturnFecha;   // retorna la fecha    
}

// Agrega un cero delante del strPon cuando tenga solo un caracter
function ponCero(strPon){
   if(parseInt(strPon.length) < 2)
      strPon = "0" + strPon;
   return strPon;
}
/******************************************FUNCIONES PROPIAS DEL SISTEMA*******************************/
/*funciones de posicion de div dentro de la ventana */
function getWidthWindow()
{
	return getSizeWindow('width');
}

function getHeightWindow()
{
	return getSizeWindow('height');
}

function getSizeWindow(type)
{
	var winW = 0; var winH = 0;

	 if (document.all) 
	 {
		  winW = document.body.offsetWidth;
		  winH = document.body.offsetHeight;
	 }
	 else
	 {
		  winW = window.innerWidth;
		  winH = window.innerHeight;
	 }
	
	if(winH == 0)
		winH = 500;
		
	//alert(winH+' '+winW)
		

	if(type == 'width')
		return winW;
	else
		return winH;
}

function centerPositionDiv(id)
{
	
	var newWW = Math.ceil(getWidthWindow()/3);
	var newWH = Math.ceil(getHeightWindow()/3.5);
	
	var newW = parseInt(document.getElementById(id).style.width);
	var newH = parseInt(document.getElementById(id).style.height);
	
	
	var newDW = Math.ceil((getWidthWindow()-newW)/2);
	var newDH = newWH;
	
	document.getElementById(id).style.left = newDW+'px';
	document.getElementById(id).style.top = newDH+'px';
	
	//alert(newW+ ' '+newDW + ' ' +newDH);
}


/******************************************************************************************************************************/  
function openLink(linkFile) 
{
	window.open(linkFile); 
}

function cleanSelect(inputSelect)
{		
	var r = inputSelect;
	
	for(i=0; i < r.length ; i++)
	{
		if( r[i].selected )
				r[i].selected = false;			
	}	
}


function cleanCheck(inputCheck)
{
	var r = inputCheck;
	if( r.checked )
		r.checked = false;
		
	if(r.defaultChecked)
		r.defaultChecked=false;
}


function idVisibility(id)
{  
	if( document.getElementById(id).style.visibility == "hidden" ) 
	{
		showId(id);
	}
	else 
	{
		hiddenId(id);
	}
}    

function showVentanaInterna(id)
{
	showId(id);
	var width 									= getWidthWindow()-80;
	var height 									= getHeightWindow()-70; 
	document.getElementById(id).style.height 	= height+"px";
	document.getElementById(id).style.width 	= width+"px";
}

function showId(id)
{	
	if(document.getElementById(id))
	{
	    document.getElementById(id).style.visibility 	= "visible"; 
		document.getElementById(id).style.display		= 'block';
		document.getElementById(id).style.height 		= 'auto';
	}
}

function hiddenId(id)
{	
	if(document.getElementById(id))
	{
		if (document.all)		
	    {
			document.getElementById(id).style.display 		= 'none';	
		}
		else
	    {
			document.getElementById(id).style.visibility 	= "hidden";	
		}
		document.getElementById(id).style.height 			= '0px';
	}
}

function gotoHref(id)
{
	document.location.href = "#"+id;
}

/*MUESTRA Y ESCONDE LAS FILAS*/
function hidetr(id) 
{
	document.getElementById(id).style.display = 'none';
	document.getElementById(id).style.height 			= '0px';
}

function showtr(id)
{			
	if (document.getElementById(id)) 
	{
		if (document.all)
			document.getElementById(id).style.display= 'block';
		else
			document.getElementById(id).style.display = 'table-row';
	}
		document.getElementById(id).style.height 		= 'auto';
}

function searchElement(name)
{
	var x = document.main.elements;	
	for (var i=0 ; i < x.length ; i++)
	{			    
		if(x[i].name == name )
		{			
			return x[i];								
		}
	}
	return false;
}

/* SE REVISA SI EL INPUT.CHECKBOX TIENE AL MENOS UN ELEMENTO SELECCIONADO */
function emptyCheck(name)
{ 
	var x 		= document.main.elements;	 
	for (var i=0 ; i < x.length ; i++)
	{		
		if(x[i].name == name && x[i].checked)
		{
			return  true;								
		}
	}
	return false;
}

function checkInputAll(name)
{	
	var x = document.main.elements;	 
	for (var i=0 ; i < x.length ; i++)
	{		
		if(x[i].name == name )
			x[i].checked = true;								
	}
	return false;
}

function uncheckInputAll(name)
{	
	var x = document.main.elements;	
	for (var i=0 ; i < x.length ; i++)
	{			 
		if(x[i].name == name )
			x[i].checked = false;								
	}
	return false;
}
 

function searchParentElement(name)
{ 
	var x = window.opener.document.main.elements;	
	for (var i=0 ; i < x.length ; i++)
	{			
		if(x[i].name == name )
		{
			return x[i];						
		}
	}
	return false;
}

function checkSelectedMultiple(inputSelect)
{	
	var r = searchElement(inputSelect);	  
	for(i=0; i < r.length ; i++)
	{
		if( r[i].selected )
		{
			return true;			
		}
	}	
	return false;
}

function selectInputAll(inputSelect)
{
	var origen=searchElement(inputSelect+'[]');
	origenlen = origen.length ; 
	var hayElem = false;
    for ( i=0; i< origenlen ; i++)
	{
	   origen.options[i].selected = true;	   
	   hayElem = true;	   
    }
	return hayElem ;
}

function unselectInputAll(inputSelect)
{
	var origen=searchElement(inputSelect+'[]');
	origenlen = origen.length ; 
	var hayElem = false;
    for ( i=0; i< origenlen ; i++)
	{
	   origen.options[i].selected = false;	   
	   hayElem = true;	   
    }
	return hayElem ;
}

function changeFormValue(variable,value)
{
	var elem = searchElement(variable);
	if(elem) /* confirmar que efectivamente se encontro la estructura buscada */
	{
		if(elem.type == 'select-one')
			selectValue(variable,value);
		else
			elem.value = value;
	}
}

function changeTextId(variable,valor)
{	
	 
	if( document.getElementById(variable))
	{
		if( document.getElementById(variable).style.visibility == "hidden" )
		{
			showId(variable);
		}
		document.getElementById(variable).innerHTML	= valor;
	} 
}


function checkedValue(variable,value)
{		
	var x 		= document.main.elements;		
 
	for (var i=0 ; i < x.length ; i++)
	{			    
		if(x[i].name == variable   && x[i].value == value)
		{						 
			x[i].checked = true;									
		}
	}	
}

function selectValue(variable,value)
{		
	var r =  searchElement(variable);  
	if(r)
	{
		for(i=0; i < r.length ; i++)
		{ 			
			if( r[i].value == value )
			{
				r[i].selected = true;			 
			}
			else			
			{
				r[i].selected = false;	
			}
		}
	}
}


/*
FUNCIONES DE SELECT MULTIPLE

function moverOrigenADestino: exige recibir el nombre de 2 select multiple del form, y mueve lo que esta seleccionado del select origen al de destino
	origen => el nombre del selet de origen
	destino => nombre del select de destino

*/
function moverOrigenADestino(origen,destino)
{
	
	var m1=searchElement(origen);
	var m2=searchElement(destino);
	
	m1len = m1.length ; 
    for ( i=0; i< m1len ; i++)
	{
        if (m1.options[i].selected == true ) 
		{
            m2len = m2.length;
            m2.options[m2len]= new Option(m1.options[i].text,m1.options[i].value);
        }
    }

    for ( i = (m1len -1); i>=0; i--)
	{
        if (m1.options[i].selected == true ) 
		{
            m1.options[i] = null;
        }
    }
}

function enviarMultipleSelect(option,action,inputSelect)
{
	selectInputAll(inputSelect);
	process(option,action);
}

function checkMail(x)
{
	if(isEmpty(x))
		return false;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (filter.test(x))
		return true;
	else 
		return false;
} 

function trim(cadena)
{
 
	 if(cadena)
	 {
		for(var i=0; i<cadena.length; i++ )
		{
			if(cadena.charAt(i)==" ")
				cadena=cadena.substring(i+1, cadena.length);
			else
				break;
		}
	
		for(var i=cadena.length-1; i>=0; i=cadena.length-1)
		{
			if(cadena.charAt(i)==" ")
				cadena=cadena.substring(0,i);
			else
				break;
		}
	 }
	return cadena;	
}

function isDefined( variable)
{
    return (typeof(window[variable]) == "undefined")?  false: true;
}

function isEmpty(valor){
	
	valor = trim(valor);
	if(valor == '')
		return true;
	else
		return false;
}
  
function hasEmpty(texto)
{ 
	if(texto)
	{
		var espacio = texto.indexOf(' ');	
		if(espacio == -1)
			return false;
		else
			return true; 
	}
}

function hasAcentosComilla(s)
{ 
	if(hasEmpty(s) || isEmpty(s))
		return false;
		
  	var ValidChars = '·ÈÌÛ˙¡Õ…⁄”"Ò—';
	for (var i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);		
        if (ValidChars.indexOf(c) > -1) {			 
			return true;
	  	}        
    }	
	return false;
}
 
  
 
function isNumber(s)
{
	if(s)
	{
		if(hasEmpty(s) || isEmpty(s))
			return false;
			
		var ValidChars = '0123456789';
		for (var i = 0; i < s.length; i++)
		{   
			var c = s.charAt(i);
			
			if (ValidChars.indexOf(c) == -1) {
				 
				return false;
			}
			
		}	
		
		return true;
	}
	return false;
}


function textCounter(field, countfield, maxlimit) 
{ 
	
	var field = searchElement(field);
	if (field.value.length > maxlimit)  
	{
		field.value = field.value.substring(0, maxlimit);
	}
	else 
	{
		$(countfield).innerHTML  =  '<small>'+ field.value.length+' caracteres de un m·ximo de '+ maxlimit+'</small>';
	}
}

function showAlert(msg)
{
	
	alert(msg);
	
}

function showTooltip(id,msg,title_msg)
{  
	new Tip(id, msg, {title : ''+title_msg+''});	 
}

function crearOptionASelect(nombre,valor,texto)
{
	var theSelect 	= searchElement(nombre);  
	var obj 		= document.createElement('option');
	var value     	= ''; 	
	obj.text 		= texto;
	obj.value 		= valor;  
	obj.selected 	= true; 
	theSelect.options[0] = obj; 
}


function abrirVentanaInterna(opciones)
{
	showVentanaInterna('ventanaInternaDatosSpin');	  
	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();       
	ajax.open("POST", url , true);
	ajax.onreadystatechange=function()
	{
	   if (ajax.readyState==4)
	   {	 
			var salida 	= ajax.responseText;  
			document.getElementById('ventanaInternaDatos').innerHTML = salida;
			showVentanaInterna('ventanaInternaDatos');
			hiddenId('ventanaInternaDatosSpin'); 		 
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE()); 
}


 