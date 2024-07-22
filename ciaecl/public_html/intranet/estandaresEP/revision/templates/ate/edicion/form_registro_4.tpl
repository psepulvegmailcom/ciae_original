  

<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_edicion_generico.tpl -->
 
 

function chequeoTipoDatosEdicion()
{ 	 
	var variables 	= new Array();	
	var mensajes 	= new Array();
	var revision 	= true;
	var j=0;
	variables[j] 	= 'ate_oferta_nivel[]';
	mensajes[j] 	= "Debe seleccionar al menos una alternativa de niveles y tipo de establecimiento que atiende";
	j++;
	variables[j] 	= 'ate_oferta_zona[]';
	mensajes[j] 	= "Debe seleccionar al menos una alternativa de Tipo de Zona Geográfica";
	j++;
	variables[j] 	= 'ate_oferta_personas[]';
	mensajes[j] 	= "Debe seleccionar al menos una alternativa de Beneficiarios directos del servicio";
	j++;
	variables[j] 	= 'ate_oferta_servicio[]';
	mensajes[j] 	= "Debe seleccionar al menos una alternativa de Tipo de servicio";
	j++;
	variables[j] 	= 'ate_oferta_metodologia[]';
	mensajes[j] 	= "Debe seleccionar al menos una alternativa de Metodolog&iacute;a Empleada";
	j++;
	variables[j] 	= 'ate_oferta_programa[]';
	mensajes[j] 	= "Debe seleccionar al menos una alternativa de Área(s) de Asistencia Técnica";
	 
	for (var i=0 ; i < variables.length ; i++)
	{  
		if(!emptyCheck(variables[i]))
		{
			showAlert(mensajes[i]); 
			return false; 
		} 	 
	} 

				return true;

	/*****************************************************************************************
		SE REVISA QUE EL OFERENTE AL MENOS HAYA 
		SELECCIONADO UNA COMUN COMO COBERTURA
	******************************************************************************************/
 	var valores 	= '';    
	var opciones 	= 'caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&opcion=edicionseleccioncomunas&needlogin=1&'+valores; 

	var url 		= 'indexExt.php'; 
	var ajax 		= objetoAjax();      
	ajax.open("POST", url , true);
	   		 
	ajax.onreadystatechange = function()
	{
	   if (ajax.readyState == 4  )
	   {	  
	   		var salida = ajax.responseText;
			if(salida == 0)
			{
				showAlert('Debe seleccionar al menos una comuna de cobertura');			
				return  false;
			} 
			else
			{
				return true;
			}
			return salida;
	   }
	}           
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(opciones+repairAjaxIE());   	
  
} 