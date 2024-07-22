
	
	
<div style="float:right; padding-bottom:10px; "><a href="javascript:process('portafolio_oferta_lista',0);" style="  padding-bottom:10px; ">{volver_listado}</a></div><br />

<center><button type="button" onclick="javascript:self.close();"  > <span>Cerrar Ventana </span></button>	</center><br />
	<script>document.main.casoFormularioBloqueo.value = 'experiencias';</script>
	<!-- INCLUDE BLOCK : ../templates/ate/revision/form_registro_bloqueo_inclusion.tpl -->
 <div class="fieldset_title">Portafolio de Experiencias</div><br />
 
<table border="0"  width="100%"  id="tabla_noborder">

	<!-- START BLOCK : bloque_ficha_con_rut -->
	 <input type='hidden' name='rut' value='{rut}'>
	<!-- END BLOCK : bloque_ficha_con_rut -->
	
	<!-- START BLOCK : bloque_ficha_sin_portafolio -->
	<tr>
		<td class="form_tabla_campo" colspan="2" id=''>No se registran portafolios</td>
	</tr>
	<!-- END BLOCK : bloque_ficha_sin_portafolio -->
	<!-- START BLOCK : bloque_ficha_portafolio -->
	<tr>
		<td colspan="2"   class="fieldset_title"  >
		<strong>Ficha N° {fila} &#8220;{fila_nombre}&#8221; <font id='ate_oferta_{id_portafolio}_estado' class="edicion_enrevision">{estado_actualizacion}</font></strong>
		<span id='bloque_botones_experiencia_{id_portafolio}'  >
			<button type="button" id='portafolio_lista_editar_{fila}' onclick="javascript:editarPortafolio({id_portafolio});"  > <span>Editar </span></button>
			<button type="button" id='portafolio_lista_borrar_{fila}'  onclick="javascript:borrarPortafolio({id_portafolio});"  > <span>Borrar </span></button>
		</span>
		 </td>
	 
	</tr>
	
	 <script>
 	
 
	 hiddenId('portafolio_lista_borrar_{id_oferta}');
	 hiddenId('portafolio_lista_editar_{id_oferta}');
 
 </script> 
	
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
		<td class="form_tabla_campo"><strong>Nombre del Proyecto</strong></td>
		<td>{nombre}	</td>
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
		<td class="form_tabla_campo"><strong>Coordinador Servicio</strong></td>
		<td >{coordinador}</td>
	</tr> 
	<tr>
		<td class="form_tabla_campo"><strong>Descripción del Trabajo Realizado</strong></td>
		<td >{descripcion}</td>
	</tr>
	<tr>
		<td class="form_tabla_campo"><strong>Resultados</strong></td>
		<td >{resultado}</td>
	</tr> 
	<tr>
		<td class="form_tabla_campo"><strong>Persona Referencia</strong></td>
		<td >{referencia_nombre}</td>
	</tr>
	<tr>
		<td class="form_tabla_campo"><strong>Cargo</strong></td>
		<td >{referencia_cargo}</td>
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
	<!-- END BLOCK : bloque_ficha_portafolio -->
</table>
 
 <input type="hidden" name="id_portafolio" /> 
 <script>
 function editarPortafolio(id_portafolio)
 {
 	document.main.id_portafolio.value = id_portafolio;
	process('portafolio|editar',0);
 }
 function borrarPortafolio(id_portafolio)
 {
 	if(confirm('¿Esta seguro de eliminar este portafolio?'))
	{
		document.main.id_portafolio.value = id_portafolio;
		process('portafolio_lista|borrar',0);
	}
 }
 </script>

<br />
<center><button type="button" onclick="javascript:self.close();"  > <span>Cerrar Ventana </span></button>	</center><br />
