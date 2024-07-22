 
<!-- INCLUDE BLOCK : www/templates/site/admin/mant_header.tpl -->


<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->
	
	<table id="tabla_noborder_admin"  >
 
<tr> 
	<th style=" width:3px"></th>
<th    style="text-align:left"> Boletin  </th> 
<th    style="text-align:left"> Sitio  </th>
 
 
<!--th  width="5%"> Publicada  </th-->   
<th  width="5%">   Editar  </th>   
<!--th  width="5%">   Eliminar  </th-->      
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:center" ><small>{fila}</small></td>
 	<td  valign="top"  class="{class_color}" style="text-align:left">    <strong id='titulo_boletin_{id_boletin}_{id_site}'>Bolet&iacute;n {titulo_site} | {mesTexto} {agno} - N&deg; {id_boletin}</strong>
 	 
 	</td> 
  	
 	<td  valign="top"  class="{class_color}" style="text-align:left">     {titulo_site} 
 	 
 	</td> 
 	<!--td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|publicar','{id_item}');">
		 	 <img src="www/images/iconos/{activo}publicar.gif" ></a>	 	  
	</td-->   
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_boletin}','{id_site}');">
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
 
 <script >
function enviar_accion_admin(proceso,id,id_site)
 {
 	var accion =  proceso;
	document.main.id_item.value = id; 
	document.main.id_boletin.value = id; 
	document.main.id_site.value = id_site; 
 	process(accion,0);	 
 }
</script>

<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->