 
<!-- INCLUDE BLOCK : ../templates/ate/registro/form_registro_ficha_persona.tpl -->
 
 <!-- inclusion -->
 <script> 
	changeFormValue('caso_revision','edicion');
	
	var hayactualizacion = false;
	
  <!-- START BLOCK : bloque_bloqueo_actualizacion_variables -->
	document.main.ate_persona_nombre_nueva.disabled 			= true; 
	document.main.ate_persona_apellido_paterno_nueva.disabled 	= true; 
	document.main.ate_persona_apellido_materno_nueva.disabled 	= true; 
	document.main.ate_persona_archivo_titulo.disabled 			= true; 
	document.main.ate_persona_titulo_nombre.disabled 			= true; 
	document.main.ate_persona_titulo_institucion.disabled 		= true;  
	document.main.ate_persona_postitulo_nombre.disabled 		= true; 
	document.main.ate_persona_archivo_postitulo.disabled 		= true; 
	document.main.ate_persona_postitulo_institucion.disabled 	= true;   	
	
  <!-- END BLOCK : bloque_bloqueo_actualizacion_variables --> 
	
<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_edicion_generico.tpl --> 

	<!-- START BLOCK : bloque_actualizacion_variables -->
	 
	changeFormValue('ate_persona_nombre_nueva','{nombre}');
	changeFormValue('ate_persona_apellido_paterno_nueva','{apellido_paterno}');
	changeFormValue('ate_persona_apellido_materno_nueva','{apellido_materno}');	
	
	changeTextId('datos_persona','<big>Nombre : {nombre} {apellido_paterno} {apellido_materno}<br> Rut : {rut}-{dv}</big>');
	changeFormValue('ate_persona_titulo_nombre','{titulo_nombre}'); 
	changeFormValue('ate_persona_titulo_institucion','{titulo_institucion}');  
	changeFormValue('ate_persona_postitulo_nombre','{postitulo_nombre}');  
	changeFormValue('ate_persona_postitulo_institucion','{postitulo_institucion}');  	
	changeFormValue('ate_persona_titulo_nombre_nuevo','{titulo_nombre}');   
	changeFormValue('ate_persona_otro_registros_otro','{otro_registro}');
	changeFormValue('ate_persona_cargo','{cargo}');
	changeFormValue('ate_persona_horas','{horas_disponibles}');
	 
	 var x = document.main.elements;
	 var estado_disabled = true;	
	for (var i=0 ; i < x.length ; i++)
	{			 
		if(x[i].name)
		{
			var name = x[i].name;			 	
			if(x[i].name.substr(0,12) == "ate_persona_" && x[i].type != 'hidden')
			{ 	
				estado_disabled = true;
				 if((x[i].type == 'text' && x[i].value  == '') || (x[i].name == 'ate_persona_horas' && x[i].value <= 0))
				{				
					estado_disabled 			= false;
				} 
				x[i].disabled 			= estado_disabled;
			} 
		}
	}
	if(document.getElementById('documento_postitulo_href'))
	{
		document.getElementById('documento_postitulo_href').href = 'download.php?caso=oferente_documento_file&file={postitulo_archivo}&nombre=postitulo_{rut}.{postitulo_extension}';
	}
	else
	{
		document.main.ate_persona_archivo_postitulo.disabled = false;
	}
	if(document.getElementById('documento_titulo_href'))
	{
		document.getElementById('documento_titulo_href').href = 'download.php?caso=oferente_documento_file&file={titulo_archivo}&nombre=titulo_{rut}.{titulo_extension}';
	} 
	else
	{
		document.main.ate_persona_archivo_titulo.disabled = false;
	}
	var x = document.main.elements;	
	for (var i=0 ; i < x.length ; i++)
	{		
		if(x[i].name == 'ate_persona_jornada' && x[i].value == '{disponibilidad}')
		{
			x[i].checked = true;
		}	
		if( '{disponibilidad}' == '')
		{
			if(x[i].name == 'ate_persona_jornada' || x[i].name == 'ate_persona_otro_registros_otro' || x[i].name == 'ate_persona_otro_registros[]')
			x[i].disabled = false;
		}
		if(x[i].name == "ate_oferta_programa[]" )
		{	
		<!-- START BLOCK : bloque_actualizacion_variables_subareas -->			 			  
			if( x[i].value == '{valor}')
			{
				x[i].checked = true;			 
			} 			 		 		
		<!-- END BLOCK : bloque_actualizacion_variables_subareas -->
		}
		var seleccionAlgo = false; 
		var seleccionAlgoOtro = false; 
		if(x[i].name == 'ate_persona_otro_registros[]' )
		{
			for(var j=0; j < x[i].length ; j++)
			{ 			
				<!-- START BLOCK : bloque_actualizacion_variables_registros -->	
				if( x[i][j].value == '{valor}')
				{
					x[i][j].selected = true;
					 seleccionAlgo = true;		
					 if( x[i][j].value == 'otro')
					 {
					 	seleccionAlgoOtro = true;
					 }	 
				} 
				<!-- END BLOCK : bloque_actualizacion_variables_registros -->
			}
			if(seleccionAlgo)
			{  
				otroRegistroSi();
				if(seleccionAlgoOtro)
				{
					inputRegistroTexto.disabled 	= false;  
				}
				else				
				{
					inputRegistroTexto.value 		= '';
					inputRegistroTexto.disabled 	= true;  
				}
			}
			else
			{				
				if('{nombre}' == '') 
				{
					x[i].disabled = false;	 		
				}  
			}
		}	
		if(x[i].name == 'ate_persona_otro_registro' && !seleccionAlgo  )
		{		
			x[i].disabled = false;		
			document.main.ate_persona_otro_registros_otro.disabled 	= false;		
		}							 
	}	 
	<!-- END BLOCK : bloque_actualizacion_variables -->
		 
	if (document.getElementById('boton_borrar_postitulo'))
	{
		hiddenId('boton_borrar_postitulo');
	}
	if (document.getElementById('boton_borrar_titulo'))
	{
		hiddenId('boton_borrar_titulo');
	}	
	if (document.getElementById('boton_borrar_postituloedicion'))
	{
		hiddenId('boton_borrar_postituloedicion');
	}
	if (document.getElementById('boton_borrar_tituloedicion'))
	{
		hiddenId('boton_borrar_tituloedicion');
	}
	<!-- START BLOCK : datos_archivo_titulo_noactualizacion -->
	if (document.getElementById('documento_titulo'))
	{
		hiddenId('documento_titulo');
	}
	<!-- END BLOCK : datos_archivo_titulo_noactualizacion -->
	<!-- START BLOCK : datos_archivo_postitulo_noactualizacion -->
	if (document.getElementById('documento_postitulo'))
	{
		hiddenId('documento_postitulo');
	}	
	<!-- END BLOCK : datos_archivo_postitulo_noactualizacion -->
	
	
	
	<!-- START BLOCK : bloque_activar_boton_experiencias -->
	showId('boton_mas_experiencia_{id_programa}'); 
	document.main.ate_oferta_programa_{id_programa}[1].checked = true;
	registro_area_check_fila({id_programa});
	<!-- END BLOCK : bloque_activar_boton_experiencias -->
	
	 
	
</script>