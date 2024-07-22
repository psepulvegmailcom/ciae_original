 	
 	if(trim(document.main.form_comentario.value) == '')
	{
		alert('Debe ingresar comentario');
		document.main.form_comentario.focus();
		return false;
	} 