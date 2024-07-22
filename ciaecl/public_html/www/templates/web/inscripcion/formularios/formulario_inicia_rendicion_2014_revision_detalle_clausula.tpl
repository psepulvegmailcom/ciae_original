 		 		  
 
		if(trim(document.main.rut_consultado.value) != '')
		{   
			if(document.main.inicia_rendicion_estado_asistencia.value == 'nocumple' || document.main.inicia_rendicion_estado_inscripcion_anterior.value == '2014-ValidacionPruebaINICIA_nocumple')
			{ 
				showAlert("Lamentablemente, seg&uacute;n nuestros registros, ud NO CUMPLE con los requisitos por lo que no puede participar en esta actividad. Gracias por su comprension");
				return false;
			}  
			if(document.main.inicia_rendicion_estado_asistencia.value == 'incompleto' || document.main.inicia_rendicion_estado_asistencia.value == 'completo')
			{ 
				showAlert("IMPORTANTE: Segun nuestros registros UD ya participo previamente en esta actividad en alguna de las fechas anteriores, revisaremos su caso particular y le avisaremos si puede volver a participar en esta nueva fecha. La posibilidad de que ud pueda volver a participar o no de esta actividad, tiene que ver con la version de prueba que ud haya rendido previamente, ya que no pueden ser repetidas. Nos comunicaremos con ud para avisarle cual es su situacion en particular. Le agradecemos su interes.");
				document.main.form_tipo_inscripcion.value ='2014-ValidacionPruebaINICIA_nuevo_junio_r';
			}
		} 

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

			