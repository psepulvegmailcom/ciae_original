<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="20150417_eecera">
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta.tpl -->  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/institucion.tpl -->
   
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/cargo.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/actividad.tpl -->
   
 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/telefono.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
   
  
  
    
  
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
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/institucion.tpl -->	  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/cargo.tpl -->	  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/actividad.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono_movil.tpl --> 
 	 
	  
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->