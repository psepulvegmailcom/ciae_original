<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="20164_lanzamiento_geografia_educacion">
 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_tic"> 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_politicas_publicas"> 
 
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/genero.tpl -->     
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/institucion.tpl -->
     
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
  
       
   
   
  <input type="hidden"  name="tipo_formulario_confirmacion" value='simple'> 
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
  
<tr>
<td colspan="2"><br /> 
    </td>
</tr>
<tr>
	<td colspan="2">
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie.tpl -->
    </td>
</tr>

   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {  
	
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/tipo_inscripcion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/institucion.tpl -->   
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/genero.tpl -->   
	
 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->