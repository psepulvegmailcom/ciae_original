 
	
	
<center><button type="button" onclick="javascript:self.close();"  > <span>Cerrar Ventana </span></button>	</center><br />


	<script>document.main.casoFormularioBloqueo.value = 'ofertas';</script>
	<!-- INCLUDE BLOCK : ../templates/ate/revision/form_registro_bloqueo_inclusion.tpl -->
<div class="fieldset_title">Ofertas</div><br />


<table border="0"  width="100%"  id="tabla_noborder">

	 
	
	<!-- START BLOCK : bloque_ficha_sin_portafolio -->
	<tr>
		<td class="form_tabla_campo" colspan="2">No se registran ofertas</td>
	</tr>
	<!-- END BLOCK : bloque_ficha_sin_portafolio -->
	<!-- START BLOCK : bloque_ficha_portafolio -->
	<tr>
		<td colspan="2"   class="fieldset_title"  ><strong>Ficha N° {fila}  {fila_nombre} <font id='ate_oferta_{id_oferta}_estado' class="edicion_enrevision">{edicion_estado}</font></strong>
		
		<span id='bloque_botones_oferta_{id_oferta}'  >
			<button type="button" onclick="javascript:editarPortafolio('{id_oferta}{id_actualizacion_borrar}');" id='ate_oferta_{id_oferta}_boton_editar' > <span>Editar </span></button>
			<button type="button" onclick="javascript:borrarPortafolio('{id_oferta}{id_actualizacion_borrar}');"  id='ate_oferta_{id_oferta}_boton_borrar' > <span>Borrar </span></button>
		</span> </td>
	</tr>
	 
 <script>
 	
 if(trim(document.getElementById('ate_oferta_{id_oferta}_estado').innerHTML) != '')
 {
	 hiddenId('ate_oferta_{id_oferta}_boton_borrar');
	 hiddenId('ate_oferta_{id_oferta}_boton_editar');
}
 </script> 
	<tr>
		<td width="30%" class="form_tabla_campo"><strong>Área de Asistencia Técnica</strong></td>
		<td>{area}	</td>
	</tr>	
	<tr>
		<td class="form_tabla_campo"><strong>Subárea de Asistencia Técnica</strong></td>
		<td>{programa}	</td>
	</tr> 
	<tr>
		<td class="form_tabla_campo"><strong>Nombre de la Oferta</strong></td>
		<td>{nombre_oferta}	</td>
	</tr>	
	<tr>
		<td class="form_tabla_campo"><strong>Descripción de la Oferta</strong></td>
		<td>{descripcion_oferta}	</td>
	</tr>
	<!-- START BLOCK : bloque_caso_bloque_integral -->
	<tr>
		<td class="form_tabla_campo"><strong>Subáreas de Asistencia Técnica Integrales</strong></td>
		<td>
		<ul>
		<!-- START BLOCK : bloque_caso_bloque_integral_id -->
		<li class="lista_principal">{subarea}</li>
		<!-- END BLOCK : bloque_caso_bloque_integral_id -->
		</ul>
		</td>
	</tr>
		<!-- END BLOCK : bloque_caso_bloque_integral -->
	 
	<!-- END BLOCK : bloque_ficha_portafolio -->
</table>
 
 <input type="hidden" name="id_oferta" />
 <script>
 function editarPortafolio(id_oferta)
 {
 	document.main.id_oferta.value = id_oferta;
	process('oferta|editar',0);
 }
 function borrarPortafolio(id_oferta)
 {
 	if(confirm('¿Esta seguro de eliminar este oferta?'))
	{
		document.main.id_oferta.value = id_oferta;
		process('portafolio_oferta_lista|borrar',0);
	}
 }
 </script>

<br />
<center><button type="button" onclick="javascript:self.close();"  > <span>Cerrar Ventana </span></button>	</center><br />

{extra_edicion}
