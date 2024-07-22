<table width="90%" border="0" cellpadding="3">
	<tr>
		<td colspan="2"><br /></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;<br /></td>
	</tr>
		<input type="hidden" name="form_pais" value="43">

		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta.tpl -->
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/profesion.tpl -->
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/actividad.tpl -->
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/institucion.tpl -->
		
	<tr>
		<td colspan="2"><br /><br /><b>Datos acompa&ntilde;ante</b><br /><br /></td>
	</tr>
		
		<tr>
    <td><strong>Nombre completo acompa&ntilde;ante (*)</strong></td>
    <td> 
    <input type="text" name="form_campo_extra1" id="form_campo_extra1"  value="{campo_extra1}" style="width:100%" maxlength="255">
    </td>
  </tr> 
		<tr>
    <td><strong>Correo electr&oacute;nico acompa&ntilde;ante (*)</strong></td>
    <td> 
    <input type="text" name="form_campo_extra2" id="form_campo_extra2"  value="{campo_extra2}" style="width:100%" maxlength="255">
    </td>
  </tr> 

	<tr>
		<td colspan="2">&nbsp;<br /></td>
	</tr>

	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae_tipo.tpl -->

	<tr>
		<td colspan="2" style="text-align:center">
			<button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
		</td>
	</tr>
	<tr>
		<td colspan="2"><br /></td>
	</tr>
	<tr>
		<td colspan="2">

		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie.tpl -->

		</td>
	</tr>
</table>

<input type="hidden" name="tipo_formulario_confirmacion" value="{datos_inscripcion_tipo_formulario_confirmacion}">
<input type="hidden" value="view_inscripcion" name="opcion">
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 function enviarFormulario()
 {

    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/tipo_inscripcion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/institucionh.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/profesionh.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/actividad.tpl -->
	
	 if(trim(document.main.form_campo_extra1.value) == '')
	{
		alert('Debe ingresar datos acompanante');
		document.main.form_campo_extra1.focus();
		return false;
	} 

	 if(trim(document.main.form_campo_extra2.value) == '')
	{
		alert('Debe ingresar datos acompanante');
		document.main.form_campo_extra2.focus();
		return false;
	} 

	enviarFormularioBase();
 }
</script>

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->