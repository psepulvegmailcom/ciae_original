
<!-- START BLOCK : bloque_envio_exito -->
<center id='mensaje_exito'><big><strong>Su consulta fue enviada exitosamente, pronto nos comunicaremos con ud</strong></big></center><br><br> 
<!-- END BLOCK : bloque_envio_exito -->
<table width="95%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%">Email (*) </td>
    <td style="width:70%"> 
        <input type="text" name="form_email" style="width:100%" maxlength="255" value="{email}"  >
         
    </td>
  </tr>
  <tr>
    <td style=" width:30%">Nombre (*) </td>
    <td style="width:70%"> 
        <input type="text" name="form_nombre" style="width:100%" maxlength="255" value="{email}"  >
         
    </td>
  </tr>
  <tr>
    <td>Comentario</td>
    <td><textarea  style="width:100%; height:80px" name="form_comentario">{comentario}</textarea></td>
  </tr>
    <tr>
    <td colspan="2" align="center"> <button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarConsulta();" id="submit-submit_enviar">
  Enviar</button> </td>
  </tr>
  </table>
  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="enviar">
<script>
 
 function enviarConsulta()
 {
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
 	if(document.main.form_comentario.value == '')
	{
		alert('Debe ingresar comentario');
		document.main.form_comentario.focus();
		return false;
	}  
	document.main.submit();
 } 
</script>  