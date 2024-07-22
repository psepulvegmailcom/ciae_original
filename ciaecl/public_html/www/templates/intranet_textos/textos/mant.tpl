 <div style="text-align:right; padding-right:30px; padding-bottom:10px "> <a href="javascript: verImagenBloqueGeneral('textos/{caso_texto_criterio}.jpg');">Ver est&iacute;mulo de {caso_texto_criterio}</a></div>

 
 <!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_nivel_inicio.tpl -->
	
	<table id="tabla_noborder_admin"  >
 
<tr> 
	<th style=" width:3px"></th>
<th    style="text-align:left">  Texto  </th> 
  
<th  width="5%">   Revisar  </th>   
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:left; color: #999999; "><small>{fila}</small></td>
 	<td  valign="top"  class="{class_color}">    <strong> {id_texto}</strong>   	</td>  
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_item}');">
		 	 <img src="www/images/iconos/edit.gif" border="0" ></a>	 	  
	</td>  
 	 
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 	 
  

 <input type="hidden" name="id_correccion_dia" value="{id_correccion_dia}"	>
 <input type="hidden" name="id_correccion" value="{id_correccion}">
 <input type="hidden" name="id_tipo_texto" value="{id_tipo_texto}"> 
 <input type="hidden" name="username" value="{username}"> 
 <input type="hidden" name="orden_tipo_texto" value="{orden_tipo_texto}">  
 
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->