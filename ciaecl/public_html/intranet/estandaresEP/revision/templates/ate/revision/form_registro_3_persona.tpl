  <div  class="fieldset_title_separador">Disponibilidad  para realizar Asistencia Técnica</div>

 
<div class="fieldset_title" id='titulo_revision_horas_persona_natural' >
<img src="images/iconos/revision{revision_horas_persona_natural_estado_revision_img}.gif" /> Horas semanales disponibles para realizar Asistencia Técnica  </div>
	 
<a href="javascript:AbrirBloqueRevision('bloque_revision_horas_persona_natural');">Ver Datos</a>
<div id='bloque_revision_horas_persona_natural' class="div_oculto">
<fieldset>
	<div>  
	<div class="fieldset_title_interno">Datos Postulación</div>
		<strong>Horas Disponibles</strong> {ate_personas_horas}
			     


		 <div   class="{modificacion_div_ocultos}">
		 	<a href="javascript:mostrarHHRecursos('{rut_horas}','ver_datos_hh_recursos','hh_recursos_spinner');">Ver Horas en otras instituciones</a>
		
			<div style="text-align:center" id="hh_recursos_spinner" class="div_oculto"> 
				<img src="images/spinner.gif"    /> 
			</div>	
		
			<div id='ver_datos_hh_recursos' class="div_oculto"  >
				<strong><u>Información de Horas Disponibles como Persona Natural y Capital Humano de otras Instituciones</u></strong>
				<div id='ver_datos_hh_recursos_interno'   style=" margin-top:10px;height:180px; overflow: scroll;">	
					</div>
				<a href=javascript:hiddenId('ver_datos_hh_recursos');hiddenId('ver_datos_hh_recursos_interno');hiddenId('hh_recursos_spinner'); >Ocultar </a>
			</div>
		</div>



				 
			 {revision_horas_persona_natural_formulario}
	</div>
	</fieldset>
 
<a href="javascript:CerrarBloqueRevision('revision_horas_persona_natural');hiddenId('ver_datos_hh_recursos');hiddenId('ver_datos_hh_recursos_interno');hiddenId('hh_recursos_spinner');">Ocultar Datos</a>
</div>
 