if(checkSelectedMultiple('dia_{variable}') && checkSelectedMultiple('mes_{variable}') && trim(document.main.agno_{variable}.value) != '')
{
	document.main.form_fecha_{variable}.value = document.main.dia_{variable}.value + document.main.mes_{variable}.value + document.main.agno_{variable}.value;	 
}
else
{
	showAlert('Debe ingresar fecha completa');
    document.main.form_fecha_{variable}.focus();
	return false;
} 