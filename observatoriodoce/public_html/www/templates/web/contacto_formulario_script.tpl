 

<script type="text/javascript">
function EnviarFormulario()
{ 
	if(document.main.nombre.value == '')
	{
		alert('{langSite_formulario_alerta_base} {langSite_general_nombre}');
		document.main.nombre.focus();
		return false;
	}
	if(document.main.email.value == '')
	{
		alert('{langSite_formulario_alerta_base} {langSite_general_email}');
		document.main.email.focus();
		return false;
	}
	if(document.main.mensaje.value == '')
	{
		alert('{langSite_formulario_alerta_base} {langSite_general_mensaje}');
		document.main.mensaje.focus();
		return false;
	}
	process(document.main.lastAction.value,0);
}
</script>