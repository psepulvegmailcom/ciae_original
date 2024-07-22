
	
	
	if(!validacionCampoTextoSimple('form_email'))
	{
		return false;
	} 
	var tipo_contrata = emptyCheckValue('form_id_tipo_contrato');
	if(!validacionCampoCheckedSimple('form_id_tipo_contrato'))
	{  
		return false;
	}
	else
	{  
		if( (tipo_contrata == 'planta_universidad' || tipo_contrata == 'contrata_universidad'  || tipo_contrata == 'honorario_universidad') && document.getElementById('form_id_tipo_contrato_facultad').value == 'CIAE' )
		{
			mostrarAlertCampoFaltante('form_id_tipo_contrato_facultad');	
			return false;
		}
	} 
	
	if(tipo_contrata == 'planta_universidad' || tipo_contrata == 'invitado_nacional' || tipo_contrata == 'invitado_extranjero' || tipo_contrata == 'sin_vinculo_universidad'  )
	{
			selectValue('form_cargo_gestion','No aplica');
	}
	if(tipo_contrata != 'invitado_extranjero')
	{
		if(!validacionCampoTextoSimple('form_rut')  )
		{
			return false;
		} 
		if(!validacionCampoTextoSimple('form_rut_dv')  )
		{
			return false;
		} 
		if(!revisaRut(document.main.form_rut.value,document.main.form_rut_dv.value))
		{
			alert('Formato rut incorrecto');
			document.main.form_rut.focus();
			return false;
		} 
 
		if(trim(document.main.archivo_rut_original.value) == '' && trim(document.main.form_archivo_rut.value) == '')
		{
			alert('Debe ingresar archivo de rut escaneado');
			return false;
		}		
	} 
	
	
	if(!validacionCampoTextoSimple('form_cargo_gestion'))
	{
		return false;
	}
	 
	if(trim(document.main.archivo_cv_original.value) == '' &&   trim(document.main.form_archivo_cv.value) == '')
	{
		alert('Debe ingresar archivo de cv');
		return false;
	} 
	
	if(tipo_contrata == 'invitado_extranjero')
	{			
		if(!validacionCampoTextoSimple('form_pasaporte'))
		{
			return false;
		}
		
	} 
	
	if(trim(document.main.form_pasaporte.value) != '' )
	{	
		if(trim(document.main.archivo_pasaporte_original.value) == '' && trim(document.main.form_archivo_pasaporte.value) == '')
		{
			alert('Debe ingresar archivo de pasaporte');
			return false;
		} 
	}
	
	if(!validacionCampoTextoSimple('form_nombre'))
	{
		return false;
	}
	if(!validacionCampoTextoSimple('form_apellido_paterno'))
	{
		return false;
	}
	if(!validacionCampoTextoSimple('form_apellido_materno'))
	{
		return false;
	}
	<!-- START BLOCK : bloque_validacion_datos_ficha_honorarios -->
	if(!validacionCampoCheckedSimple('form_genero'))
	{
		return false;
	}   
	if(!validacionCampoTextoSimple('form_fecha_nacimiento'))
	{
		return false;
	}		
	if(!validacionCampoTextoSimple('form_direccion'))
	{
		return false;
	}		
	if(!validacionCampoTextoSimple('form_telefono'))
	{
		return false;
	}		
	if(tipo_contrata != 'invitado_extranjero')
	{
		if(!validacionCampoTextoSimple('form_cargo_gestion'))
		{
			return false;
		}
	}
	<!-- END BLOCK : bloque_validacion_datos_ficha_honorarios -->
	
	