     
	 

<!-- INCLUDE BLOCK : www/templates/site/admin/mant_header_sin_boton.tpl -->

<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->
	
	
	
	<table id="tabla_noborder_admin" border="0"  >
	 
 
<tr> 
	<th style=" width:3px"></th> 
<th    style="text-align:left"> ID&nbsp;CIAE  </th>
<th    style="text-align:left"> T&iacute;tulo  </th> 
<th    style="text-align:left"> Autores  </th>
<th    style="text-align:center"> Editorial  </th> 
<th    style="text-align:center"> Tipo </th>
<th    style="text-align:center"> Estado </th>
 
 
<!--th  width="5%"> Publicada  </th-->   
<th  width="5%">   Ver <br>detalles </th>   
<!--th  width="5%">   Eliminar  </th-->      
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:center" ><small>{fila}</small></td> 
  	 <td  valign="top"  class="{class_color}" style="text-align:left">  {id_libro}<br><small>{id_uchile}</small>	</td> 
	 <td  valign="top"  class="{class_color}" style="text-align:left">     {titulo} </td> 
 	<td  valign="top"  class="{class_color}" style="text-align:left"> {autores}</td> 
 	<td  valign="top"  class="{class_color}" style="text-align:left">{editorial} 	</td> 
 	<td  valign="top"  class="{class_color}" style="text-align:center; text-transform: capitalize">     {tipo_libro}  	</td> 
 	<td  valign="top"  class="{class_color}" style="text-align:center; text-transform: capitalize">     <script>limpiezaEstadoLibros('{estado}');</script>  	</td> 
 	 
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_libro}');">
		 	 <img src="www/images/iconos/edit.gif" ></a>	 	  
	</td>   
 	 
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 	  
 <input type="hidden" name="id_boletin">
 <input type="hidden" name="id_site">
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->


<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->