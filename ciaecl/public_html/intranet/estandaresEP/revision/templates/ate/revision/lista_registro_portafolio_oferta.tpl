
 <div class="fieldset_title">Portafolio de Ofertas</div><br />


	 
	
	<!-- START BLOCK : bloque_ficha_sin_portafolio -->
	<table border="0"  width="100%"  id="tabla_noborder">
	<tr>
		<td class="form_tabla_campo" colspan="2">No se registran portafolios</td>
	</tr>
	</table>
	<!-- END BLOCK : bloque_ficha_sin_portafolio -->
	
	
	<!-- START BLOCK : bloque_ficha_portafolio -->
	
	<div   class="fieldset_title" id='titulo_revision_portafolio_ofertas-{id_oferta}'  ><img src="images/iconos/revisionrevision_portafolio_ofertas_{id_oferta}_img.gif" />
		<strong>Ficha N° {fila}</strong>
		</div>
<a href="javascript:AbrirBloqueRevision('bloque_revision_portafolio_ofertas-{id_oferta}');"> Ver Datos </a>
	<div id='bloque_revision_portafolio_ofertas-{id_oferta}'  class="div_oculto">
	
	
 
	<table border="0"  width="100%"  id="tabla_noborder"> 
	<tr>
		<td width="30%" class="form_tabla_campo"><strong>Área de Asistencia Técnica</strong></td>
		<td>{area}	</td>
	</tr>	
	<tr>
		<td class="form_tabla_campo"><strong>Subárea de Asistencia Técnica</strong></td>
		<td>{programa}	</td>
	</tr> 
	<tr>
		<td class="form_tabla_campo" style="vertical-align:top; width:25%"><strong>Nombre de la Oferta</strong></td>
		<td>{nombre_oferta}	
		<br /><br />
		<div   class="revision_portafolio_ofertas_{id_oferta}_oculto">
			 <span class="span_modificacion" >Modificación</span>
			 
		<span id='revision_portafolio_ofertas_{id_oferta}_nombre_revision_max'>{max_largo_metodologia_actual} caracteres de un máximo de  255</span></label><br />
		<textarea revision_portafolio_ofertas_{id_oferta}_disabled  class="textarea_revision" onchange="javascript:modificacionTexto('');modificacionIdExterno('{id_oferta}');"  name="revision_portafolio_ofertas_{id_oferta}_nombre_revision" id='revision_portafolio_ofertas_{id_oferta}_nombre_revision'   onKeyDown="textCounter('revision_portafolio_ofertas_{id_oferta}_nombre_revision','revision_portafolio_ofertas_{id_oferta}_nombre_revision_max',255);" onKeyUp="textCounter('revision_portafolio_ofertas_{id_oferta}_nombre_revision','revision_portafolio_ofertas_{id_oferta}_nombre_revision_max',255);"  style='height:50px' >revision_portafolio_ofertas_{id_oferta}_nombre_revision_texto</textarea> 
		
		  <a href="javascript:convertirMinusculaInput('revision_portafolio_ofertas_{id_oferta}_nombre_revision','revision_portafolio_ofertas_{id_oferta}_disabled');"><img src="images/iconos/convertir_minuscula.gif" /></a>
	 
		  </div>
		  
		  
		   
		  
		
		</td>
	</tr>	
	 
	<tr>
		<td class="form_tabla_campo" style="vertical-align:top"><strong>Descripción de la Oferta</strong></td>
		<td >{descripcion_oferta}
		
		<br /><br />
		<div   class="revision_portafolio_ofertas_{id_oferta}_oculto">
			 <span class="span_modificacion" >Modificación</span>
			 
		<span id='revision_portafolio_ofertas_{id_oferta}_descripcion_revision_max'>{max_largo_metodologia_actual} caracteres de un máximo de  300</span></label><br />
		<textarea revision_portafolio_ofertas_{id_oferta}_disabled  class="textarea_revision" onchange="javascript:modificacionTexto('');modificacionIdExterno('{id_oferta}');"  name="revision_portafolio_ofertas_{id_oferta}_descripcion_revision" id='revision_portafolio_ofertas_{id_oferta}_descripcion_revision'   onKeyDown="textCounter('revision_portafolio_ofertas_{id_oferta}_descripcion_revision','revision_portafolio_ofertas_{id_oferta}_descripcion_revision_max',300);" onKeyUp="textCounter('revision_portafolio_ofertas_{id_oferta}_descripcion_revision','revision_portafolio_ofertas_{id_oferta}_descripcion_revision_max',300);"  >revision_portafolio_ofertas_{id_oferta}_descripcion_revision_texto</textarea> 
		
		  <a href="javascript:convertirMinusculaInput('revision_portafolio_ofertas_{id_oferta}_descripcion_revision','revision_portafolio_ofertas_{id_oferta}_disabled');"><img src="images/iconos/convertir_minuscula.gif" /></a>
		  
		  </div>
		  
		</td>
	</tr>
	 
	</table>	
	<fieldset>
	revision_portafolio_ofertas_{id_oferta}_formulario
	</fieldset>
	
	
<a href="javascript:CerrarBloqueRevision('revision_portafolio_ofertas-{id_oferta}');">Ocultar Datos</a>
</div>
	<!-- END BLOCK : bloque_ficha_portafolio -->

 
 <input type="hidden" name="id_oferta" /> 
 
 
