<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
 
 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_ensenanza_aprendizaje">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_stem_modelamiento">
 <input type="hidden" name="bd_lista_extra[]" value="pedagogias_carrera_docentes">  
  
 <input type="hidden" name="form_tipo_inscripcion" value="201707_taller_buenas_practicas">
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->   
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/genero.tpl -->    
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/establecimeinto_educacional.tpl -->    
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/comuna.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
    <tr>
    <td><strong>RBD (*) </strong></td>
    <td> 
	<input type="text" name="form_campo_extra1" style="width:100% "  maxlength="255"> 
	</td>
  </tr>
       <tr>
    <td><strong>Nivel  donde hace clase  (*)  </strong></td>
    <td> 
	<input type="text" name="form_campo_extra2" style="width:100% "  maxlength="255"> 
   
	</td>
    </tr>
   
  <input type="hidden"  name="tipo_formulario_confirmacion" value='simple'>
  
    
  
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

    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/comuna.tpl -->	
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/establecimiento_educacional.tpl -->	

	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono_movil.tpl --> 
 	  if(document.main.form_campo_extra1.value == '')
	{
		alert('Debe ingresar RBD');
		document.main.form_campo_extra1.focus();
		return false;
	}  
	 if(document.main.form_campo_extra2.value == '')
	{
		alert('Debe ingresar nivel donde hace clase');
		document.main.form_campo_extra2.focus();
		return false;
	} 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->