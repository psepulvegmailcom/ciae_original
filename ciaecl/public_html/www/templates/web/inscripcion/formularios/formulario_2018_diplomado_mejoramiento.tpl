<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="2018_diplomado_mejoramiento">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_mejoramiento_escolar">   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_mejoramiento_escuelas">   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_politicas_publicas">   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_gestion_curricular">   
  
 
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
   
       <input type="hidden" name="form_pais" value="43">
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut_sin_texto_simple.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_nacimiento.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/genero.tpl -->    
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/profesion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/institucion.tpl --> 
      <tr>
    <td><strong id='campo_campo_extra1'>Direcci&oacute;n instituci&oacute;n&nbsp;(*)  </strong></td>
    <td> 
	<input type="text" name="form_campo_extra1"  id="form_campo_extra1" style="width:100% " value="{campo_extra1}" maxlength="255"> 
	</td>
  </tr> 
      <tr>
    <td><strong id='campo_campo_extra2'>Tel&eacute;fono contacto instituci&oacute;n&nbsp;(*)  </strong></td>
    <td> 
	<input type="text" name="form_campo_extra2" id="form_campo_extra2"  style="width:100% " value="{campo_extra2}" maxlength="255"> 
	</td>
  </tr> 
      <tr>
    <td><strong id='campo_campo_extra3'>Sitio web instituci&oacute;n&nbsp;(*)  </strong></td>
    <td> 
	<input type="text" name="form_campo_extra3" id="form_campo_extra3" style="width:100% " value="{campo_extra3}" maxlength="255"> 
	</td>
  </tr> 
      <tr>
    <td><strong id='campo_campo_extra4'>A&ntilde;os de servicios (*)  </strong></td>
    <td> 
	<input type="text" name="form_campo_extra4" id="form_campo_extra4" style="width:100% " value="{campo_extra4}" maxlength="255"> 
	</td>
  </tr> 
     
       
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/actividad.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/comuna.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/ciudad.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
    
      <tr>
    <td><strong id='campo_campo_extra5'>Correo electr&oacute;nico alternativo (*)  </strong></td>
    <td> 
	<input type="text" name="form_campo_extra5" id="form_campo_extra5" style="width:100% " value="{campo_extra5}" maxlength="255"> 
	</td>
  </tr> 
    
  <tr><td colspan="2">&nbsp;<br /></td></tr> 
        <tr>
    <td ><strong>CV </strong></td> 
    <td  > <input type="file" name="archivo_extra1" id="archivo_extra1"> </td>
  </tr> 
  <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Copia de t&iacute;tulos y/o grados (1)</strong></strong></td> 
    <td  >  <input type="file" name="archivo_extra2" id="archivo_extra2"> </td>
  </tr> 
  <tr><td colspan="2">&nbsp;<br /></td></tr>  <tr>
    <td ><strong>Copia de t&iacute;tulos y/o grados (2)</strong></td> 
    <td  >  <input type="file" name="archivo_extra3" id="archivo_extra3"> </td>
  </tr>  
  <tr><td colspan="2">&nbsp;<br /></td></tr> 
    <tr>
    <td><strong>Carta de intenci&oacute;n</strong> <br>Indicando cargo, motivaciones, prop&oacute;sito, expectativas del programa, expectativas futuras, etc </td>
    <td><textarea  style="width:100%; height:150px" name="form_comentario"> </textarea></td>
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

<input type="hidden"  name="tipo_formulario_confirmacion" value='con_pago'> 
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {  
	
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/tipo_inscripcion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/institucion.tpl --> 
		
		
	if(!validacionCampoTextoSimple('form_campo_extra1'))
	{
		return false;
	}    
	if(!validacionCampoTextoSimple('form_campo_extra2'))
	{
		return false;
	}    
	if(!validacionCampoTextoSimple('form_campo_extra3'))
	{
		return false;
	}    
	if(!validacionCampoTextoSimple('form_campo_extra4'))
	{
		return false;
	}     
	if(!validacionCampoTextoSimple('form_campo_extra5'))
	{
		return false;
	}      
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/fecha_nacimiento.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/actividad.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/profesion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/genero.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/ciudad.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/comuna.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/celular.tpl -->
      
	
 	    	
 	if(trim(document.main.form_comentario.value) == '')
	{
		alert('Debe ingresar carta de motivacion');
		document.main.form_comentario.focus();
		return false;
	}  
  	 if(!validacionCampoTextoSimple('archivo_extra1'))
	 	return false;	
  	 if(!validacionCampoTextoSimple('archivo_extra2'))
	 	return false;	 	
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->