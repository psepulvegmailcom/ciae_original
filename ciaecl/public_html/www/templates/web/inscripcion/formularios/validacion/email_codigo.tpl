 	if(trim(document.main.email_codigo_ingreso.value)  == '')
	{
		alert('Debe ingresar el c\u00F3digo de validaci\u00F3n del email. Si no lo ha recibido, revise su bandeja de SPAM de su correo o que haya escrito correctamente su email.');
         
		document.main.email_codigo_ingreso.focus();
		return false;
	}  
 	if(trim(document.main.email_codigo.value)  != trim(document.main.email_codigo_ingreso.value))
	{
		alert('Debe ingresar el c\u00F3digo de validaci\u00F3n correcto. Si no lo ha recibido, revise su bandeja de SPAM de su correo o que haya escrito correctamente su email.');
         	
		document.main.email_codigo_ingreso.focus();
		return false;
	}  