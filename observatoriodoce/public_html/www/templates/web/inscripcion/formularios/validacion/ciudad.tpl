
 	if(trim(document.main.form_ciudad.value) == '')
	{
		alert('Debe ingresar ciudad');
		document.main.form_ciudad.focus();
		return false;
	} 