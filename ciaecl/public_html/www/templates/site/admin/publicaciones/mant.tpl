	{descarga_manuales_estandar}
	
	<center> <button onclick="javascript:enviar_accion_admin('{opcion_modulo}|modificar','');" type="button"  ><span id='texto_boton_nuevo'>Nuevo Elemento</span></button> </center>   
	

<!-- INCLUDE BLOCK : www/templates/site/admin/filtro/filtro_general.tpl -->
<!-- INCLUD BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->
	<table id="tabla_noborder_admin"  >
    <tr><td colspan="7"  style="text-align:center"><a href="bdbaja/base_descarga_completo.php?caso=pub_ciae_extra&c=d6dcb1"  target="_blank"><br>&nbsp;<big>Descargar listado de publicaciones</big></a><br>&nbsp;</td></tr>
 
<tr> 
<th style=" width:3px">Id interno  </th>
<th style="text-align:left">  T&iacute;tulo  </th> 
<th  width="15%"> A&ntilde;o  </th>   
<th  width="5%"> Tipo  </th>   
<!--th  width="5%"> Isi  </th-->   
<!--th  width="5%"> Visible  </th-->   
<th  width="5%">   Editar  </th> 
<th  width="5%">   Eliminar  </th> 
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:center; color: #999999; "><small>{id_publicaciones}</small></td>
 	<td  valign="top"  class="{class_color}">    <strong> {titulo}</strong>   	</td> 
 	<td   class="{class_color}" style="text-align:center"   >{agno}	</td> 
 	<td   class="{class_color}" style="text-align:center"   >{tipo_publicacion}	</td> 
 	<!--td   class="{class_color}" style="text-align:center"   >{isi}	</td--> 
	   
 	<!--td     class="{class_color}" style="text-align:center">   
		 	 <img src="www/images/iconos/activo_{activo}.gif" >  	  
	</td-->   
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_item}');">
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
<!-- INCLUD BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->