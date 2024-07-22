if(!checkSelectedMultiple('form_edad'))
{
	showAlert('Debe seleccionar edad');    
	document.main.form_edad.focus();
	return false;
}