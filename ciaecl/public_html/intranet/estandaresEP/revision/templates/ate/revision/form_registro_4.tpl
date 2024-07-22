
<div class="fieldset_title_separador" >Descripción general de los servicios que ofrece el profesional</div> 

<div class="fieldset_title"  id='titulo_revision_oferta_general_descripcion'><img src="images/iconos/revision{revision_oferta_general_descripcion_estado_revision_img}.gif" /> Descripción de la Oferta  </div>
 
<a href="javascript:AbrirBloqueRevision('bloque_revision_oferta_general_descripcion');">Ver Datos</a>

<div id='bloque_revision_oferta_general_descripcion' class="div_oculto">
<fieldset >
	<div>
	<div class="fieldset_title_interno">Datos Postulación</div>
		 <strong>Descripción de la Oferta</strong> <br />{oferta_descripcion} <br />
		 <div  class="{modificacion_div_ocultos}">
		 <br /> <span class="span_modificacion" >Modificación</span> 
		 <span id='revision_oferta_general_descripcion_campo_revision_max'> caracteres de un máximo de 300</span><br /><textarea {revision_oferta_general_descripcion_modificacion_solo_lectura} class="textarea_revision" onchange="javascript:modificacionTexto('revision_oferta_general_descripcion_revision_modifico_texto');"  
		 name="revision_oferta_general_descripcion_campo_revision" id='revision_oferta_general_descripcion_campo_revision' onKeyDown="textCounter('revision_oferta_general_descripcion_campo_revision','revision_oferta_general_descripcion_campo_revision_max',300);" onKeyUp="textCounter('revision_oferta_general_descripcion_campo_revision','revision_oferta_general_descripcion_campo_revision_max',300);">{revision_oferta_general_descripcion_campo_revision}</textarea>
		 
		 <a href="javascript:convertirMinusculaInput('revision_oferta_general_descripcion_campo_revision','{revision_oferta_general_descripcion_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		  
		 
		 </div>
		 {revision_oferta_general_descripcion_formulario}
		 
	</div>
	
</fieldset>


<a href="javascript:CerrarBloqueRevision('revision_oferta_general_descripcion');">Ocultar Datos</a>

	</div>
 
 
<div class="fieldset_title"  id='titulo_revision_oferta_general_areageografica' >
<img src="images/iconos/revision{revision_oferta_general_areageografica_estado_revision_img}.gif" /> Área Geográfica en que ofrece servicios </div>

<a href="javascript:AbrirBloqueRevision('bloque_revision_oferta_general_areageografica');">Ver Datos</a> 
 
<div id='bloque_revision_oferta_general_areageografica' class="div_oculto">
<fieldset > 
	<div class="fieldset_title_interno">Datos Postulación</div>
	
	
<a href="javascript:showAreaCoberturaOferente(); showId('area_cobertura_comunas_ocultar');showId('comuna_spinner');">Ver Área Geográfica</a> 

<div style="text-align:center" id="comuna_spinner" class="div_oculto">
 	<img src="images/spinner.gif"  />
 	<div align='center' id='area_cobertura_comunas_ocultar' style="height:1px;" class='div_oculto'> 
	</div> 
	<div align='center' id='area_cobertura_comunas_ver' style="height:1px;" >
	</div>
</div>
<div id='area_cobertura_comunas' class='div_oculto' > </div>
	
	
		 {revision_oferta_general_areageografica_formulario}
 
</fieldset>
<a href="javascript:hiddenId('area_cobertura_comunas');CerrarBloqueRevision('revision_oferta_general_areageografica');">Ocultar Datos</a>
</div>


<div class="fieldset_title" id='titulo_revision_oferta_general_niveles'  ><img src="images/iconos/revision{revision_oferta_general_niveles_estado_revision_img}.gif" /> Niveles y tipo de establecimiento que atiende </div>

<a href="javascript:AbrirBloqueRevision('bloque_revision_oferta_general_niveles');">Ver Datos</a>
<div id='bloque_revision_oferta_general_niveles' class="div_oculto">
<fieldset >
 
	<div>
	<div class="fieldset_title_interno">Datos Postulación</div>
	 
		 
	 <!-- START BLOCK : bloque_ate_oferta_nivel -->
	<input type="checkbox" class="inputcheckbox"  disabled="disabled" name="ate_oferta_nivel[]" value="{bloque_ate_oferta_nivel_id}" {bloque_ate_oferta_nivel_selected}>
	<strong>{bloque_ate_oferta_nivel_registro}</strong> <br />
	<!-- END BLOCK : bloque_ate_oferta_nivel -->  
		 <br /><br /> <strong>Otra </strong>  {otro_nivel_oferta} 
		 
		<div  class="{modificacion_div_ocultos}">
		  <span class="span_modificacion" >Modificación</span> <textarea class="textarea_revision_text" name="revision_oferta_general_niveles_campo_revision" onchange="javascript:modificacionTexto('revision_oferta_general_niveles_revision_modifico_texto');"  {revision_oferta_general_niveles_modificacion_solo_lectura}/> {revision_oferta_general_niveles_campo_revision}</textarea>
		 
		 
		 <a href="javascript:convertirMinusculaInput('revision_oferta_general_niveles_campo_revision','{revision_oferta_general_niveles_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 </div>
	</div> 
		 {revision_oferta_general_niveles_formulario}
	
</fieldset>

<a href="javascript:CerrarBloqueRevision('revision_oferta_general_niveles');">Ocultar Datos</a>
</div>



<div class="fieldset_title" id='titulo_revision_oferta_general_zonageografica' >
<img src="images/iconos/revision{revision_oferta_general_zonageografica_estado_revision_img}.gif" /> Zona Geogr&aacute;fica </div>

<a href="javascript:AbrirBloqueRevision('bloque_revision_oferta_general_zonageografica');">Ver Datos</a>
<div id='bloque_revision_oferta_general_zonageografica' class="div_oculto">
<fieldset>
	<div> 
	<div class="fieldset_title_interno">Datos Postulación</div>
	<!-- START BLOCK : bloque_ate_oferta_zona -->
	<input type="checkbox" class="inputcheckbox" disabled="disabled" value="{bloque_ate_oferta_zona_id}" {bloque_ate_oferta_zona_selected} /> <strong>{bloque_ate_oferta_zona_registro}</strong>
	<!-- END BLOCK : bloque_ate_oferta_zona -->
			 
	</div>

		 {revision_oferta_general_zonageografica_formulario}
</fieldset>
<a href="javascript:CerrarBloqueRevision('revision_oferta_general_zonageografica');">Ocultar Datos</a>
</div>


<div  class="fieldset_title" id='titulo_revision_oferta_general_beneficiarios' >
<img src="images/iconos/revision{revision_oferta_general_beneficiarios_estado_revision_img}.gif" /> Beneficiarios directos del servicio  </div>

<a href="javascript:AbrirBloqueRevision('bloque_revision_oferta_general_beneficiarios');">Ver Datos</a>
<div id='bloque_revision_oferta_general_beneficiarios' class="div_oculto">
<fieldset>
	<div> 
	<div class="fieldset_title_interno">Datos Postulación</div>
			<!-- START BLOCK : bloque_ate_oferta_personas -->
			<input type="checkbox" class="inputcheckbox" disabled="disabled" value="{bloque_ate_oferta_personas_id}" {bloque_ate_oferta_personas_selected}><strong>{bloque_ate_oferta_personas_registro}</strong> <br />
			<!-- END BLOCK : bloque_ate_oferta_personas -->  
	
		 {revision_oferta_general_beneficiarios_formulario}
	</div>
</fieldset>
<a href="javascript:CerrarBloqueRevision('revision_oferta_general_beneficiarios');">Ocultar Datos</a>
</div>


<div  class="fieldset_title" id='titulo_revision_oferta_general_tiposervicio' ><img src="images/iconos/revision{revision_oferta_general_tiposervicio_estado_revision_img}.gif" /> Tipo de servicio </div>

<a href="javascript:AbrirBloqueRevision('bloque_revision_oferta_general_tiposervicio');">Ver Datos</a>
<div id='bloque_revision_oferta_general_tiposervicio' class="div_oculto">
<fieldset>
	<div> 
	<div class="fieldset_title_interno">Datos Postulación</div>
			 <!-- START BLOCK : bloque_ate_oferta_servicio -->
			<input type="checkbox" class="inputcheckbox"  disabled="disabled" value="{bloque_ate_oferta_servicio_id}" {bloque_ate_oferta_servicio_selected}><strong>{bloque_ate_oferta_servicio_registro} </strong>
			<!-- END BLOCK : bloque_ate_oferta_servicio -->  
	
		 {revision_oferta_general_tiposervicio_formulario}
	</div>
</fieldset>
<a href="javascript:CerrarBloqueRevision('revision_oferta_general_tiposervicio');">Ocultar Datos</a>
</div> 

<div class="fieldset_title" id='titulo_revision_oferta_general_metodologia' ><img src="images/iconos/revision{revision_oferta_general_metodologia_estado_revision_img}.gif" /> Metodolog&iacute;a Empleada </div>

<a href="javascript:AbrirBloqueRevision('bloque_revision_oferta_general_metodologia');">Ver Datos</a>
<div id='bloque_revision_oferta_general_metodologia' class="div_oculto">
<fieldset>
	<div>  
	<div class="fieldset_title_interno">Datos Postulación</div> 
			<!-- START BLOCK : bloque_ate_oferta_metodologia -->
			<input type="checkbox" class="inputcheckbox"  disabled="disabled" value="{bloque_ate_oferta_metodologia_id}" {bloque_ate_oferta_metodologia_selected}><strong>{bloque_ate_oferta_metodologia_registro} </strong><br />
			<!-- END BLOCK : bloque_ate_oferta_metodologia -->
			 
			 
			<br /><br /> <strong>Otra </strong><br /> {otra_metodologia_oferta}
			<div  class="{modificacion_div_ocultos}">
			 <span class="span_modificacion" >Modificación</span>
			<span id='revision_oferta_general_metodologia_campo_revision_max'>{max_largo_metodologia_actual} caracteres de un máximo de 300</span></label><br />
		
		<textarea {revision_oferta_general_metodologia_modificacion_solo_lectura} class="textarea_revision" onchange="javascript:modificacionTexto('revision_oferta_general_metodologia_revision_modifico_texto');" name="revision_oferta_general_metodologia_campo_revision" id='revision_oferta_general_metodologia_campo_revision'   onKeyDown="textCounter('revision_oferta_general_metodologia_campo_revision','revision_oferta_general_metodologia_campo_revision_max',300);" onKeyUp="textCounter('revision_oferta_general_metodologia_campo_revision','revision_oferta_general_metodologia_campo_revision_max',300);">{revision_oferta_general_metodologia_campo_revision}</textarea> 
		
		 <a href="javascript:convertirMinusculaInput('revision_oferta_general_metodologia_campo_revision','{revision_oferta_general_metodologia_modificacion_solo_lectura}');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 
		 </div>
	</div> 
	
		 {revision_oferta_general_metodologia_formulario} 
	
</fieldset> 

	
<a href="javascript:CerrarBloqueRevision('revision_oferta_general_metodologia');">Ocultar Datos</a>
</div>
 

<div  class="fieldset_title" id='titulo_revision_oferta_general_areas' >
<img src="images/iconos/revision{revision_oferta_general_areas_estado_revision_img}.gif" /> &Aacute;reas de Asistencia T&eacute;cnica </div>
 
 
<a href="javascript:AbrirBloqueRevision('bloque_revision_oferta_general_areas');">Ver Datos</a>
<div id='bloque_revision_oferta_general_areas' class="div_oculto">


	<div class="fieldset_title_interno">Datos Postulación</div>
	
	{tpl_areas_ambito_oferta}
		
		
		{revision_oferta_general_areas_formulario}
		
						 
<a href="javascript:CerrarBloqueRevision('revision_oferta_general_areas');">Ocultar Datos</a>
 </div>
  
	 <div  class="fieldset_title" id='titulo_revision_portafolio_ofertas_simple' >
	<img src="images/iconos/revision{revision_portafolio_ofertas_simple_estado_revision_img}.gif" /> 
	Ofertas &Aacute;reas de Asistencia T&eacute;cnica </div>
	 
	 
	<a href="javascript:AbrirBloqueRevision('bloque_revision_portafolio_ofertas_simple');">Ver Datos</a>
	<div id='bloque_revision_portafolio_ofertas_simple' class="div_oculto">	 
		 <fieldset>
		 
			{revision_portafolio_ofertas_simple_formulario}
		 </fieldset>
	 
	<a href="javascript:CerrarBloqueRevision('revision_portafolio_ofertas_simple');">Ocultar Datos</a>
	 </div> 
				 
 <div  class="fieldset_title" id='titulo_revision_portafolio_experiencia_simple' >
<img src="images/iconos/revision{revision_portafolio_experiencia_simple_estado_revision_img}.gif" /> Experiencias &Aacute;reas de Asistencia T&eacute;cnica </div>
 
 
<a href="javascript:AbrirBloqueRevision('bloque_revision_portafolio_experiencia_simple');">Ver Datos</a>
<div id='bloque_revision_portafolio_experiencia_simple' class="div_oculto">	
				 <fieldset>
	 	
				
{revision_portafolio_experiencia_simple_formulario}
	 
				
						</fieldset>
<a href="javascript:CerrarBloqueRevision('revision_portafolio_experiencia_simple');">Ocultar Datos</a>
 </div>
		
		
		

		
		 
		