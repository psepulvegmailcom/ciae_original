 
<!-- INCLUDE BLOCK : www/templates/site/admin/mant_header.tpl --> 

<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->
	
	<table id="tabla_noborder_admin"  >
 
<tr> 
	<th style=" width:3px"></th>

<th  width="1%"> Rut  </th> 
 
<th      > Nombre  </th>  
<th    style="text-align:left"> N&uacute;mero  convenio  </th> 
<th    style="text-align:left"> N&uacute;mero  decreto  </th> 
<th    style="text-align:left">	Fecha  creaci&oacute;n</th> 
	<th    style="text-align:left">Fecha   inicio</th>
	<th    style="text-align:left">Fecha  t&eacute;rmino</th> 
	<th    style="text-align:left">Fecha  convenio</th>  
	<th    style="text-align:left">Fecha  firma</th> 
	<th    style="text-align:left">Fecha  compromiso</th> 
	<th    style="text-align:left">Fecha  aprobaci&oacute;n</th> 
<th    style="text-align:left"> Proyecto  </th> 
<th    style="text-align:left"> Estado  </th> 
<th  width="5%">   Editar  </th>   
<!--<th  width="5%">   Eliminar  </th> -->   
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:center" ><small>{fila}</small></td>
 	<td  valign="top"  class="{class_color}">      {rut_html}-{rut_dv}   	</td> 
 	<td  valign="top"  class="{class_color}">     {nombre} {apellido_paterno}   	</td>  
 	<td  valign="top"  class="{class_color}">       {numero_convenio} 	</td> 
 	<td  valign="top"  class="{class_color}">      {numero_decreto}   	</td> 
 	<td  valign="top"  class="{class_color}">     <script>limpiezaFecha('{fecha_creacion_html}');</script>     	</td>
 	  
 	<td  valign="top"  class="{class_color}">    <script>limpiezaFecha('{fecha_desde_html}');</script>     	</td>  
 	<td  valign="top"  class="{class_color}">    <script>limpiezaFecha('{fecha_termino_html}');</script>    	</td>  
 	<td  valign="top"  class="{class_color}">    <script>limpiezaFecha('{fecha_convenio_html}');</script>     	</td>  
 	<td  valign="top"  class="{class_color}">   <script>limpiezaFecha('{fecha_firma_html}');</script>      	</td>  
 	<td  valign="top"  class="{class_color}">    <script>limpiezaFecha('{fecha_compromiso_html}');</script>     	</td>  
 	<td  valign="top"  class="{class_color}">    <script>limpiezaFecha('{fecha_aprobacion_html}');</script>     	</td>  
 	<td  valign="top"  class="{class_color}">   {proyecto}     	</td>    
 	<td  valign="top"  class="{class_color}">   {estado_convenio}     	</td>  
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion_admin('{opcion_modulo}|modificar','{id_honorario}');">
		 	 <img src="www/images/iconos/edit.gif" ></a>	 	  
	</td> <!-- <td     class="{class_color}" style="text-align:center">  
<a href="javascript:enviar_accion_eliminar_admin('{opcion_modulo}|eliminar','{id_item}');">
<img src="www/images/iconos/delete.gif" ></a>	 	  
</td>-->
 	 
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 	  
 
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->
<!-- INCLUDE BLOCK : www/templates/site/admin/paginamiento_admin.tpl -->