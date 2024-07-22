
 <div class="fieldset_title">Portafolio de Experiencias</div><br />


	 
	
	<!-- START BLOCK : bloque_ficha_sin_portafolio -->
	<table border="0"  width="100%"  id="tabla_noborder">
	<tr>
		<td class="form_tabla_campo" colspan="2">No se registran portafolios</td>
	</tr>
	</table>
	<!-- END BLOCK : bloque_ficha_sin_portafolio -->
	
	 
	<!-- START BLOCK : bloque_ficha_portafolio -->
	
	<div   class="fieldset_title" id='titulo_revision_portafolio_experiencia-{id_portafolio}'  ><img src="images/iconos/revisionrevision_portafolio_experiencia_{id_portafolio}_img.gif" />
		<strong>Ficha N° {fila} </strong>
		</div>
<a href="javascript:AbrirBloqueRevision('bloque_revision_portafolio_experiencia-{id_portafolio}');">Ver Datos</a>
	<div id='bloque_revision_portafolio_experiencia-{id_portafolio}'  class="div_oculto">
	
	
	<table border="0"  width="100%"  id="tabla_noborder">
 
	<!-- START BLOCK : bloque_ficha_portafolio_con_programa -->
	<tr>
		<td width="30%" class="form_tabla_campo"><strong>Área de Asistencia Técnica</strong></td>
		<td>{area}	</td>
	</tr>	
	<tr>
		<td class="form_tabla_campo"><strong>Subárea de Asistencia Técnica</strong></td>
		<td>{programa}	</td>
	</tr>
	<!--END BLOCK : bloque_ficha_portafolio_con_programa -->
	<tr>
		<td class="form_tabla_campo" style="vertical-align:top"><strong>Nombre del Proyecto</strong></td>
		<td>{nombre}	<br /><br />
		
		<div   class="revision_portafolio_experiencia_{id_portafolio}_oculto">
			 <span class="span_modificacion" >Modificación</span>
			 
		<span id='revision_portafolio_experiencia_{id_portafolio}_nombre_revision_max'>{max_largo_metodologia_actual} caracteres de un máximo de  300</span></label><br />
		<textarea revision_portafolio_experiencia_{id_portafolio}_disabled   style='height:50px' class="textarea_revision" onchange="javascript:modificacionTexto('');modificacionIdExterno('{id_portafolio}');"  name="revision_portafolio_experiencia_{id_portafolio}_nombre_revision" id='revision_portafolio_experiencia_{id_portafolio}_nombre_revision'   onKeyDown="textCounter('revision_portafolio_experiencia_{id_portafolio}_nombre_revision','revision_portafolio_experiencia_{id_portafolio}_nombre_revision_max',300);" onKeyUp="textCounter('revision_portafolio_experiencia_{id_portafolio}_nombre_revision','revision_portafolio_experiencia_{id_portafolio}_nombre_revision_max',300);"  >revision_portafolio_experiencia_{id_portafolio}_nombre_revision_texto</textarea> 
		
		  <a href="javascript:convertirMinusculaInput('revision_portafolio_experiencia_{id_portafolio}_nombre_revision','revision_portafolio_experiencia_{id_portafolio}_disabled');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		  
		  </div>
		  
		</td>
	</tr>	
	<tr>
		<td class="form_tabla_campo"><strong>Institución Contratante</strong></td>
		<td>{institucion}	</td>
	</tr>
	<tr>
		<td class="form_tabla_campo"><strong>Período Experiencia (Inicio - Término)</strong></td>
		<td> {fecha_inicio}	- {fecha_termino}</td>
	</tr> 
	  
	 <tr>
		<td class="form_tabla_campo" style="vertical-align:top;"><strong>Zona Geográfica de Ejecución</strong></td>
		<td>{territorio_geografico}	</td>
	</tr> 
		 
	<tr>
		<td class="form_tabla_campo" style="vertical-align:top"><strong>Coordinador Servicio</strong></td>
		<td >{coordinador}
		<br /><br />
		
		<div   class="revision_portafolio_experiencia_{id_portafolio}_oculto">
			 <span class="span_modificacion" >Modificación</span>
			 
		
		<textarea revision_portafolio_experiencia_{id_portafolio}_disabled  class="textarea_revision_text" onchange="javascript:modificacionTexto('');modificacionIdExterno('{id_portafolio}');"  name="revision_portafolio_experiencia_{id_portafolio}_coordinador_revision" id='revision_portafolio_experiencia_{id_portafolio}_coordinador_revision'  >revision_portafolio_experiencia_{id_portafolio}_coordinador_revision_texto</textarea> 
		
		  <a href="javascript:convertirMinusculaInput('revision_portafolio_experiencia_{id_portafolio}_coordinador_revision','revision_portafolio_experiencia_{id_portafolio}_disabled');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 
		  </div>
		
		</td>
	</tr> 
	<tr>
		<td class="form_tabla_campo" style="vertical-align:top"><strong>Descripción del Trabajo Realizado</strong></td>
		<td >{descripcion}
		<br /><br />
		
		<div   class="revision_portafolio_experiencia_{id_portafolio}_oculto">
			 <span class="span_modificacion" >Modificación</span>
			 
		<span id='revision_portafolio_experiencia_{id_portafolio}_descripcion_revision_max'>{max_largo_metodologia_actual} caracteres de un máximo de  300</span></label><br />
		<textarea revision_portafolio_experiencia_{id_portafolio}_disabled  class="textarea_revision" onchange="javascript:modificacionTexto('');modificacionIdExterno('{id_portafolio}');"  name="revision_portafolio_experiencia_{id_portafolio}_descripcion_revision" id='revision_portafolio_experiencia_{id_portafolio}_descripcion_revision'   onKeyDown="textCounter('revision_portafolio_experiencia_{id_portafolio}_descripcion_revision','revision_portafolio_experiencia_{id_portafolio}_descripcion_revision_max',300);" onKeyUp="textCounter('revision_portafolio_experiencia_{id_portafolio}_descripcion_revision','revision_portafolio_experiencia_{id_portafolio}_descripcion_revision_max',300);"  >revision_portafolio_experiencia_{id_portafolio}_descripcion_revision_texto</textarea> 
		
		  <a href="javascript:convertirMinusculaInput('revision_portafolio_experiencia_{id_portafolio}_descripcion_revision','revision_portafolio_experiencia_{id_portafolio}_disabled');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		  
		  </div>
		  
		</td>
	</tr>
	<tr>
		<td class="form_tabla_campo" style="vertical-align:top"><strong>Resultados</strong></td>
		<td >{resultado}
		<br /><br />
		<div   class="revision_portafolio_experiencia_{id_portafolio}_oculto">
			 <span class="span_modificacion" >Modificación</span>
			 
		<span id='revision_portafolio_experiencia_{id_portafolio}_resultado_revision_max'>{max_largo_metodologia_actual} caracteres de un máximo de  300</span></label><br />
		<textarea revision_portafolio_experiencia_{id_portafolio}_disabled  class="textarea_revision" onchange="javascript:modificacionTexto('');modificacionIdExterno('{id_portafolio}');"  name="revision_portafolio_experiencia_{id_portafolio}_resultado_revision" id='revision_portafolio_experiencia_{id_portafolio}_resultado_revision'   onKeyDown="textCounter('revision_portafolio_experiencia_{id_portafolio}_resultado_revision','revision_portafolio_experiencia_{id_portafolio}_resultado_revision_max',300);" onKeyUp="textCounter('revision_portafolio_experiencia_{id_portafolio}_resultado_revision','revision_portafolio_experiencia_{id_portafolio}_resultado_revision_max',300);"  >revision_portafolio_experiencia_{id_portafolio}_resultado_revision_texto</textarea> 
		
		  <a href="javascript:convertirMinusculaInput('revision_portafolio_experiencia_{id_portafolio}_resultado_revision','revision_portafolio_experiencia_{id_portafolio}_disabled');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		   
		  </div>
		</td>
	</tr> 
	<tr>
		<td class="form_tabla_campo" style="vertical-align:top"><strong>Persona Referencia</strong></td>
		<td >{referencia_nombre}
		<br /><br />
		<div   class="revision_portafolio_experiencia_{id_portafolio}_oculto">
			 <span class="span_modificacion" >Modificación</span>
			 
		
		<textarea revision_portafolio_experiencia_{id_portafolio}_disabled  class="textarea_revision_text" onchange="javascript:modificacionTexto('');modificacionIdExterno('{id_portafolio}');"  name="revision_portafolio_experiencia_{id_portafolio}_referencia_nombre_revision" id='revision_portafolio_experiencia_{id_portafolio}_referencia_nombre_revision'  >revision_portafolio_experiencia_{id_portafolio}_referencia_nombre_revision_texto</textarea> 
		
		  <a href="javascript:convertirMinusculaInput('revision_portafolio_experiencia_{id_portafolio}_referencia_nombre_revision','revision_portafolio_experiencia_{id_portafolio}_disabled');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 
		  </div>
		</td>
	</tr>
	<tr>
		<td class="form_tabla_campo" style="vertical-align:top"><strong>Cargo</strong></td>
		<td >{referencia_cargo}
		
		<br /><br />
		<div   class="revision_portafolio_experiencia_{id_portafolio}_oculto">
			 <span class="span_modificacion" >Modificación</span>
			 
		
		<textarea revision_portafolio_experiencia_{id_portafolio}_disabled  class="textarea_revision_text" onchange="javascript:modificacionTexto('');modificacionIdExterno('{id_portafolio}');"  name="revision_portafolio_experiencia_{id_portafolio}_referencia_cargo_revision" id='revision_portafolio_experiencia_{id_portafolio}_referencia_cargo_revision'  >revision_portafolio_experiencia_{id_portafolio}_referencia_cargo_revision_texto</textarea> 
		
		  <a href="javascript:convertirMinusculaInput('revision_portafolio_experiencia_{id_portafolio}_referencia_cargo_revision','revision_portafolio_experiencia_{id_portafolio}_disabled');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		 
		  </div>
		</td>
	</tr>
	<tr>
		<td class="form_tabla_campo"><strong>Teléfono</strong></td>
		<td >{referencia_telefono_codigo} - {referencia_telefono}</td>
	</tr>
	<tr>
		<td class="form_tabla_campo"><strong>Email</strong></td>
		<td >{referencia_email}</td>
	</tr>
	<tr>
		<td class="form_tabla_campo"><strong>Carta Referencia</strong></td>
		<td >
		<!-- START BLOCK : bloque_ficha_portafolio_carta -->
		<a href="download.php?caso=oferente_documento_file&file={nombre_documento}&nombre=carta_referencia.{extension_documento}" target="_blank"  title="Ver Carta">
		<img src="images/download_act.jpg" border="0" />
		</a>
		<!-- END BLOCK : bloque_ficha_portafolio_carta -->
			</td>		
	</tr>
	</table>	
	<fieldset>
	revision_portafolio_experiencia_{id_portafolio}_formulario
	</fieldset>
	
	
<a href="javascript:CerrarBloqueRevision('revision_portafolio_experiencia-{id_portafolio}');">Ocultar Datos</a>
</div>

	<!-- END BLOCK : bloque_ficha_portafolio -->

 
 <input type="hidden" name="id_portafolio" /> 
 
 