<!-- INCLUDE BLOCK : www/templates/evaluaciones/base_header_hidden.tpl -->
<div class="subtitulo">{descripcion}</div>
<br />

<table class="tabla_noborder_admin">
	<tr>  
	<th> </th> 
	<th>Etapa</th>  
	<th>Estado Etapa</th> 
	<th>Fecha Inicio</th> 
	<th>Fecha Cierre</th> 
	<th>Participantes Activos</th> 
	<th>Envíos Recibidos</th> 
	
	
	</tr>

<!-- START BLOCK : bloque_lista_envios_actuales -->
	<tr>
		<td valign="top"  class="{class_color}"  style=" text-align:center"><small>{fila}</small></td>
		 
		<td valign="top"  class="{class_color}" ><strong> {nombre_etapa}</strong></td>
		 
		<td valign="top"  class="{class_color}" >{estado_html}</td>
		 
		<td valign="top"  class="{class_color}" >{fecha_inicio_html} </td>
		 		 
		<td valign="top"  class="{class_color}" >{fecha_cierre_html} </td>

		<td valign="top"  class="{class_color}" >{fecha_cierre_html} </td>
		<td valign="top"  class="{class_color}" >{fecha_cierre_html} </td>

		 
		 
		 
	</tr>
  <!-- END BLOCK : bloque_lista_envios_actuales -->

</table>





	

