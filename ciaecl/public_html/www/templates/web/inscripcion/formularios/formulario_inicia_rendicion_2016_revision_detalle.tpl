

	/** ------------------------------------------------------------------------------------------ */
	
	caso_form = 'form_inicia_situacion_academica';
	if(!emptyCheck(caso_form))
	{
		showAlert("Debe indicar situacion academica "); 
		destacarFormularioPendiente(caso_form);
		return false;
	} 		
	else
	{
		destacarFormularioLimpiarPendiente(caso_form);
		var seleccion_situacion = emptyCheckValue(caso_form); 
		if(seleccion_situacion == 'Titulado')
		{    
			caso_form = 'form_inicia_situacion_academica_agno_titulo';
			if(!revisionFormularioSeleccion(caso_form))
			{				
				showAlert('Debe seleccionar fecha de titulacion');   
				return false;
			}   
		} 
	} 
  
  
	if(!revisionFormularioSeleccion('form_inicia_situacion_academica_carrera'))	
	{
		showAlert('Debe seleccionar carrera academica'); 
		return false;
	}   
	
	if(!revisionFormularioTexto('form_inicia_situacion_academica_institucion')) 
	{
		alert('Debe ingresar institucion academica'); 
		return false;
	}   

	/** ------------------------------------------------------------------------------------------ */
	
	if(!revisionFormularioEleccion('form_inicia_situacion_laboral'))
	{
		showAlert('Debe indicar su situacion laboral'); 
		return false;
	}
	else
	{ 
		var seleccion_elemento = emptyCheckValue('form_inicia_situacion_laboral'); 
		if(seleccion_elemento == 'si-trabaja')
		{
			 
			if(!revisionFormularioEleccion('form_inicia_situacion_laboral_colegio_tipo'))	
			{
				showAlert('Debe seleccionar el tipo de colegio donde trabaja'); 
				return false;
			}  
		}
	}
		
	/** ------------------------------------------------------------------------------------------ */
	
	 	
	if(!revisionFormularioEleccion('form_inicia_rendicion_sede'))	
	{
		showAlert('Debe seleccionar la sede de rendicion'); 
		return false;
	} 
     
    if(!revisionFormularioTexto('form_inicia_rendicion_fecha'))	
	{
		showAlert('Debe seleccionar la fecha de rendicion'); 
		return false;
	}  	
	 