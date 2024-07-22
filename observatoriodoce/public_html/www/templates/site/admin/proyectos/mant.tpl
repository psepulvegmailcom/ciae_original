 
 
	<center> <button onclick="javascript:enviar_accion_admin('{opcion_modulo}|modificar','');" type="button" title="IngresarElemento"><span>AgregarNuevo Elemento</span></button> </center>  
	
	
	<table id="tabla_noborder_admin"  >
 <tr><td colspan="6" style="text-align:center;"><a href="bdbaja/base_descarga_completo.php?caso=proy_ciae_extra&c=d6dcb1"  target="_blank"><br>&nbsp;<big>Descargar listado de proyectos</big></a><br>&nbsp;</td></tr>
<tr> 
	<th style=" width:3px">Id interno  </th>
<th    style="text-align:left">  Proyecto </th> 

<th  width="15%"> A&ntilde;o  </th>   
<th  width="15%"> Tipo Proyecto  </th>  
<th  width="15%"> Visible  </th> 
<th  width="5%">   Editar  </th>   
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:center; color: #999999;  "><small>{id_proyecto}</small></td>
 	<td  valign="top"  class="{class_color}">    <strong> {proyecto}</strong>   	</td> 
 	<td   class="{class_color}" style="text-align:center"   >{agno_inicio}	</td>    
 	<td   class="{class_color}" style="text-align:center"   >{tipo_proyecto}	</td> 
 	<td     class="{class_color}" style="text-align:center">   
		 	 <img src="www/images/iconos/activo_{activo}.gif" >  	  
	</td>  
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