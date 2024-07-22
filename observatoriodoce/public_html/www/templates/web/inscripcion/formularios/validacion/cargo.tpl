 	
 	if(trim(document.main.form_cargo.value) == '')
	{
		alert('Debe ingresar cargo');
		document.main.form_cargo.focus();
		return false;
	} 