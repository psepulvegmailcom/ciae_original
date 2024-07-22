<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="2017_diplomado_mejoramiento">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_mejoramiento_escolar">   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_mejoramiento_escuelas">   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_politicas_publicas">   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_gestion_curricular">   
  
 
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
   
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl -->  
    
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
    <td><strong>Carta de intenci&oacute;n</strong> <br>Indicando instituci&oacute;n en la que trabaja, cargo, motivaciones, expectativas del programa, etc </td>
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
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl -->  
	
 	    	
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