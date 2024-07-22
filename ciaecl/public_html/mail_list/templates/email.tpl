<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Envio masivo de email</title>
<script languaje="javascript" src="http://www.registroate.cl/libjs/Function.js"></script>
</head>
<style>
td { vertical-align:top; padding:5px; padding-bottom:15px;}
</style>
<body  > 
<form name="main" method="post" action="email.php">
<table style="width:80%"  border="0">
<tr><td colspan="2" style=" text-align:center"><strong style="font-size:120%">Envio de email masivo CIAE</strong></td></tr>
<tr><td colspan="2" style="height:6px"></td></tr>
<tr>
  <td style="width:150px"><strong>Envio</strong></td>
  <td>
<select name="id_envio">
<option value="">-- Seleccione email --</option>
<!-- START BLOCK : bloque_envio_activo -->
<option value="{id_plantilla}">{fecha} - {asunto}</option>
<!-- END BLOCK : bloque_envio_activo -->
</select>
</td></tr>
<tr><td><strong>Tipo base de datos</strong></td>
<td> 
<!-- START BLOCK : bloque_tipo_base -->
<input type="checkbox" name="tipo_base[]" value="{tipo_base}">{tipo_base} (total: {total})<br />
<!-- END BLOCK : bloque_tipo_base --> 
<br />
<input name="selectAll" onclick="javascript:checkInputAll('tipo_base[]');document.main.selectAll.checked=true;document.main.unselectAll.checked=false;" type="checkbox"> Seleccionar Todo | 		<input name="unselectAll" onclick="javascript:uncheckInputAll('tipo_base[]');document.main.selectAll.checked=false;document.main.unselectAll.checked=true;" type="checkbox"> Deseleccionar Todo 

</td></tr>
<tr><td></td><td><input type="button" onclick="javascript:enviarEmail();" value="Enviar Correos" /></td></tr>
</table> 
</form>

<ol>
<!-- START BLOCK : bloque_enviado_email -->
<li>{email} enviado </li>
<!-- END BLOCK : bloque_enviado_email -->
</ol>
<br><br><br>
<a href="email_enviado.php" target="_blank">Enviar Emails</a>
<script>
function enviarEmail()
{
	if(document.main.id_envio.value == '')
	{
		alert('Debe seleccionar el email a enviar');
		return false;
	} 
	var x 		= document.main.elements;	
	var seleccion_tipo = false;
	var name = 'tipo_base[]';
	for (var i=0 ; i < x.length ; i++)
	{		
		if(x[i].name == name && x[i].checked)
		{
			seleccion_tipo =  true;								
		}
	}
	if(!seleccion_tipo)
	{ 
		alert('Debe seleccionar al menos un tipo de base de datos a enviar su correo');
		return false;
	}
	
	if(confirm('¿Está seguro de enviar este correo? recuerde que se puede demorar varias horas dependiendo de la cantidad de email a enviar'))
	{
		document.main.submit();
	} 
}
</script>

</body>
</html>


