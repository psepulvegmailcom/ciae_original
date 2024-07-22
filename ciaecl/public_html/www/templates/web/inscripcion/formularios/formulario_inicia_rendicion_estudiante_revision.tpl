
 function enviarFormulario()
 { 
 	var seleccion_cargo = '';
    for (var i=0;i < document.main.form_cargo.length;i++)
	{
       if (document.main.form_cargo[i].selected   )
       {
	   		seleccion_cargo = document.main.form_cargo[i].value; 
	   }
    }   
	if(seleccion_cargo == '')
	{
		alert('Debe seleccionar area de especialidad'); 
		return false;
	} 
 	if(document.main.form_email.value == '')
	{
		alert('Debe ingresar email');
		document.main.form_email.focus();
		return false;
	}
	else
	{
		if(!checkMail(document.main.form_email.value))
		{
			alert('Debe ingresar email con formato correcto');
			document.main.form_email.focus();
			return false;
		}
	}
 	if(document.main.form_nombre.value == '')
	{
		alert('Debe ingresar nombre');
		document.main.form_nombre.focus();
		return false;
	}
 	if(document.main.form_apellidos.value == '')
	{
		alert('Debe ingresar apellidos');
		document.main.form_apellidos.focus();
		return false;
	}     
 	if(document.main.form_telefono.value == '')
	{
		alert('Debe ingresar telefono');
		document.main.form_telefono.focus();
		return false;
	}    
 	if(document.main.form_comuna.value == '')
	{
		alert('Debe seleccionar la comuna');
		document.main.form_comuna.focus();
		return false;
	}   
	
	if(!emptyCheck('form_campo_extra1'))
	{
		alert('Debe seleccionar disponibilidad'); 
		return false;
	} 
	
	if(!emptyCheck('form_campo_extra2'))
	{
		alert('Debe seleccionar local de rendicion'); 
		return false;
	}

 	if(document.main.form_rut.value == '')
	{
		alert('Debe ingresar rut');
		document.main.form_rut.focus();
		return false;
	}	
	
	
	
	document.main.page.value = document.main.opcion.value;
	document.main.submit();
 }
  
function consultarPorEmail()
{
	document.main.guardar.value = 'consultaEmailInicia';
	document.main.page.value = document.main.opcion.value;
	document.main.submit();
} 

  <!-- START BLOCK : bloque_select_comuna -->
   selectValue('form_comuna','{comuna_id}');
  <!-- END BLOCK : bloque_select_comuna -->
  