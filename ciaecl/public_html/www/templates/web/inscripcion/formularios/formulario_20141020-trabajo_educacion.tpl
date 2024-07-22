<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
<strong style="">  
Para su inscripci&oacute;n debe utilizar su email personal, no de la instituci&oacute;n. La inscripci&oacute;n es por email, por esta raz&oacute;n no utilice un mismo email para distintas inscripciones, pues solo quedar&aacute; v&aacute;lido el &uacute;ltimo registro ingresado.
<br /> <br /> Por favor, revise bien el ingreso de sus datos, tal cual como usted los ingrese ser&aacute;n utilizados en su certificaci&oacute;n. Sin posibilidad de modificaci&oacute;n. </strong></td></tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_simple.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta.tpls -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/establecimeinto_educacional.tpl -->
  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nivel_ensena.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/ciudad.tpl -->
  
      <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/pais_select.tpl -->
 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/telefono.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
   
  
  
   <tr>
    <td><strong>Forma&nbsp;de&nbsp;participaci&oacute;n&nbsp;(*)</strong></td>
    <td>
	<input type="radio" name="form_tipo_inscripcion"   value="20141020-trabajo_educacion_presencial"    > 20 de octubre de 2014:  Asistencia presencial   <br>
	<input type="radio" name="form_tipo_inscripcion"   value="20141020-trabajo_educacion_online"> 20 de octubre de 2014:  Asistencia online v&iacute;a streaming<br>
	
	 
	</td>
  </tr>
 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_codigo.tpls -->
  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/comentario.tpls -->
  
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
<tr>
<td colspan="2"><br />
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie.tpl -->
<br /> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie_codigo.tpls -->
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
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email_codigo.tpls --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/establecimiento_educacional.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nivel_ensena.tpl -->	 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/ciudad.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono_movil.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/pais_select.tpl -->
 	 
	var fecha = false;
	for(i=0; ele = document.main.form_tipo_inscripcion[i];i++)
	{
		if(ele.checked) 
		{
			fecha = true;
		}
	}
	if(!fecha)
	{ 
		alert('Debe seleccionar forma de participacion');
		return false;	
	}   
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->