if(!checkSelectedMultiple('form_region'))
{
	showAlert('Debe seleccionar region');
	document.main.form_region.focus();
	return false;
}