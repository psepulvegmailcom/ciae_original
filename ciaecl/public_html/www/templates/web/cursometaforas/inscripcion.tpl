<div style="padding-right:30px ">
 <!-- START BLOCK : bloque_envio_exito -->
<center id='mensaje_exito'><big><strong>Su preinscripci&oacute;n se realiz&oacute; exitosamente. Nos contacter&eacute;mos v&iacute;a telef&oacute;nica para confirmar su asistencia<br /><br />  </strong></big></center><br /><br />  
<!-- END BLOCK : bloque_envio_exito -->

<p>Se esta interesado en participar en nuestro pr&oacute;ximos cursos, por favor inscribase aqu&iacute; y nos comunicaremos con uds, muchas gracias.</p><br />  
</div>
        <table width="90%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%">Email personal (*) </td>
    <td style="width:70%"> <input type="text" name="form_email" style="width:100%" maxlength="255" value="{email}" onchange="javascript:consultarPorEmail();">    </td>
  </tr>
   
  <tr>
    <td>Nombre (*) </td>
    <td>
        <input type="text" name="form_nombre" style="width:100%" value="{nombre}" maxlength="255"></td>
  </tr>
  <tr>
    <td>Apellidos (*) </td>
    <td>
        <input type="text" name="form_apellidos" value="{apellidos}" style="width:100%" maxlength="255"></td>
  </tr> <tr>
  <td colspan="2" style="text-align:center">
   <button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
 <input type="hidden" name="form_comuna" value="13101">
   
</table>
<input type="hidden" value="ficha_inscripcion"  name="opcion" />
  
  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
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
 	if(document.main.form_apellidos.value == '')
	{
		alert('Debe ingresar apellidos');
		document.main.form_apellidos.focus();
		return false;
	} 
	document.main.page.value = document.main.opcion.value;
	document.main.submit();
 } 
</script>