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
		<td colspan="2">&nbsp;<br /></td>
	</tr>
	<tr>
		<td>
			<strong>Forma de participación (*)</strong>
		</td>
		<td>
			<label><input type="radio" name="form_tipo_inscripcion" value="20230606_ciecc2023_online" checked>Online, vía streaming</label><br>
			<label><input type="radio" name="form_tipo_inscripcion" value="20230606_ciecc2023_presencial">Presencial</label><br>
		</td>
	</tr>

	<tr>
		<td colspan="2" style="text-align:center">
			<button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar ></button>
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

<input type="hidden"  name="tipo_formulario_confirmacion" value="{datos_inscripcion_tipo_formulario_confirmacion}">
<input type="hidden" value="view_inscripcion" name="opcion">
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">

 function enviarFormulario()
 {
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/institucion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/profesion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/actividad.tpl -->

	enviarFormularioBase();
 }
</script>

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->