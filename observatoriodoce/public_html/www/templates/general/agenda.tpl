{tag_volver} 
<!-- START BLOCK : lista_item -->	

	<strong>{agno}</strong><br />
	<ul>
	<!-- START BLOCK : calendario_tabla_mes -->
	<li><a href='?langSite={lang}&page=view_agenda&mes={mes_num}'>{mes}</a> ({total}) </li>
	<!-- END BLOCK : calendario_tabla_mes -->
	</ul>
<br /><br />
	<!-- START BLOCK : calendario_tabla -->
	<table width="100%" border="0">
	  <!-- START BLOCK : dia_titulo_fila -->
	  <tr>
	  	<!-- START BLOCK : dia_titulo_fila_columna -->
		<th  style='text-align:center;'><strong>{valor}</strong></th>
	  	<!-- END BLOCK : dia_titulo_fila_columna --> 
	  </tr>
	  <!-- END BLOCK : dia_titulo_fila -->
	  
	  <!-- START BLOCK : dia_valor_fila -->
	  <tr>
	  	<!-- START BLOCK : dia_valor_fila_columna -->
		<td class='{clase}' style='width:15%;'><strong>{dia}</strong>&nbsp;<br />
		<!-- START BLOCK : dia_valor_fila_columna_valor -->
		<small>{hora}</small><br /><a href='?langSite={lang}&page=view_agenda&id_elemento={id}'>{valor}</a><br />
		<!-- END BLOCK : dia_valor_fila_columna_valor -->
		&nbsp;</td>
	  	<!-- END BLOCK : dia_valor_fila_columna --> 
	  </tr>
	  <!-- END BLOCK : dia_valor_fila -->
	</table>
	<!-- END BLOCK : calendario_tabla -->

<!-- END BLOCK : lista_item -->
  		
				
<!-- START BLOCK : lista_item_select -->
 <strong>  <big>{titulo}</big></strong> 
<br  /><br  />
 
{contenido}<br  /><br  />

<!-- START BLOCK : lista_item_select_valor -->
<strong>{valor_titulo} : </strong>{valor}<br />
<!-- END BLOCK : lista_item_select_valor -->
 
 
<!-- END BLOCK : lista_item_select -->
  