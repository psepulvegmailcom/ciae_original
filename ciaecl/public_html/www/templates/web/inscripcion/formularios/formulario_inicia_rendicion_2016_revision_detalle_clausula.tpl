 		 		  
 
		 

		var estado_envio_formulario = true;
        var seleccion_situacion = emptyCheckValue('form_inicia_situacion_academica'); 
        var seleccion_sede 		= emptyCheckValue('form_inicia_rendicion_sede'); 
        var seleccion_carrera 	= checkSelectedMultipleValue('form_inicia_situacion_academica_carrera'); 
   		var mensaje 			= document.getElementById('mensaje_clausulas').innerHTML;  
		  
		
		if(!estado_envio_formulario)
		{
			showAlert(mensaje);
			return false;
		} 

			