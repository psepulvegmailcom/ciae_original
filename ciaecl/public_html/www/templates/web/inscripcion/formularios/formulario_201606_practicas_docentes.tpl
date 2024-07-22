<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
   <div style="text-align:center"><strong>SOLO QUEDAN CUPOS para participar de manera online</strong> </div>
 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_tic"> 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_modelamiento_matematico"> 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_formacion_docentes">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_matematicas">
 
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
   
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl -->
        <tr>
    <td><strong>Si ud es docente, indiqu&eacute; de que nivel</strong></td>
    <td>
	
    <div >  
	<input type="radio" name="form_campo_extra1"      value="docente_matematica_basica" >  
	Docente de matem&aacute;tica, educaci&oacute;n b&aacute;sica<br> 
	<input type="radio" name="form_campo_extra1"      value="docente_matematica_matematica" >  
	Docente de matem&aacute;tica, educaci&oacute;n media<br> 
	<input type="radio" name="form_campo_extra1"      value="docente_otra_materia" >  
	Soy docente, pero de otra asignatura<br> 
	 
	<input type="radio" name="form_campo_extra1"      value="no_aplica" >  
	No aplica<br> 
	</td>
  </tr>
    <tr>
    <td><strong>Forma&nbsp;de&nbsp;participaci&oacute;n&nbsp;(*)</strong></td>
    <td>
	
    <div >  
	 
	<input type="radio" name="form_tipo_inscripcion"    checked  value="201606_practicas_docentes_online" >  
	Asistencia v&iacute;a streaming<br><strong>SOLO QUEDAN CUPOS para participar de manera online</strong> 
	 
	</td>
  </tr>
        
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
  
       
   
   
  <input type="hidden"  name="tipo_formulario_confirmacion" value='online'> 
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
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl -->  
	 if(trim(document.main.form_campo_extra1.value) == '')
	{
		alert('Debe seleccionar tipo de docente');
		document.main.form_campo_extra1.focus();
		return false;
	} 
 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->