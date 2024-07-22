<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="201505_practicas_pedagogicas">
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta.tpl --> 
<tr><td></td><td  >    <strong><small>Recuerde que para usar el sistema del proyecto de Pr&aacute;cticas Docentes,  necesita un correo gmail.</small></strong> </td></tr>
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut_sin_texto_simple.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/universidad_estudio.tpl --> 
   <tr>
    <td><strong>Sede de su universidad (*)</strong></td>
    <td> 
    <input type="text" name="form_campo_extra2"  value="{campo_extra2}" style="width:100%" maxlength="255">
    </td>
  </tr> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nivel_ensena.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/ciudad.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
   
  <input type="hidden"  name="tipo_formulario_confirmacion" value='requisitos'>
  
    
  
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
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut_simple.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/universidad_estudio.tpl -->	 
	if(document.main.form_campo_extra2.value == '')
	{
		alert('Debe ingresar la sede ');
		document.main.form_campo_extra2.focus();
		return false;
	}  	  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nivel_ensena.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/ciudad.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono_movil.tpl --> 
 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->