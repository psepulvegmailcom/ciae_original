if(document.main.form_pais.value == 43)
{
	if(document.main.form_rut.value == '' || document.main.form_rut_dv.value == '')
	{
		alert('Debe ingresar rut completo');
		document.main.form_rut.focus();
		return false;
	}
	else
	{  
		if(!revisaRut(document.main.form_rut.value,document.main.form_rut_dv.value))
		{
			alert('Debe ingresar rut valido'); 	
			document.main.form_rut.focus();
			return false;
		}
	}
}