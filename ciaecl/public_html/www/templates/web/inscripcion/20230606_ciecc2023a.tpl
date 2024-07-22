<a name="formulario"></a>
<div class="contenido_titulo_separador">
	{datos_inscripcion_nombre}
</div>
<table class="tabla_simple" border="0">
	<tr>
		<td style="width:65%; padding:0 20px 0 20px;">

			<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpl -->

			<!-- inicioninscripcion_ficha -->
			
			<div id='inscripcion_ficha'>

				<!-- INCLUDE BLOCK : www/templates/web/inscripcion/inscripcion_hidden.tpl -->

				<!-- START BLOCK : bloque_formulario -->
					<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_20230606_ciecc2023.tpl --> 
				<!-- END BLOCK : bloque_formulario -->

				<!-- START BLOCK : bloque_formulario_cierre -->
					<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/cerradas_cupo.tpl -->
				<!-- END BLOCK : bloque_formulario_cierre -->

			</div>

			<!-- fininscripcion_ficha -->

			<div id="inscripcion_programa">

				<!-- INCLUDE BLOCK : www/templates/web/inscripcion/inscripcion_base-programa.tpl -->

			</div>
		</td>
		<td>

			<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl -->

			<li class="lateral_inscripcion" style="font-size:15px;"><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripción</strong></a></li>
			<li class="lateral_inscripcion" style="font-size:15px;"><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Programa</strong></a></li><br>
			<li class="lateral_inscripcion" style="font-size:13px;" id="informacion_consulta"><strong>Fecha: </strong>{datos_inscripcion_date_texto}</li><br>
			<li class="lateral_inscripcion" style="font-size:13px;" id="informacion_consulta"><strong>Ubicación:</strong> {datos_inscripcion_ubicacion}</li><br>
			<li class="lateral_inscripcion" style="font-size:13px;" id="informacion_consulta"><strong>Consultas o dudas:</strong> <a href="mailto:{datos_inscripcion_email}?subject=Consulta {datos_inscripcion_nombre}" target="_blank">{datos_inscripcion_email}</a></li>

				<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl -->

				<p style="text-align:center">
					<br>
					<br>
					<a href="https://www.ciae.uchile.cl/" target="_blank" style="border:0;">
					<img src="www/imag/logos/ciae.jpg" title="CIAE - Universidad de Chile" style="padding:0px 10px 0px 10px;" border="0" width="250px"></a>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
				</p>
			</td>
		</tr>
	</tr>
</table>
<script type="text/javascript">

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/general_menu_textos.tpl -->

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/mostrar_ficha.tpls -->

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/cerradas_cupo_online.tpl -->

	function ocultarDiv()
	{
		hiddenId('inscripcion_ficha');
		hiddenId('inscripcion_programa');
	}
	ocultarDiv();
	mostrarDiv('inscripcion_ficha');
</script>
