<!-- START BLOCK : bloque_tipo_inscripcion_presencial -->
<input type="hidden" name="form_tipo_inscripcion" value="{datos_inscripcion_id_inscripcion}_presencial">
<!-- END BLOCK : bloque_tipo_inscripcion_presencial -->

<!-- START BLOCK : bloque_tipo_inscripcion_online -->
<tr>
	<td>
		<strong>Forma de participación (*)</strong>
	</td>
	<td>
		<div>
			<input type="hidden" name="form_tipo_inscripcion" value="{datos_inscripcion_id_inscripcion}_online">Asistencia online, vía streaming.
		</div>
	</td>
</tr>
<!-- END BLOCK : bloque_tipo_inscripcion_online -->

<!-- START BLOCK : bloque_tipo_inscripcion_online_solo -->
<tr>
	<td>
		<strong>Forma de participación (*)</strong>
	</td>
	<td>
		<div>
			<label><input type="radio" name="form_tipo_inscripcion" value="{datos_inscripcion_id_inscripcion}_online">Asistencia online, vía streaming</label><br>
			<p>
				<strong>Solo quedan cupos disponibles para participar online, via streaming.</strong>
			</p>
		</div>
	</td>
</tr>
<!-- END BLOCK : bloque_tipo_inscripcion_online_solo -->

<!-- START BLOCK : bloque_tipo_inscripcion_hibrido -->
<tr>
	<td>
		<strong>Forma de participación (*)</strong>
	</td>
	<td>
		<label><input type="radio" name="form_tipo_inscripcion" value="{datos_inscripcion_id_inscripcion}_online" checked>Online, vía streaming</label><br>
		<label><input type="radio" name="form_tipo_inscripcion" value="{datos_inscripcion_id_inscripcion}_presencial">Presencial</label>
	</td>
</tr>
<!-- END BLOCK : bloque_tipo_inscripcion_hibrido -->