 
 
	<center> <button onclick="javascript:enviar_accion_admin('{opcion_modulo}|modificar','');" type="button" title="IngresarElemento"><span>Nuevo Elemento</span></button> </center>  
	
	
	<table id="tabla_noborder_admin"  >
 
<tr> 
	<th style=" width:3px"></th>
<th    style="text-align:left">  Tipo  </th> 

<th  width="15%"> Grupo  </th>   
<th  width="15%"> Orden  </th>   
<th  width="5%">   Editar  </th>   
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:left; color: #999999; font-size:7px;"><small>{fila}</small></td>
 	<td  valign="top"  class="{class_color}">    <strong> {tipo}</strong>   	</td> 
     	<td   class="{class_color}" style="text-align:center"   >{grupo}	</td>  
 	<td   class="{class_color}" style="text-align:center"   >{orden}	</td>   
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_item}');">
		 	 <img src="www/images/iconos/edit.gif" ></a>	 	  
	</td>  
 	 
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 	 
  
 
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->