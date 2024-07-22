 
		<!-- INCLUDE BLOCK : www/templates/site/admin/mant_header.tpl -->
 

<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->
         
	
	<table id="tabla_noborder_admin"    >
 
<tr> 
	<th style=" width:3px"></th>
<th    style="text-align:left"> Titulo  </th> 
  
<th  width="10%">  Tipo Evento </th>

<th  width="5%">   Editar  </th>
<th  width="5%">   Eliminar  </th>    
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}"  style="text-align:center"><small>{fila}</small></td>
<td  valign="top"  class="{class_color}">    <strong> {nombre}</strong>   	</td>  
<td  valign="top"  class="{class_color}" style="text-align: center">     {tipo_evento}  	</td> 
 
<td     class="{class_color}" style="text-align:center"> 
<a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_item}');">
<img src="www/images/iconos/edit.gif" ></a>	 	  
</td>  
<td     class="{class_color}" style="text-align:center">  
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
  
<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->
