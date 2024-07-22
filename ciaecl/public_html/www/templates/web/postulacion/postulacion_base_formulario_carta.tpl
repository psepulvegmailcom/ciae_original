

<table width="90%" border="0" cellpadding="3">
 
 <tr><td></td> </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
  <input name="form_email_md5"  type="hidden" value="{email_md5}">
  <input name="form_email"  type="hidden" value="{email}">
 <tr>
    <td ><strong id='campo_email'>Nombre del postulante / Name of applicant   </strong></td>  </tr>
   <tr>  <td > 
        {nombre} {apellidos}   </td>
  </tr>
   <tr><td></td> </tr>
   
   
  <!-- START BLOCK : bloque_formulario_carta_completo -->
  <tr><td><strong>El postulante ya cumpli&oacute; con el n&uacute;mero requerido de cartas de recomendacion. / The applicant has already completed the required number of reference letters.</strong> </td></tr>
  <!-- END BLOCK : bloque_formulario_carta_completo -->
  
  <!-- START BLOCK : bloque_formulario_carta_exito -->
  <tr><td><strong>La carta ha sido ingresada exitosamente. / The reference letters has been submitted successfully.</strong> </td></tr>
  <!-- END BLOCK : bloque_formulario_carta_exito -->
  <!-- START BLOCK : bloque_formulario_carta_detalle -->
  <input  type="hidden" name="numero" value="{numero}">
<tr>
    <td><strong id='campo_nombre'>Nombre / Name (*) </strong></td>
     </tr>
   <tr><td>
        <input type="text" name="form_carta{numero}_nombre" id="form_carta{numero}_nombre" style="width:100%"   maxlength="255"></td>
  </tr>
<tr>
    <td><strong id='campo_nombre'>Email / Email (*) </strong></td>
     </tr>
   <tr><td>
        <input type="text" name="form_carta{numero}_email" id="form_carta{numero}_email" style="width:100%"   maxlength="255"></td>
  </tr>
<tr>
    <td><strong id='campo_nombre'>Cargo y afiliaci&oacute;n / Position and affiliation (*) </strong></td>
     </tr>
   <tr><td>
        <input type="text" name="form_carta{numero}_descripcion" id="form_carta{numero}_descripcion" style="width:100%"   maxlength="255"></td>
  </tr>
<tr>
    <td><strong id='campo_nombre'>Carta  de recomendacion / Reference letters (*) (PDF) (Max 1.5 Mb) </strong></td>
     </tr>
    <tr><td>
        <input type="file"  name="carta{numero}_archivo" id="form_carta{numero}_archivo" ></td>
  </tr>
   <tr>
  <td  style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
  
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="{page}">
<input type="hidden" name="guardar" value="guardar_carta">
    <script>
	function enviarFormulario()
	{    
		if(!validacionCampoTextoSimple('form_carta{numero}_nombre'))
			return false;
		if(!validacionCampoTextoSimple('form_carta{numero}_email'))
			return false;	 
		if(!checkMail(document.main.form_carta{numero}_email.value))
		{
			alert('Debe ingresar email con formato correcto');
			document.main.form_carta{numero}_email.focus();
			return false;
		}	  
		if(!validacionCampoTextoSimple('form_carta{numero}_descripcion'))
			return false;
		if(!validacionCampoTextoSimple('form_carta{numero}_archivo'))
			return false;
				
		enviarFormularioBase();
	}
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->
 
  <!-- END BLOCK : bloque_formulario_carta_detalle -->
  
  
  
  </table>
 