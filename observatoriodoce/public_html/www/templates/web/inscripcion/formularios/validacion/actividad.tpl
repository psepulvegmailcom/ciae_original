 	
 	if(trim(document.main.form_actividad.value) == '')
	{
		alert('Debe ingresar actividad');
		document.main.form_actividad.focus();
		return false;
	} 