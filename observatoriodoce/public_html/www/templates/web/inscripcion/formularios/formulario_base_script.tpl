<script type="text/javascript">
function consultarPorEmail()
{
	var buscar = true;
	if(document.getElementById('rut_consultado'))
	{
		if(trim(document.main.rut_consultado.value) != '')
		{
			buscar = false;
		}
	}
	if(buscar)
	{
		document.main.guardar.value = 'consultaEmail';
		document.main.page.value = document.main.opcion.value;
		document.main.submit();
	}
} 

function consultarPorRut()
{
	document.main.guardar.value = 'consultaRut';
	document.main.page.value = document.main.opcion.value;
	document.main.submit();
} 

function limpiarNumero(campo)
{
	var e = searchElement(campo);
	var valor = e.value;
	valor = valor.replace(" ","");	
	valor = valor.replace(".","");
	valor = valor.replace("-","");
	e.value = valor;
}

function validarEmail()
{
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email_codigo_mensaje.tpl -->

	document.main.guardar.value = 'validarEmail';
	document.main.page.value = document.main.opcion.value;
	document.main.submit();
}

function enviarFormularioBase()
{
	document.main.page.value = document.main.opcion.value;
	document.main.submit();
} 

function destacarFormularioPendiente(id)
{
	cambioClaseEstilo(id,'formulario_alert_faltante'); 
	if(document.getElementById(id+'_a'))
	{
		gotoHref(id+'_a');
	}
} 

function destacarFormularioLimpiarPendiente(id)
{
	cambioClaseEstilo(id,'formulario_alert_faltante_limpio');
}

function revisionFormularioEleccion(caso_form)
{ 
	if(!emptyCheck(caso_form))
	{ 
		destacarFormularioPendiente(caso_form);
		return false;
	}
	else
	{
		destacarFormularioLimpiarPendiente(caso_form);
		return true;
	}
}

function revisionFormularioSeleccion(caso_form)
{ 
	if(!checkSelectedMultiple(caso_form))
	{ 
		destacarFormularioPendiente(caso_form);
		return false;
	}
	else
	{
		destacarFormularioLimpiarPendiente(caso_form);
		return true;
	}
}

function revisionFormularioTexto(caso_form)
{ 
	if(!checkInputText(caso_form))
	{ 
		destacarFormularioPendiente(caso_form);
		return false;
	}
	else
	{
		destacarFormularioLimpiarPendiente(caso_form);
		return true;
	}
}

 
  <!-- START BLOCK : bloque_select_comuna -->
   selectValue('form_comuna','{comuna_id}');
  <!-- END BLOCK : bloque_select_comuna -->
  
  
  
</script>