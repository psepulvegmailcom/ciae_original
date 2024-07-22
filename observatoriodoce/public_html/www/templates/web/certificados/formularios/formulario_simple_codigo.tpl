<table width="90%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%"><strong>Email personal (*) </strong></td>
    <td style="width:70%"> 
        <input type="text" name="form_email" style="width:50%" maxlength="255" value="{email}"  >    </td>
  </tr>
    <tr>
    <td style=" width:30%"><strong>C&oacute;digo (*) </strong></td>
    <td style="width:70%"> 
        <input type="text" name="codigo" style="width:10%" maxlength="4"    >    </td>
  </tr>
    
  <tr>
    <td style=" width:30%"> </td>
    <td style="width:70%"> 
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormularioCodigo();" id="submit-submit_enviar">Generar Certificado</button>
  </td></tr>
 
   
</table>
<input type="hidden" value="view_certificado"  name="opcion" />  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="generar">

<script type="text/javascript">
 
 function enviarFormularioCodigo()
 {   
 	if(document.main.codigo.value != document.main.codigo_solicitado.value)
	{
		alert('Debe ingresar el codigo correcto');
		document.main.codigo.focus();
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
	process('generar',1);
 }
</script>