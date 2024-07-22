<input type="hidden" name="form_tipo_inscripcion" value="201401-EjercicioDocente_Avalos" />
<table width="90%" border="0" cellpadding="3">
  
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_simple_sin_texto.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl --> 
  
  
   <tr>
    <td><strong>Autorizaci&oacute;n</strong></td>
    <td>  
    
	<input  type="checkbox" name="form_campo_extra1"    value="si_autorizo_uso_de_datos"  > Autorizo el uso de mis datos personales para recibir una encuesta on-line para comprender las razones por las que un importante n&uacute;mero de nuevos profesores y profesoras se retiran tempranamente del trabajo docente en las escuelas y liceos de nuestro pa&iacute;s.
	</td>
  </tr>
  
  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/comentario.tpl -->
  
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
<tr>
<td colspan="2"><br />

   
   </td>
</tr>

   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" />
  
  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 { 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl --> 
	 
	if(!document.main.form_campo_extra1.checked)
	{ 
		alert('Debe seleccionar si autoriza a utilizar sus datos');
		return false;	
	}  
	

	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->