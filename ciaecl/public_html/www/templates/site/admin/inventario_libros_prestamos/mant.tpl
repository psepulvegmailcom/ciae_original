 
	 	 	  
<!-- INCLUDE BLOCK : www/templates/site/admin/mant_header.tpl -->
<script>
	changeTextId('texto_boton_nuevo','Registrar Pr&eacute;stamos');
</script>

<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->
	
 
	
	<table id="tabla_noborder_admin" border="0"  >
	 
 
<tr> 
	<th style=" width:3px"></th> 
<th    style="text-align:left"> Solicitante  </th>
<th    style="text-align:left"> Encargado  </th> 
<th    style="text-align:center"> Fecha <br>Solicitud  </th>
<th    style="text-align:center"> Fecha <br>Pr&eacute;stamo </th> 
<th    style="text-align:center"> Fecha <br>Devoluci&oacute;n <br>Estimada</th>
<th    style="text-align:center"> Fecha <br>Devoluci&oacute;n </th>
<th    style="text-align:center"> Estado <br>Pr&eacute;stamo </th>
 
 
<!--th  width="5%"> Publicada  </th-->   
<th  width="5%">   Ver <br>detalles </th>   
<!--th  width="5%">   Eliminar  </th-->      
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:center" ><small>{fila}</small></td> 
  	  
	 <td  valign="top"  class="{class_color}" style="text-align:left">     {usuario_solicitante} </td> 
	 
	 <td  valign="top"  class="{class_color}" style="text-align:left">     {usuario_gestiona} </td> 
	 <td  valign="top"  class="{class_color}" style="text-align:center">    <script>limpiezaFecha('{fecha_solicitud_html}');</script> </td> 
 	<td  valign="top"  class="{class_color}" style="text-align:center"> <script>limpiezaFecha('{fecha_prestamo_html}');</script></td> 
	 <td  valign="top"  class="{class_color}" style="text-align:center"><script>limpiezaFecha('{fecha_devolucion_estimada_html}');</script>	</td>
	 <td  valign="top"  class="{class_color}" style="text-align:center"><script>limpiezaFecha('{fecha_devolucion_html}');</script>	</td>  
 	<td  valign="top"  class="{class_color}" style="text-align:center; text-transform: capitalize">    <script>limpiezaEstadoLibros('{estado}');</script>  	</td> 
 	 
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_prestamo}');">
		 	 <img src="www/images/iconos/edit.gif" ></a>	 	  
	</td>   
 	 
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 	  
 <input type="hidden" name="id_prestamo"> 
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->


<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->

