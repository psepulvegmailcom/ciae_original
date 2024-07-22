 

<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_inscripciones_201601_stem">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_stem">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_modelamiento_matematico">
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl -->   
   
 <tr>
    <td><strong>Forma&nbsp;de&nbsp;participaci&oacute;n&nbsp;(*)</strong></td>
    <td>
	 
	 <strong>Por el alto interes SOLO quedan disponibles cupos para participar de manera online</strong>
<br>
	<input type="radio" name="form_tipo_inscripcion"   value="201601_stem_online"     >    Asistencia online v&iacute;a streaming    

	</td>
  </tr>   
   
  <input type="hidden"  name="tipo_formulario_confirmacion" value='online'> 
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
<tr>
	<td colspan="2">
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie.tpl -->
    </td>
</tr>
   
</table>
<input type="hidden" value="view_inscripcion" name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {       
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl --> 
	if(!emptyCheck('form_tipo_inscripcion'))
	{
		showAlert('Debe seleccionar forma de participacion');		
		document.main.form_tipo_inscripcion.focus();
		return false;
	} 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->