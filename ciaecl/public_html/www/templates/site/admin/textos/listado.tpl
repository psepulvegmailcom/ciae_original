 
<!--  BLOCK : www/templates/site/admin/mant_header.tpl -->
 

<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->
	
	<table id="tabla_noborder_admin"  >
<tr> 
	<th style=" width:3px"></th>
<th    style="text-align:left">Men&uacute;   </th>  
  

<!--th  width="10%"> Sitio  </th-->   


  
<th  width="5%">   Editar  </th>   
     
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:center" ><small>{fila}</small></td>
 	<td  valign="top"  class="{class_color}" >    <strong> {id_texto} </strong></td> 

 
      	<!--td  valign="top"  class="{class_color}">{sitio}</td--> 
 

  
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_texto}');">
		 	 <img src="www/images/iconos/edit.gif" ></a>	 	  
   
 <!-- END BLOCK : lista_item --> 
 </table>
 	  
 
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->
 

<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->