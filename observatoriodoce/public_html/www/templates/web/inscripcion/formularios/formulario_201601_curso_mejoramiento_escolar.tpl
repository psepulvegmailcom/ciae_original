<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="201601_curso_mejoramiento_escolar"> 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_mejoramiento_escolar">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_mejoramiento_escuelas">
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl -->   
     <tr>
    <td><strong>Tipo de establecimiento en el cual trabaja/administra/asesora  (*)  </strong></td>
    <td> 
	<select name="form_campo_extra1">
	 <option value=""></option>
	 <option value="Municipal">Municipal</option>
	 <option value="Particular Subvencionado">Particular Subvencionado</option>
	 <option value="Particular Pagado">Particular Pagado</option> 
	 </select> 
	</td>
  </tr>
       <tr>
    <td><strong>Qu&eacute; lo motiva a tomar este curso (m&aacute;ximo 2 p&aacute;rrafos).  (*)  </strong></td>
    <td> 
	<textarea name="form_campo_extra2" style="width:100%; height:80px "></textarea>
   
	</td>
  </tr>
  
  
   
   
   
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

   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl -->  
	 if(document.main.form_campo_extra1.value == '')
	{
		alert('Debe seleccionar tipo establecimiento');
		document.main.form_campo_extra1.focus();
		return false;
	}  
	 if(document.main.form_campo_extra2.value == '')
	{
		alert('Debe ingresar motivacion');
		document.main.form_campo_extra2.focus();
		return false;
	} 	
 
 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->