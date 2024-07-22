 
		<!-- INCLUDE BLOCK : www/templates/site/admin/mant_header.tpl -->
 

	
	<table id="tabla_noborder_admin"  >
 
<tr> 
	<th style=" width:3px"></th>
<th    style="text-align:left"> T&iacute;tulo  </th> 

<th  width="1%"> ID  </th> 
<th  width="5%"> Tipo  </th>  
<th  width="5%"> Fecha  </th>  
<th  width="5%"> Publicada  </th>  
<th  width="5%"> Destacado Home  </th>  
<th  width="5%">   Editar  </th>   
<th  width="5%">   Eliminar  </th>    
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:center" ><small>{fila}</small></td>
 	<td  valign="top"  class="{class_color}">    <strong> {titulo}</strong>   	</td> 
 	<td   class="{class_color}" style="text-align:center"   ><a href="index.php?page=view_noticias&id={id_noticia}" target="_blank">{id_noticia}</a>	</td>   
 	<td   class="{class_color}" style="text-align:center"   >{tipo}	</td>   
 	<td   class="{class_color}" style="text-align:center"   >{fecha_html}	</td>   
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|publicar','{id_item}');">
		 	 <img src="www/images/iconos/{activo}publicar.gif" ></a>	 	  
	</td>  
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|destacar_home','{id_item}');">
		 	 <img src="www/images/iconos/{destacado}publicar.gif" ></a>	 	  
	</td> 
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_item}');">
		 	 <img src="www/images/iconos/edit.gif" ></a>	 	  
	</td>  <td     class="{class_color}" style="text-align:center">  
<a href="javascript:enviar_accion_eliminar_admin('{opcion_modulo}|eliminar','{id_item}');">
<img src="www/images/iconos/delete.gif" ></a>	 	  
</td>
 	 
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 	  
 
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->