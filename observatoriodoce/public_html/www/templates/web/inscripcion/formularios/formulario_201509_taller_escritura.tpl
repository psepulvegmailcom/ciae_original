<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="201509_taller_escritura_lenguaje">
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl -->   
   

    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/edad.tpl -->
   
  <tr><td colspan="2">&nbsp;<br /></td></tr>
       <tr>
    <td colspan="2"><strong>¿Qu&eacute; actividades asigna usted a sus estudiantes para desarrollar la escritura? ¿Por qu&eacute;? (*) </strong></td></tr>
    <tr>
    <td colspan="2"> <textarea   style="width:100%; height:80px"   name="form_campo_extra1" ></textarea></td>
  </tr> 
  <tr>
    <td colspan="2"><strong>¿Qu&eacute; aspectos o dimensiones de la escritura trabaja habitualmente con sus estudiantes? ¿Por qu&eacute;? (*) </strong></td></tr>
    <tr>
    <td colspan="2"> <textarea   style="width:100%; height:80px"   name="form_campo_extra2" ></textarea></td>
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
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/edad.tpl -->
	
	if(!validarContenidoPalabra(document.main.form_campo_extra1.value))
	{
		alert('Debe responder todas las preguntas');
		document.main.form_campo_extra1.focus();
		return false;
	} 
	if(!validarContenidoPalabra(document.main.form_campo_extra2.value))
	{
		alert('Debe responder todas las preguntas');
		document.main.form_campo_extra2.focus();
		return false;
	} 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl --> 
 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->