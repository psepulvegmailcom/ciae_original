 
if(trim(document.main.dia_fn.value) == '' || trim(document.main.mes_fn.value) == '' || trim(document.main.agno_fn.value) == '') 
{
	showAlert('Debe ingresar fecha de nacimiento');
	return false;
} 