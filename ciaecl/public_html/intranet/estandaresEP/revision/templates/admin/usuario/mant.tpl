 
 <!-- START BLOCK : item_ingresar -->
	<center> <button onclick="javascript:enviar_accion('ingresar','');" type="button" title="Ingresar Noticia"><span>Ingresar Nuevo Usuario</span></button> </center> 
	<!-- START BLOCK : item_ingresar -->
	 
	 
	{paginamiento}
	
	
	<table id="tabla_noborder_admin"  >
 
<tr> 
	<th style=" width:3px"></th>
<th    style="text-align:left">  Nombre  </th> 

<th  width="15%"> Nombre Usuario  </th>  
<th  width="15%">    {caso_columna}  </th>     
<th  width="5%">   Editar  </th>  
<th  width="5%">   Activo / Inactivo </th>  
</tr>
 <!-- START BLOCK : lista_item -->
 <tr > 
 
<td class="{class_color}" style="text-align:left; color: #999999; font-size:7px;"><small>{fila}</small></td>
 	<td  valign="top"  class="{class_color}">    <strong> {nombre}</strong>   	</td> 
 	<td   class="{class_color}" style="text-align:center"   >{username}	</td>  
 	<td   class="{class_color}" style="text-align:center"   >{tipo}	</td>   
 	<!--<td   class="{class_color}" style="text-align:center"   >{acceso}	</td>  --> 
 	<td     class="{class_color}" style="text-align:center">  <a href="javascript:enviar_accion('modificar','{id_item}');">
		 	 <img src="images/iconos/edit.gif" ></a>	 	  
	</td>  
 	<td    class="{class_color}" style="text-align:center">   
		 <a onClick="javascript:cambioEstadoActivo('{id_item}','{activo}');">	<img src="images/iconos/revision{activo}.gif" > </a>
			 
			  
			 </td>
</tr> 
 <!-- END BLOCK : lista_item --> 
 </table>
 	{paginamiento}
 <input type="hidden" name="id_item" />
 <input type="hidden" name="cambios_excluyentes" value="0">
 <script>
 function cambioEstadoActivo(user_id,caso)
 {
	if(caso == 'lista')
	{
		if(confirm('Esta seguro que desea desactivar este usuario?'))
		{		
			var accion = '{opcion_modulo}|guardar|desactivar';
			document.main.id_item.value = user_id; 
			document.main.cambios_excluyentes.value = 1; 
			process(accion,0); 
		}
	}
 }
 
 function enviar_accion(proceso,id)
 {
 	var accion = '{opcion_modulo}|'+proceso;
	document.main.id_item.value = id;
 	if(proceso == 'eliminar')
	{
		if(confirm('Esta seguro que desea activar/inactivar este elemento?'))
		{
			process(accion,0); 
		}
	}
	else
	{
		process(accion,0);
	}
 }
 </script>
 
 <!-- START BLOCK : item_lista_nohay -->
 <br />
 <div style="text-align:center">No hay elementos disponibles</div>
 <!-- END BLOCK : item_lista_nohay -->