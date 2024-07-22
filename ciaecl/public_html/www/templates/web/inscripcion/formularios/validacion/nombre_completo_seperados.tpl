 	
 	if(document.main.form_nombre.value == '')
	{
		alert('Debe ingresar nombre');
		document.main.form_nombre.focus();
		return false;
	}
 	if(document.main.form_apellidos.value == '')
	{
		alert('Debe ingresar apellido paterno');
		document.main.form_apellidos.focus();
		return false;
	} 
 	if(document.main.form_campo_extra6.value == '')
	{
		alert('Debe ingresar apellido materno');
		document.main.form_campo_extra6.focus();
		return false;
	} 