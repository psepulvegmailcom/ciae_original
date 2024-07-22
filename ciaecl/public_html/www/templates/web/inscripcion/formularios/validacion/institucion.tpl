 	
 	if(trim(document.main.form_institucion.value) == '')
	{
		alert('Debe ingresar institucion');
		document.main.form_institucion.focus();
		return false;
	} 