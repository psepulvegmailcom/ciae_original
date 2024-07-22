<table   >
	
	<!-- START BLOCK : bloque_catalogo_detalle_fila -->
	<tr>
		<!-- START BLOCK : bloque_catalogo_detalle_fila_izq -->
			<td class="cuadro_producto">
			<!-- INCLUDE BLOCK : nf/templates/site/catalogo_detalle_cuadro.tpl -->
			</td>
		<!-- END BLOCK : bloque_catalogo_detalle_fila_izq -->
		<!-- START BLOCK : bloque_catalogo_detalle_fila_centro -->
			<td class="cuadro_producto">
			<!-- INCLUDE BLOCK : nf/templates/site/catalogo_detalle_cuadro.tpl -->
			</td>
		<!-- END BLOCK : bloque_catalogo_detalle_fila_centro -->
		<!-- START BLOCK : bloque_catalogo_detalle_fila_der -->
			<td class="cuadro_producto">
			<!-- INCLUDE BLOCK : nf/templates/site/catalogo_detalle_cuadro.tpl -->
			</td>
		<!-- END BLOCK : bloque_catalogo_detalle_fila_der -->
	</tr>
	<!-- END BLOCK : bloque_catalogo_detalle_fila -->
	<!-- END BLOCK : bloque_catalogo_detalle_fila_vacia -->
		<tr>
	<td  colspan="3" align="center" >No hay productos disponibles en esta categor&Iacute;a	</td> 
	</tr>
	<!-- END BLOCK : bloque_catalogo_detalle_fila_vacia -->
	
	<tr>
	<td   colspan="3">&nbsp;	</td> 
	</tr>
		<tr>
	<td   colspan="3" align="center"><input type="button" class="inputboton" name="Comparar" value="Comparar" onClick="process('comparar',1);"	</td> 
	</tr>
		<tr>
	<td   colspan="3">&nbsp;	</td> 
	</tr>
	<tr>
	<td colspan="3">
	
	{paginamiento}
	</td>
	</tr>
</table>