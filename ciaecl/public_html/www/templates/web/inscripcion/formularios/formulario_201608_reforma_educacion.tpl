<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_politicas_publicas">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_reforma_educacional">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_educacion_superior">
  
 
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
   
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl -->        
    <tr>
    <td><strong>Forma&nbsp;de&nbsp;participaci&oacute;n&nbsp;(*)</strong></td>
    <td>
	
    <div >  
	<input type="radio" name="form_tipo_inscripcion"      value="201608_reforma_educacion_presencial" >  
	Asistencia presencial<br>
	<input type="radio" name="form_tipo_inscripcion"      value="201608_reforma_educacion_online" >  
	Asistencia v&iacute;a streaming<br> 
	 
     
     </div>
     
	</td>
  </tr> 
  <tr><td colspan="2">&nbsp;<br /></td></tr> 
   
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

 <input type="hidden"  name="tipo_formulario_confirmacion" value='online'>  
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl -->  
	
 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->