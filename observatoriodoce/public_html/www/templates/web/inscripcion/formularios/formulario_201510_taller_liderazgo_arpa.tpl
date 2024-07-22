<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="201510_taller_liderazgo_arpa_matematica">
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl -->   
   
 
   
  <tr><td colspan="2">&nbsp;<br /></td></tr>
       <tr>
    <td colspan="2"><strong>Ingresar CV </strong></td></tr>
    <tr>
    <td colspan="2"> <input type="file" name="archivo_cv"></td>
  </tr> 
  <tr><td colspan="2">&nbsp;<br /></td></tr>
       <tr>
    <td colspan="2"><strong>Ingresar carta de motivaci&oacute;n </strong></td></tr>
    <tr>
    <td colspan="2"> <input type="file" name="archivo_carta"></td>
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
<input type="hidden" name="tipo_formulario_confirmacion" value="confirmacion">

<script type="text/javascript">
 
 function enviarFormulario()
 {   
	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl --> 
	if(!validarContenidoPalabra(document.main.archivo_cv.value))
	{
		alert('Ingresar los archivos');
		document.main.archivo_cv.focus();
		return false;
	} 
	if(!validarContenidoPalabra(document.main.archivo_carta.value))
	{
		alert('Ingresar los archivos');
		document.main.archivo_carta.focus();
		return false;
	} 
 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->