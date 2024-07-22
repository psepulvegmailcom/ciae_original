 
 
	<center> <button onclick="javascript:enviar_accion_admin('{opcion_modulo}|modificar','');" type="button" title="IngresarElemento"><span>Nuevo Elemento</span></button> </center>  
	
	
	<table id="tabla_noborder_admin"  >
 
<tr> 
	<th style=" width:3px"></th>
<th    style="text-align:left"> C&oacute;digo  </th> 
<th    style="text-align:left"> Proyecto  </th>
<th    style="text-align:left"> Responsable  </th>
<th    style="text-align:left"> Estado  </th>
   
<th  width="5%">   Editar  </th>   
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:left; color: #999999; font-size:7px;"><small>{fila}</small></td>
	 <td  valign="top"  class="{class_color}">    <strong> <script>formatoCentroCosto('{codigo}');</script> </strong>   	</td> 
 	<td   class="{class_color}"    >{centro_costo}	</td>
 	<td   class="{class_color}"    >{nombre} {apellido_paterno}	</td>
 	<td   class="{class_color}"    >{activo_html}	</td>   
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