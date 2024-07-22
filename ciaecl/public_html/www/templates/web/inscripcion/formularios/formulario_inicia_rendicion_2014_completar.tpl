 
var elemento_auxiliar = '';
var x 		= document.main.elements;	 
for (var i=0 ; i < x.length ; i++)
{		 
	if(x[i].name == 'form_inicia_rendicion_fecha' && trim(document.main.rut_consultado.value) != ''  )
	{ 
		if(document.main.inicia_rendicion_estado_asistencia.value == 'nocumple')
		{
			x[i].disabled = true;  
			x[i].checked = false;  
		}
	}
	elemento_auxiliar = '{inicia_transferencia_tipo}';
	if(x[i].name == 'form_inicia_transferencia_tipo' && trim(elemento_auxiliar) != '' && x[i].value == elemento_auxiliar )
	{ 
		x[i].checked  = true;	
	}
	elemento_auxiliar = '{inicia_transferencia_banco}';
	if(x[i].name == 'form_inicia_transferencia_banco')
	{
		selectedValueSelect(x[i],elemento_auxiliar);
	} 
	elemento_auxiliar = '{inicia_situacion_academica}';
	if(x[i].name == 'form_inicia_situacion_academica' && trim(elemento_auxiliar) != '' && x[i].value == elemento_auxiliar )
	{ 
		x[i].checked  = true;	
	}
	elemento_auxiliar = '{genero}';
	if(x[i].name == 'form_genero' && trim(elemento_auxiliar) != '' && x[i].value == elemento_auxiliar )
	{ 
		x[i].checked  = true;	
	}
	
	elemento_auxiliar = '{nacionalidad}';  
	if(x[i].name == 'form_nacionalidad')
	{
		selectedValueSelect(x[i],elemento_auxiliar);
	} 
	elemento_auxiliar = '{region}';  
	if(x[i].name == 'form_region')
	{
		selectedValueSelect(x[i],elemento_auxiliar);
	} 
	elemento_auxiliar = '{inicia_situacion_academica_carrera}';  
	if(x[i].name == 'form_inicia_situacion_academica_carrera')
	{
		selectedValueSelect(x[i],elemento_auxiliar);
	} 
	elemento_auxiliar = '{inicia_situacion_academica_agno_titulo}';  
	if(x[i].name == 'form_inicia_situacion_academica_agno_titulo' && elemento_auxiliar != '0')
	{
		selectedValueSelect(x[i],elemento_auxiliar);
	} 
	
	elemento_auxiliar = '{inicia_situacion_laboral}';
	var aux = elemento_auxiliar + '-trabaja';
	if(x[i].name == 'form_inicia_situacion_laboral' && trim(elemento_auxiliar) != '' && x[i].value == aux )
	{ 
		x[i].checked  = true;	
	}
	elemento_auxiliar = '{inicia_situacion_laboral_colegio_tipo}';
	if(x[i].name == 'form_inicia_situacion_laboral_colegio_tipo' && trim(elemento_auxiliar) != '' && x[i].value == elemento_auxiliar )
	{ 
		x[i].checked  = true;	
	}
	elemento_auxiliar = '{inicia_rendicion_sede}';
	if(x[i].name == 'form_inicia_rendicion_sede' && trim(elemento_auxiliar) != '' && x[i].value == elemento_auxiliar )
	{ 
		x[i].checked  = true;	
	}
	elemento_auxiliar = '{inicia_rendicion_fecha}';
	if(x[i].name == 'form_inicia_rendicion_fecha' && trim(elemento_auxiliar) != '' && x[i].value == elemento_auxiliar )
	{ 
		x[i].checked  = true;	
	}  
}  
mostrarAgnoTitulo(); 