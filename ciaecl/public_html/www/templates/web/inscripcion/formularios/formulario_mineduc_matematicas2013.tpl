<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
<strong style="text-decoration:underline"> Su inscripci&oacute;n presencial se confirmar&aacute; telef&oacute;nicamente, por lo que es requisito ingresar sus datos correctamente. <br /><br />
Esta confirmaci&oacute;n es requisito para poder participar en el seminario presencialmente.  <br /> 
<br /> Por favor, revise bien el ingreso de sus datos, tal cual como usted los ingrese ser&aacute;n utilizados en su certificaci&oacute;n. Sin posibilidad de modificaci&oacute;n. </strong></td></tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_validacion.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/establecimeinto_educacional.tpl -->
  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nivel_ensena.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/direccion.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/ciudad.tpl -->
  
      <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/pais_select.tpl -->
 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/telefono.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
   
  
  
   <tr>
    <td><strong>Forma&nbsp;de&nbsp;participaci&oacute;n&nbsp;(*)</strong></td>
    <td>
	  <input type="radio" name="form_tipo_inscripcion"   value="20130824_mineduc_matematicas_presencial"   disabled="disabled"> 24 de agosto de 2013:  Asistencia presencial <strong>(No Disponible)</strong>  <br>  
	<input type="radio" name="form_tipo_inscripcion"   value="20130824_mineduc_matematicas_online"> 24 de agosto de 2013:  Asistencia online v&iacute;a streaming<br>
	<br /> Por cupos la inscripci&oacute;n presencial se encuentra cerrada, solo quedan cupos en las inscripci&oacute;n online. 
	
	 
	</td>
  </tr>
 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_codigo.tpl -->
  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/comentario.tpls -->
  
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
<tr>
<td colspan="2"><br />
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie.tpl -->
<br /> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie_codigo.tpl -->
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
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email_codigo.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/establecimiento_educacional.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nivel_ensena.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/direccion.tpl -->	
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
	if(fecha)
	{
	 // nada
	}
	else
	{ 
		alert('Debe seleccionar forma de participacion');
		return false;	
	}  

	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->