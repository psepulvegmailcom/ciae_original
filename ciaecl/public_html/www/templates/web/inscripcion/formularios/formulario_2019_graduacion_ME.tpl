<table width="90%" border="0" cellpadding="3">
  <tr>
    <td style=" width:40%">Email personal (*) </td>
    <td style="width:60%"> 
        <input type="text" name="form_email" style="width:100%" maxlength="255" value="{email}"  >    </td>
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
  </tr> 
 
  
   

 
    
    <tr>

  <td>

 
  </td> </tr>
  <tr>
    <td>Tel&eacute;fono (*) </td>
    <td><input type="text" name="form_telefono"  value="{telefono}" style="width:100%" maxlength="50"></td>
  </tr>

  <tr>
    <td>Nombre acompa&ntilde;ante 1   </td>
    <td>
        <input type="text" name="form_campo_extra1" value="{campo_extra1}" style="width:100%" maxlength="255"></td>
  </tr> 
     <tr>
    <td>Nombre acompa&ntilde;ante 2  </td>
    <td>
        <input type="text" name="form_campo_extra2" value="{campo_extra2}" style="width:100%" maxlength="255"></td>
  </tr> 

  <tr>
  <td colspan="2" style="text-align:center">
   <button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
 
   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" />
  
  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">
<input type="hidden" name="form_tipo_inscripcion" value="2019_graduacion_ME">

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
 	if(document.main.form_telefono.value == '')
	{
		alert('Debe ingresar telefono');
		document.main.form_telefono.focus();
		return false;
	}    
  
	document.main.page.value = document.main.opcion.value;
	document.main.submit();
 }
  
  
 
</script>