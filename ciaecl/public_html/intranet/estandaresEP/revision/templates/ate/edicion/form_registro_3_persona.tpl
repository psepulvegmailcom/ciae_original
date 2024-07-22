

	if (document.getElementById('boton_borrar_titulo'))
	{
		hiddenId('boton_borrar_titulo');
		document.main.ate_persona_titulo_nombre.disabled = true;
		document.main.ate_persona_archivo_titulo.disabled = true;
		document.main.ate_persona_titulo_institucion.disabled = true;
	}

	if (document.getElementById('boton_borrar_postitulo'))
	{
		hiddenId('boton_borrar_postitulo');
		document.main.ate_persona_postitulo_nombre.disabled = true;
		document.main.ate_persona_archivo_postitulo.disabled = true;
		document.main.ate_persona_postitulo_institucion.disabled = true;
	}
	if (document.getElementById('boton_borrar_postitulo2'))
	{
		hiddenId('boton_borrar_postitulo2');
		document.main.ate_persona_postitulo2_nombre.disabled = true;
		document.main.ate_persona_archivo_postitulo2.disabled = true;
		document.main.ate_persona_postitulo2_institucion.disabled = true;
	} 
	<!-- START BLOCK : datos_archivo_postitulo2_edicion -->
	
		hiddenId('boton_borrar_postitulo2')
		document.main.ate_persona_postitulo2_nombre.disabled = false
		document.main.ate_persona_archivo_postitulo2.disabled =false;
		document.main.ate_persona_postitulo2_institucion.disabled = false;
	<!-- END BLOCK : datos_archivo_postitulo2_edicion -->
 
<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_edicion_generico.tpl -->

if(document.main.ate_persona_horas_disponibles.value != document.main.ate_persona_horas.value )
{
	document.main.ate_persona_horas.value 		= document.main.ate_persona_horas_disponibles.value;
	document.main.ate_persona_horas.disabled 	= true; 
}