 	  
<!-- INCLUDE BLOCK : www/templates/site/admin/mant_header.tpl -->


<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->
	

	
	<table id="tabla_noborder_admin" border="0"  >
	 
 
<tr> 
	<th style=" width:3px"></th>
<th    style="text-align:left"> ID&nbsp;CIAE  </th>
<th    style="text-align:left"> Libro  </th> 
<th    style="text-align:left"> Proyecto  </th>
<th    style="text-align:center"> Investigador Responsable  </th>
<th    style="text-align:center"> Fecha Ingreso  </th>
<th    style="text-align:center"> Tipo </th>
<th    style="text-align:center"> Estado </th>
 
 
<!--th  width="5%"> Publicada  </th-->   
<th  width="5%">   Editar  </th>   
<!--th  width="5%">   Eliminar  </th-->      
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:center" ><small>{fila}</small></td>
	 <td  valign="top"  class="{class_color}" style="text-align:left">  {id_libro}<br><small>{id_uchile}</small>	</td> 
  	
	 <td  valign="top"  class="{class_color}" style="text-align:left">     {titulo} <br><small><strong>Autores:</strong> {autores}</small><br><small><strong>Editorial:</strong> {editorial}</small>  	</td> 
 	<td  valign="top"  class="{class_color}" style="text-align:left">     {proyecto}  	</td> 
 	
 	<td  valign="top"  class="{class_color}" style="text-align:center">     {investigador_acargo}  	</td> 
 	<td  valign="top"  class="{class_color}" style="text-align:center">     <script>escribirSimplePantalla(invertirFecha('{fecha_ingreso_base}')); </script>  	</td> 
 	  
 	<td  valign="top"  class="{class_color}" style="text-align:center; text-transform: capitalize">     {tipo_libro}  	</td> 
	 <td  valign="top"  class="{class_color}" style="text-align:center; text-transform: capitalize">     <script>limpiezaEstadoLibros('{estado}');</script>  	</td> 
 	 
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_libro}');">
		 	 <img src="www/images/iconos/edit.gif" ></a>	 	  
	</td>   
 	 <!--td     class="{class_color}" style="text-align:center">  
<a href="javascript:enviar_accion_eliminar_admin('{opcion_modulo}|eliminar','{id_item}');">
<img src="www/images/iconos/delete.gif" ></a>	 	  
</td-->
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