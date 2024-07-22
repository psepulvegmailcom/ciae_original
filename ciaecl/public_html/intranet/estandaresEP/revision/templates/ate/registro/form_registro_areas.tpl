 
			<table id="tabla_noborder">
				<tr>
					<th    rowspan="2"  width="25%"> &Aacute;rea  <!--{persona_texto_area}--> </th>
					<th      rowspan="2"  width="50%" align="center">Subárea {persona_texto_area}    </th>
					<th    colspan="2"> ¿Ha tenido experiencia en esta subárea en los últimos 5 años?  </th>
				</tr>
				<tr> 
					<th align="center">No </th>
					<th align="center" >Si </th>
				</tr>
				<!-- START BLOCK : bloque_ate_area -->				
				
				
				<tr>
				<td  rowspan="{total_filas}"  ><strong>{bloque_ate_area_area}</strong></td>
				 {bloque_ate_area_fila_experiencia}
				 </tr>
				<!-- START BLOCK : bloque_ate_area_programa -->
				<tr>
				{bloque_ate_area_fila_experiencia}
				</tr>
				<!-- END BLOCK : bloque_ate_area_programa -->
				 
			<!-- END BLOCK : bloque_ate_area -->
			
				<tr>
					<td  colspan="4" align="center">
				<center>
				<!-- START BLOCK : bloque_ate_area_fila_oferta -->
				<button type="button" onclick="javascript:verFormularioPopup('portafolio_oferta_lista{especial_rut}');"  ><span>Ver Listado de Ofertas</span></button>
				 <!-- END BLOCK : bloque_ate_area_fila_oferta -->
				<button type="button" onclick="javascript:verFormularioPopup{openespecial}('portafolio_lista{especial_rut}');"  ><span>Ver Listado de Experiencias</span></button></center>    			</td>
				</tr>
			</table> 
			
					 <script>
					function verFormularioPopupEspecial(opcion,rut)
					{ 
							nombre = 'ventana_extra_lista_portafolio_recurso_ficha';
						  var nuevo_ventana = window.open('indexPopup.php?caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&option='+opcion+'&rut='+rut,nombre,optionOpenW);
					}
					</script>
					 
 