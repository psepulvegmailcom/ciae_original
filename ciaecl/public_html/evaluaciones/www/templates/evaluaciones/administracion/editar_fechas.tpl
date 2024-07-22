<!-- INCLUDE BLOCK : www/templates/evaluaciones/base_header_hidden.tpl -->
<br />

<table class="tabla_noborder_admin">
	<tr>  
	<th> </th> 
	<th>Etapa</th>  
	<th>Estado Etapa</th> 
	<th>Fecha Inicio Actual</th> 
	<th>Modificar Inicio</th> 
	<th>Actualizar</th>
	<th>Fecha Cierre Actual</th> 
	<th>Modificar Cierre</th> 
	<th>Actualizar</th>
	
	</tr>

<!-- START BLOCK : bloque_lista_item_admin -->
	<tr>
		 <td valign="top"  class="{class_color}"  style=" text-align:center"><small>{fila}</small></td>
		 
		 <td valign="top"  class="{class_color}" ><strong> {nombre_etapa}</strong></td>
		 
		 <td valign="top"  class="{class_color}" >{estado_html}</td>
		 
		 <td valign="top"  class="{class_color}" >{fecha_inicio_html} </td>
		 
		 <td><input type="datetime-local" name="dtInicio_{fila}"></td>

		 <td>
			<button type="button" name = "actInicio_{fila}" onClick="javascript:actualizarFechaInicio_{fila}();"><span>Actualizar</span></button> 
		</td>

		 <td valign="top"  class="{class_color}" >{fecha_cierre_html} </td>

		 <td><input type="datetime-local" name="dtCierre_{fila}"></td>

		 <td>
			<button type="button" name = "actCierre_{fila}" onClick="javascript:actualizarFechaCierre_{fila}();"><span>Actualizar</span></button> 
		</td>
		 
		 
	</tr>
  <!-- END BLOCK : bloque_lista_item_admin -->

</table>





	

